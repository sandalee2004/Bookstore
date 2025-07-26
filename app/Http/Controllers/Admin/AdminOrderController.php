<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.book']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('order_number', 'ILIKE', "%{$request->search}%")
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('name', 'ILIKE', "%{$request->search}%")
                        ->orWhere('email', 'ILIKE', "%{$request->search}%");
                  });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.book.author']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status === 'shipped') {
            $order->update(['shipped_at' => now()]);
        } elseif ($request->status === 'delivered') {
            $order->update(['delivered_at' => now()]);
        }

        return back()->with('success', 'Order status updated successfully.');
    }
}
