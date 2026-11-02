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

    public function index()
    {
        // Mengambil data peminjaman beserta nama anggota dan judul buku.
        $peminjaman = Peminjaman::with(['buku', 'user'])
            ->latest()
            ->paginate(10);

        // Mengirim data ke halaman admin.dataPeminjaman.
        return view('admin.dataPeminjaman', compact('peminjaman'));
    }



    public function storeAnggota(Request $request)
    {
        // Memvalidasi data yang dikirim melalui form.
        $validated = $request->validate([
            'buku_id' => ['required', 'integer', 'exists:buku,id'],
            'tanggal_pinjam' => ['required', 'date', 'after_or_equal:today'],
        ]);

        // Menjalankan transaksi database agar proses penyimpanan aman.
        DB::transaction(function () use ($validated) {

            // Mengambil data buku dan mengunci baris selama transaksi.
            $buku = Buku::whereKey($validated['buku_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Memeriksa apakah stok buku masih tersedia.
            if ($buku->stok < 1) {
                throw ValidationException::withMessages([
                    'buku_id' => 'Stok buku sedang habis.',
                ]);
            }

            // Mengubah tanggal peminjaman menjadi format Carbon.
            $tanggalPinjam = \Carbon\Carbon::parse($validated['tanggal_pinjam']);

            // Menghitung tanggal jatuh tempo, yaitu 7 hari setelah tanggal pinjam.
            $tanggalJatuhTempo = $tanggalPinjam->copy()->addDays(7);

            // Menyimpan pengajuan peminjaman ke database.
            Peminjaman::create([
                'user_id' => Auth::id(), // ID anggota yang sedang login.
                'buku_id' => $buku->id, // ID buku yang dipilih.
                'tanggal_pinjam' => $tanggalPinjam->toDateString(),
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo->toDateString(),
                'status' => 'menunggu', // Menunggu persetujuan admin.
            ]);
        });

        // Kembali ke halaman peminjaman anggota dengan pesan berhasil.
        return redirect()
            ->route('anggota.peminjaman')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim dan menunggu persetujuan admin.');
    }

    public function indexAnggota()
    {
        // Mengambil data berdasarkan ID anggota yang sedang login.
        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        // Mengirim data ke halaman anggota.peminjaman.
        return view('anggota.peminjaman', compact('peminjaman'));
    }


    public function setujui(Peminjaman $peminjaman)
    {
        // Transaksi memastikan perubahan stok dan peminjaman berjalan bersama.
        DB::transaction(function () use ($peminjaman) {

            // Mengambil dan mengunci data peminjaman.
            $peminjaman = Peminjaman::whereKey($peminjaman->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Hanya pengajuan dengan status menunggu yang bisa disetujui.
            if ($peminjaman->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'status' => 'Pengajuan ini sudah diproses.',
                ]);
            }

            // Mengambil dan mengunci data buku.
            $buku = Buku::whereKey($peminjaman->buku_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Memastikan stok masih tersedia sebelum peminjaman disetujui.
            if ($buku->stok < 1) {
                throw ValidationException::withMessages([
                    'stok' => 'Stok buku sudah habis.',
                ]);
            }

            // Mengurangi stok buku sebanyak 1.
            $buku->decrement('stok');

            // Menentukan batas pengembalian 7 hari setelah persetujuan.
            $tanggalJatuhTempo = now()->addDays(7)->toDateString();

            // Mengubah status dan tanggal jatuh tempo peminjaman.
            $peminjaman->update([
                'status' => 'dipinjam',
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
            ]);
        });

        // Kembali ke halaman admin dengan pesan berhasil.
        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui. Stok buku telah diperbarui.');
    }



    public function tolak(Peminjaman $peminjaman)
    {
        // Memastikan pengajuan belum pernah diproses.
        if ($peminjaman->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan ini sudah diproses sebelumnya.'
            );
        }

        // Mengubah status peminjaman menjadi ditolak.
        $peminjaman->update([
            'status' => 'ditolak',
        ]);

        // Kembali ke halaman admin dengan pesan berhasil.
        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }


 
    public function prosesPengembalian(Peminjaman $peminjaman)
    {
        // Menggunakan transaksi agar semua perubahan berhasil bersama.
        DB::transaction(function () use ($peminjaman) {

            // Mengambil dan mengunci data peminjaman.
            $peminjaman = Peminjaman::whereKey($peminjaman->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Hanya buku yang sedang dipinjam yang bisa dikembalikan.
            if ($peminjaman->status !== 'dipinjam') {
                throw ValidationException::withMessages([
                    'status' => 'Hanya buku yang sedang dipinjam yang dapat dikembalikan.',
                ]);
            }

            // Memeriksa apakah pengembalian sudah pernah dicatat.
            $sudahDikembalikan = Pengembalian::where(
                'peminjaman_id',
                $peminjaman->id
            )->exists();

            // Mencegah satu peminjaman memiliki pengembalian ganda.
            if ($sudahDikembalikan) {
                throw ValidationException::withMessages([
                    'pengembalian' => 'Pengembalian buku ini sudah tercatat.',
                ]);
            }

            // Mengambil data buku yang akan dikembalikan.
            $buku = Buku::whereKey($peminjaman->buku_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Menyimpan riwayat pengembalian ke tabel pengembalian.
            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => now()->toDateString(),
                'denda' => 0,
            ]);

            // Menambahkan stok buku sebanyak 1 karena buku sudah kembali.
            $buku->increment('stok');

            // Mengubah status peminjaman menjadi selesai.
            $peminjaman->update([
                'status' => 'dikembalikan',
            ]);
        });

        // Kembali ke halaman admin dengan pesan berhasil.
        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }


   

    // Menampilkan form tambah peminjaman.
    public function create()
    {
        //
    }

    // Menyimpan data peminjaman melalui resource route.
    public function store(Request $request)
    {
        //
    }

    // Menampilkan detail satu data peminjaman.
    public function show(string $id)
    {
        //
    }

    // Menampilkan form edit peminjaman.
    public function edit(string $id)
    {
        //
    }

    // Memperbarui data peminjaman.
    public function update(Request $request, string $id)
    {
        //
    }

    // Menghapus data peminjaman.
    public function destroy(string $id)
    {
        //
    }
}