
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Tambah Buku - Perpustakaan Digital</title>
</head>

<body class="min-h-screen bg-gray-100 py-10 px-4">

    <div class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-lg">

        <div class="mb-8 border-b border-gray-200 pb-5">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fa-solid fa-book-open mr-2 text-blue-600"></i>
                Tambah Buku
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Masukkan informasi buku yang ingin ditambahkan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                <p class="mb-2 font-semibold">Terjadi kesalahan!</p>
                <ul class="list-inside list-disc text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <div>
                <label for="judul" class="mb-2 block font-semibold text-gray-700">
                    Judul Buku
                </label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Masukkan judul buku"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <div>
                <label for="penulis" class="mb-2 block font-semibold text-gray-700">
                    Penulis
                </label>
                <input
                    type="text"
                    id="penulis"
                    name="penulis"
                    value="{{ old('penulis') }}"
                    placeholder="Masukkan nama penulis"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <div>
                <label for="penerbit" class="mb-2 block font-semibold text-gray-700">
                    Penerbit
                </label>
                <input
                    type="text"
                    id="penerbit"
                    name="penerbit"
                    value="{{ old('penerbit') }}"
                    placeholder="Masukkan nama penerbit"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            
            <div>
                <label for="tahun_terbit" class="mb-2 block font-semibold text-gray-700">
                    Tahun Terbit
                </label>
                <input
                    type="number"
                    id="tahun_terbit"
                    name="tahun_terbit"
                    value="{{ old('tahun_terbit') }}"
                    placeholder="Contoh: 2025"
                    min="1000"
                    max="2100"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>
            <div>
                <label for="stok" class="mb-2 block font-semibold text-gray-700">
                    Stok
                </label>
                <input
                    type="number"
                    id="stok"
                    name="stok"
                    value="{{ old('stok') }}"
                    placeholder="Contoh: 10"
                    min="1"
                    
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>
            <div>
                <label for="gambar" class="mb-2 block font-semibold text-gray-700">
                    Gambar Sampul Buku
                </label>
                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    accept="image/*"
                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:font-semibold file:text-white hover:file:bg-blue-700"
                >
                <p class="mt-2 text-xs text-gray-500">
                    Format gambar: JPG, JPEG, PNG, atau WEBP.
                </p>
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                <a
                    href="{{ url()->previous() }}"
                    class="rounded-lg border border-gray-300 px-6 py-3 text-center font-semibold text-gray-700 transition hover:bg-gray-100"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white shadow transition hover:bg-blue-700 focus:ring-4 focus:ring-blue-200"
                >
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Buku
                </button>
            </div>

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>
```