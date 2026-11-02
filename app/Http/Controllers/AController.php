<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
    

class AController extends Controller
{
    /**
     * Dashboard anggota.
     */
 public function dashboard()
{
    $totalPeminjaman = Peminjaman::where('user_id', Auth::id())
        ->count();

    $peminjaman = Peminjaman::with('buku')
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

    return view('anggota.dashboard', compact(
        'totalPeminjaman',
        'peminjaman'
    ));
}

    /**
     * Menampilkan daftar buku dan pencarian.
     */
    public function buku(Request $request)
    {
        $query = Buku::query();
        
    

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        $buku = $query->orderBy('judul')->paginate(12);

        $buku->appends($request->only('search'));

        return view('anggota.buku', compact('buku'));
    }

    /**
     * Menampilkan halaman peminjaman anggota.
     */
    public function peminjaman()
    {
        return view('anggota.peminjaman');
    }

    // Menampilkan profil anggota
public function profil()
{
    $user = Auth::user();

    return view('anggota.profil', compact('user'));
}

// Mengubah data profil
public function updateProfil(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('anggota.profil')
        ->with('success', 'Profil berhasil diperbarui!');
}

// Mengganti password
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'min:8', 'confirmed'],
    ]);

    Auth::user()->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('anggota.profil')
        ->with('success', 'Password berhasil diganti!');
}

    
}