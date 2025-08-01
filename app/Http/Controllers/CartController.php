<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with(['book.author', 'book.category'])->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->book->final_price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:10'
        ]);

        // Handle both Book model and ID parameter
        if (is_numeric($book)) {
            $book = Book::findOrFail($book);
        }

        // Check if book is active and in stock
        if (!$book->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'This book is not available.'
            ]);
        }

        if ($book->stock_quantity <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'This book is currently out of stock.'
            ]);
        }

        $quantity = $request->get('quantity', 1);
        
        // Check if book is already in cart
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            
            if ($newQuantity > $book->stock_quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available. Only ' . $book->stock_quantity . ' items in stock.'
                ]);
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            if ($quantity > $book->stock_quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available. Only ' . $book->stock_quantity . ' items in stock.'
                ]);
            }
            
            CartItem::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => $quantity
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Book added to cart successfully!',
            'cart_count' => Auth::user()->cartItems()->sum('quantity')
        ]);
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $itemId)
            ->firstOrFail();

        $book = $cartItem->book;
        
        if ($request->quantity > $book->stock_quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available. Only ' . $book->stock_quantity . ' items in stock.'
            ]);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'item_total' => number_format($cartItem->book->final_price * $cartItem->quantity, 2),
            'cart_total' => number_format($this->getCartTotal(), 2)
        ]);
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $itemId)
            ->firstOrFail();

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully!',
            'cart_count' => Auth::user()->cartItems()->sum('quantity'),
            'cart_total' => number_format($this->getCartTotal(), 2)
        ]);
    }

    public function clear()
    {
        Auth::user()->cartItems()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => Auth::user()->cartItems()->sum('quantity'),
            'total' => number_format($this->getCartTotal(), 2)
        ]);
    }

    public function getItems()
    {
        try {
            $cartItems = Auth::user()->cartItems()->with('book.author')->get();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading cart items',
                'items' => [],
                'total' => '0.00',
                'count' => 0
            ]);
        }
        
        $items = $cartItems->map(function ($item) {
            if (!$item->book) {
                return null;
            }
            
            return [
                'id' => $item->id,
                'book_id' => $item->book->id,
                'title' => $item->book->title,
                'author' => $item->book->author ? $item->book->author->name : 'Unknown Author',
                'cover_image' => $item->book->cover_image,
                'price' => number_format($item->book->final_price, 2),
                'quantity' => $item->quantity,
                'total' => number_format($item->book->final_price * $item->quantity, 2)
            ];
        })->filter();

        return response()->json([
            'success' => true,
            'items' => $items,
            'total' => number_format($this->getCartTotal(), 2),
            'count' => Auth::user()->cartItems()->sum('quantity')
        ]);
    }

    private function getCartTotal()
    {
        try {
            return Auth::user()->cartItems()->with('book')->get()->sum(function ($item) {
                if (!$item->book) {
                    return 0;
                }
                return $item->book->final_price * $item->quantity;
            });
        } catch (\Exception $e) {
            return 0;
        }
    }
}