<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $page_title = "Admin";
        $User = User::all();
        return view('admin.dashboard.index', compact('page_title', 'User'));
    }

    public function show(User $user)
    {
        $page_title = "Detail Data Famili";
        return view('admin.dashboard.detail', compact('page_title', 'famili'));
    }

    public function update(Request $request, User $user)
    {
        $validated_data = $request->validate([
            'role' => 'required|in:customer,admin',
        ]);

        // dd($user);

        $user->update($validated_data);

        // \Log::info('User role updated successfully.');

        $message = "Berhasil mengubah data user.";
        return redirect()->route('admin.dashboard')->with('message', $message);

    }

    public function destroy(User $user)
    {
        $user->delete();
        $message = "Berhasil menghapus data user.";
        return redirect()->route('admin.dashboard')->with('message', $message);
    }
}

