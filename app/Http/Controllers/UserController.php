<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function($q) use ($cari) {
                $q->where('name', 'like', "%$cari%")
                  ->orWhere('username', 'like', "%$cari%")
                  ->orWhere('email', 'like', "%$cari%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'asc')->paginate(10)->withQueryString();

        return view('admin.kelola-user', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'role'     => 'required|in:admin,pengurus,petugas',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required'  => 'Username wajib diisi.',
            'username.unique'    => 'Username sudah dipakai.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->username,
            'username' => $request->username,
            'role'     => $request->role,
            'status'   => 'aktif',
            'password' => $request->password,
        ]);

        return back()->with('sukses', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'role'     => 'required|in:admin,pengurus,petugas',
            'password' => 'nullable|string|min:6',
        ], [
            'username.unique' => 'Username sudah dipakai user lain.',
        ]);

        $data = [
            'name'     => $request->username,
            'username' => $request->username,
            'role'     => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('sukses', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('sukses', 'User berhasil dihapus.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menonaktifkan akun sendiri.');
        }

        $user->status = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->save();

        $pesan = $user->status === 'aktif' ? 'User berhasil diaktifkan.' : 'User berhasil dinonaktifkan.';
        return back()->with('sukses', $pesan);
    }
}
