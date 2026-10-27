<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $totalPeminjaman = Peminjaman::count();
    $totalBuku = Buku::count();
    $totalAnggota = \App\Models\User::where('role', 'anggota')->count();

    $peminjaman = Peminjaman::with('user', 'buku')
        ->latest()
        ->paginate(10);

    return view('admin.dashboard', compact(
        'totalPeminjaman',
        'totalBuku',
        'totalAnggota',
        'peminjaman'
    ));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
