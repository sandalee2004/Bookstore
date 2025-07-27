<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'ILIKE', "%{$request->search}%")
                  ->orWhere('email', 'ILIKE', "%{$request->search}%");
        }

        if ($request->role !== null) {
            $query->where('is_admin', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['orders.orderItems.book']);
        return view('admin.users.show', compact('user'));
    }

    public function toggleAdmin(User $user)
    {
        $user->update(['is_admin' => !$user->is_admin]);
        
        $status = $user->is_admin ? 'granted admin privileges' : 'removed admin privileges';
        return response()->json([
            'success' => true,
            'message' => "User {$status} successfully."
        ]);
    }

    public function destroy(User $user)
    {
        // Prevent deleting the current admin user
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account.'
            ]);
        }

        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}