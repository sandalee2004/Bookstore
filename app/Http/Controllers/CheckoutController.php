<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with(['book.author', 'book.category'])->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->book->final_price * $item->quantity;
        });
        
        $taxRate = 0.08; // 8% tax
        $taxAmount = $subtotal * $taxRate;
        $shippingCost = $subtotal > 50 ? 0 : 9.99; // Free shipping over $50
        $total = $subtotal + $taxAmount + $shippingCost;

        return view('checkout.index', compact('cartItems', 'subtotal', 'taxAmount', 'shippingCost', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|array',
            'shipping_address.address' => 'required|string|max:255',
            'shipping_address.city' => 'required|string|max:100',
            'shipping_address.state' => 'required|string|max:100',
            'shipping_address.zip_code' => 'required|string|max:20',
            'shipping_address.country' => 'required|string|max:100',
            'billing_same_as_shipping' => 'boolean',
            'billing_address' => 'required_if:billing_same_as_shipping,false|array',
            'payment_method' => 'required|in:credit_card,paypal,stripe',
        ]);

        $user = Auth::user();
        $cartItems = $user->cartItems()->with('book')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        
        try {
            // Calculate totals
            $subtotal = $cartItems->sum(function ($item) {
                return $item->book->final_price * $item->quantity;
            });
            
            $taxRate = 0.08;
            $taxAmount = $subtotal * $taxRate;
            $shippingCost = $subtotal > 50 ? 0 : 9.99;
            $total = $subtotal + $taxAmount + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'shipping_cost' => $shippingCost,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_same_as_shipping ? 
                    $request->shipping_address : $request->billing_address,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $cartItem->book_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->book->final_price,
                    'total' => $cartItem->book->final_price * $cartItem->quantity,
                ]);

                // Update book stock
                $cartItem->book->decrement('stock_quantity', $cartItem->quantity);
            }

            // Clear cart
            $user->cartItems()->delete();

            // Here you would integrate with actual payment processor
            // For demo purposes, we'll simulate successful payment
            $order->update([
                'status' => 'processing',
                'payment_status' => 'paid',
            ]);

            DB::commit();

            return redirect()->route('checkout.success', $order);
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'There was an error processing your order. Please try again.');
        }
    }

    public function success(Order $order)
    {
        // Ensure user can only view their own order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}