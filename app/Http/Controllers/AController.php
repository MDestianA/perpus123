<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class AController extends Controller
{
    /**
     * Dashboard anggota.
     */
    public function dashboard()
    {
        $jumlahBuku = Buku::count();

        return view('anggota.dashboard', compact('jumlahBuku'));
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
}