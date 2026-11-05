<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Mengelola data master pengguna dan pengaturan hak akses role.
 */
class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna terdaftar.
     */
    public function index(): View
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form penambahan pengguna baru.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan data pengguna baru ke database.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form pengubahan pengguna.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Memperbarui informasi profil atau password pengguna.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->only(['name', 'username', 'email', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus akun pengguna (mencegah menghapus akun sendiri).
     */
    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
