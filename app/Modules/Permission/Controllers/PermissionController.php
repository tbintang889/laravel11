<?php

namespace App\Modules\Permission\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('Permission::index', compact('permissions'));
    }

    public function create()
    {
        return view('Permission::form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        try {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan permission: ' . $e->getMessage());
        }
    }

    public function edit(Permission $permission)
    {
        return view('Permission::form', compact('permission'));

    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        try {
            $permission->update(['name' => $request->name]);
            return redirect()->route('permission.index')->with('success', 'Permission berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui permission: ' . $e->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('permission.index')->with('success', 'Permission berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus permission: ' . $e->getMessage());
        }
    }
}
