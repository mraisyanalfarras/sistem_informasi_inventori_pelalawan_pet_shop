<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');

       // Pencarian berdasarkan nama atau NIK
           // Search by name or NIK
           if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%');
            });
    }
       

        // Filter berdasarkan posisi
        if ($request->has('position') && $request->position) {
            $query->where('position', $request->position);
        }

        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'tanggal' => 'required|date',
            'position' => 'required|in:Staff,Supervisor,Manager,Director',
            'masuk_jadwal' => 'required|in:Shift,General',
            'kecelakaan' => 'nullable|string|max:255',
            'mulai_kerja' => 'required|date',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tanggal' => $request->tanggal,
            'position' => $request->position,
            'masuk_jadwal' => $request->masuk_jadwal,
            'kecelakaan' => $request->kecelakaan,
            'mulai_kerja' => $request->mulai_kerja,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
    
    $user->load(['datasios', 'datasims', 'dataSirs']);
    return view('admin.users.show', compact('user'));

    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nik' => 'required|string|max:20|unique:users,nik,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tanggal' => 'required|date',
            'position' => 'required|in:Staff,Supervisor,Manager,Director',
            'masuk_jadwal' => 'required|in:Shift,General',
            'kecelakaan' => 'nullable|string|max:255',
            'mulai_kerja' => 'required|date',
            'role' => 'required|exists:roles,name',
        ]);

        $user->update($request->except('password'));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function getUserData(Request $request)
{
    $user = User::find($request->user_id);

    if ($user) {
        return response()->json([
            'nik' => $user->nik,
            'name' => $user->name,
            'position' => $user->position,
        ]);
    }

    return response()->json([], 404);
}
}