<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('User::index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('User::form', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);


        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);


            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('User::form', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);

            return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
