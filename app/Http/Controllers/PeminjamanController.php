<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.dataPeminjaman', compact('peminjaman'));
    }

    public function storeAnggota(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => ['required', 'integer', 'exists:buku,id'],
            'tanggal_pinjam' => ['required', 'date', 'after_or_equal:today'],
        ]);

        DB::transaction(function () use ($validated) {
            $buku = Buku::whereKey($validated['buku_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($buku->stok < 1) {
                throw ValidationException::withMessages([
                    'buku_id' => 'Stok buku sedang habis.',
                ]);
            }


            $tanggalPinjam = \Carbon\Carbon::parse($validated['tanggal_pinjam']);

            $tanggalJatuhTempo = $tanggalPinjam->copy()->addDays(7);

            Peminjaman::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id,
                'tanggal_pinjam' => $tanggalPinjam->toDateString(),
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo->toDateString(),
                'status' => 'menunggu',
            ]);
        });

        return redirect()
            ->route('anggota.peminjaman')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim dan menunggu persetujuan admin.');
    }

    public function indexAnggota()
    {
        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('anggota.peminjaman', compact('peminjaman'));
    }

    public function setujui(Peminjaman $peminjaman)
{
    DB::transaction(function () use ($peminjaman) {

        $peminjaman = Peminjaman::whereKey($peminjaman->id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($peminjaman->status !== 'menunggu') {
            throw ValidationException::withMessages([
                'status' => 'Pengajuan ini sudah diproses.',
            ]);
        }

        $buku = Buku::whereKey($peminjaman->buku_id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($buku->stok < 1) {
            throw ValidationException::withMessages([
                'stok' => 'Stok buku sudah habis.',
            ]);
        }

        // Kurangi stok satu buku.
        $buku->decrement('stok');

        // Jatuh tempo 7 hari setelah persetujuan.
        $tanggalJatuhTempo = now()->addDays(7)->toDateString();

        $peminjaman->update([
            'status' => 'dipinjam',
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
        ]);
    });

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Peminjaman berhasil disetujui. Stok buku telah diperbarui.');
}

public function tolak(Peminjaman $peminjaman)
{
    if ($peminjaman->status !== 'menunggu') {
        return back()->with(
            'error',
            'Pengajuan ini sudah diproses sebelumnya.'
        );
    }

    $peminjaman->update([
        'status' => 'ditolak',
    ]);

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Pengajuan peminjaman berhasil ditolak.');
}

public function prosesPengembalian(Peminjaman $peminjaman)
{
    DB::transaction(function () use ($peminjaman) {

        $peminjaman = Peminjaman::whereKey($peminjaman->id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($peminjaman->status !== 'dipinjam') {
            throw ValidationException::withMessages([
                'status' => 'Hanya buku yang sedang dipinjam yang dapat dikembalikan.',
            ]);
        }

        // Pastikan belum pernah diproses pengembaliannya.
        $sudahDikembalikan = Pengembalian::where(
            'peminjaman_id',
            $peminjaman->id
        )->exists();

        if ($sudahDikembalikan) {
            throw ValidationException::withMessages([
                'pengembalian' => 'Pengembalian buku ini sudah tercatat.',
            ]);
        }

        $buku = Buku::whereKey($peminjaman->buku_id)
            ->lockForUpdate()
            ->firstOrFail();

        // Catat pengembalian aktual.
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tanggal_pengembalian' => now()->toDateString(),
            'denda' => 0,
        ]);

        // Tambahkan stok buku satu.
        $buku->increment('stok');

        // Tandai transaksi selesai.
        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);
    });

    return redirect()
        ->route('peminjaman.index')
        ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
