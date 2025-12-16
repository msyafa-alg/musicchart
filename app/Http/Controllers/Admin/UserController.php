<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display list of users for admin
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
                    ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form to edit user points
     */
    public function editPoints(User $user)
    {
        return view('admin.users.edit-points', compact('user'));
    }

    /**
     * Update user points directly (set specific value)
     */
    public function updatePoints(Request $request, User $user)
    {
        $request->validate([
            'points' => 'required|integer|min:0'
        ]);

        $oldPoints = $user->points;
        $newPoints = $request->points;
        $user->points = $newPoints;
        $user->save();

        Log::info("Admin updated user points", [
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'old_points' => $oldPoints,
            'new_points' => $newPoints
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "✅ Poin user {$user->name} berhasil diubah dari {$oldPoints} menjadi {$newPoints}");
    }

    /**
     * Add points to user (topup from admin)
     */
    public function topup(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|integer|min:1|max:1000000'
        ]);

        $oldPoints = $user->points;
        $amount = $request->amount;
        $user->increment('points', $amount);

        Log::info("Admin topup user points", [
            'admin_id' => auth()->id(),
            'user_id' => $user->id,
            'amount' => $amount,
            'old_points' => $oldPoints,
            'new_points' => $user->points
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "💰 Topup {$amount} poin berhasil untuk {$user->name}. Total sekarang: {$user->points} poin");
    }
}
