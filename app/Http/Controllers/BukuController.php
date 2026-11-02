<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(10);

        return view('admin.dataBuku', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bookCreate');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|integer',
        'stok' => 'required|integer|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Upload gambar
    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')
            ->store('buku', 'public');
    }

    Buku::create($validated);

    return redirect()->back()
        ->with('success', 'Buku berhasil ditambahkan!');
}

    public function show(Buku $buku)
    {
        return view('admin.buku', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        return view('admin.bookEdit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Book updated successfully.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Book deleted successfully.');
    }
}
