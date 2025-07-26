<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('orderItems.book')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.book.author');

        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Ensure user can only cancel their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status === 'pending' || $order->status === 'processing') {
            $order->update(['status' => 'cancelled']);
            
            return back()->with('success', 'Order cancelled successfully.');
        }

        return back()->with('error', 'Cannot cancel this order.');
    }
}
