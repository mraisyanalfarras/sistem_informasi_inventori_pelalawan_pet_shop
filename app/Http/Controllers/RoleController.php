<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Hanya menggunakan Role dari Spatie
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // Mengambil semua role
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        // Mengambil semua permission yang tersedia
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array', // Pastikan permissions adalah array
        ]);

        // Membuat role baru dengan field 'guard_name'
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web', // Sesuaikan guard dengan kebutuhan
        ]);

        // Memberi permission ke role
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->input('permissions'));
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Role $role)
{
    // Mengambil semua permission
    $permissions = Permission::all();

    // Mengambil permissions yang sudah dimiliki oleh role dalam bentuk array ID
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
}

    public function update(Request $request, Role $role) {
    
        // Update the role name
        $role->update(['name' => $request->input('name')]);
    
        // Sync the permissions
        $role->syncPermissions($request->input('permissions'));
    
        return redirect()->route('roles.index')->with('success', 'Data berhasil Diupdate');
    }

    public function destroy(Role $role)
{
    // Hapus semua permissions dari role
    $role->syncPermissions([]);

    // Hapus role itu sendiri
    $role->delete();

    return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
}

}