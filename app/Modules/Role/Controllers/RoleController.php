<?php

namespace App\Modules\Role\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index(): View
    {
        $roles = Role::all();

        return view('Role::index', [
            'roles' => $roles

        ]);
    }
    public function create()
    {
        return view('Role::form');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('Role::form', compact('role'));
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255|unique:roles,name',
            ]);

            $validatedData['guard_name'] = 'web'; // atau guard default yang Anda gunakan

            Role::create($validatedData);

            return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $role->update($validatedData);

        return redirect()->route('role.index')->with('success', 'Role berhasil diperbarui');
    }
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            Log::info('Role dihapus:', ['id' => $role->id, 'name' => $role->name]);
            return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Role tidak ditemukan:', ['id' => $id]);
            return redirect()->route('role.index')->with('error', 'Role tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus role:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('role.index')->with('error', 'Gagal menghapus role: ' . $e->getMessage());
        }
    }



    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('Role::edit_permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->syncPermissions($request->permissions);
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Permissions untuk role berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
