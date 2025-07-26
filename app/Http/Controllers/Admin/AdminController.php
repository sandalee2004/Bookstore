<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_users' => User::where('is_admin', false)->count(),
            'total_orders' => Order::count(),
            'total_categories' => Category::count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_books' => Book::where('stock_quantity', '<=', 5)->count(),
        ];

        $recentOrders = Order::with(['user', 'orderItems.book'])
            ->latest()
            ->limit(5)
            ->get();

        $topBooks = Book::orderBy('reviews_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topBooks'));
    }
}
