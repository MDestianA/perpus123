<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    // Menampilkan daftar anggota
    public function index()
    {
        $anggota = User::where('role', 'anggota')
            ->latest()
            ->paginate(10);


        return view('admin.dataAnggota', compact('anggota'));
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        return view('admin.anggotaCreate');
    }

    // Menyimpan anggota baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
        ]);

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Menampilkan detail anggota
    public function show(User $anggota)
    {
        abort_unless($anggota->role === 'anggota', 404);

        return view('admin.dataAnggota', compact('anggota'));
    }

    // Menampilkan form edit anggota

public function edit(User $anggota)
{
    abort_unless($anggota->role === 'anggota', 404);

    return view('admin.anggotaEdit', compact('anggota'));
}

public function update(Request $request, User $anggota)
{
    abort_unless($anggota->role === 'anggota', 404);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $anggota->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $anggota->name = $validated['name'];
    $anggota->email = $validated['email'];

    if (!empty($validated['password'])) {
        $anggota->password = \Illuminate\Support\Facades\Hash::make(
            $validated['password']
        );
    }

    $anggota->save();

    return redirect()->route('anggota.index')
        ->with('success', 'Data anggota berhasil diperbarui.');
}
    // Menghapus anggota
    public function destroy(User $anggota)
    {
        abort_unless($anggota->role === 'anggota', 404);

        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
