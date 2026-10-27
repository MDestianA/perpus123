```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <title>Dashboard - Perpustakaan Digital</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }">

        <!-- ================= NAVBAR ================= -->
        <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">

            <div class="h-16 flex items-center justify-between px-6">

                <!-- Kiri -->
                <div class="flex items-center gap-4">

                    <!-- Hamburger -->
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-blue-600 text-xl">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <!-- Logo -->
                    <a href="/anggota/dashboard" class="text-xl font-bold text-blue-600">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Perpustakaan Digital
                    </a>

                </div>

                <!-- Kanan -->
                <div class="flex items-center gap-4">

                   
                    <!-- User -->
                    <div class="hidden md:flex items-center gap-2">

                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>

                         <div>
                            <p class="text-sm font-semibold text-gray-700">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ ucfirst(Auth::user()->role) }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </nav>


        <!-- ================= SIDEBAR ================= -->

        <aside
            class="fixed top-16 left-0 h-[calc(100vh-4rem)]
            w-64 bg-white shadow-md z-40
            transform transition-transform duration-300
            md:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <div class="p-5">

                <p class="text-xs font-semibold text-gray-400 uppercase mb-4">
                    Menu Utama
                </p>

                <!-- Dashboard -->
                <a href="{{ route('anggota.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-chart-line w-5"></i>

                    Dashboard
                </a>


                <!-- Buku -->
                <a href="{{ route('anggota.buku') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    bg-blue-50 text-blue-600 font-medium mb-2">

                    <i class="fa-solid fa-book w-5"></i>

                    Data Buku
                </a>

                <!-- Peminjaman -->
                <a href="{{ route('anggota.peminjaman') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-user w-5"></i>

                    Data Peminjaman
                </a>




                <div class="border-t border-gray-200 my-5"></div>


                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3
                        rounded-lg text-red-500 hover:bg-red-50">

                        <i class="fa-solid fa-right-from-bracket w-5"></i>

                        Logout
                    </button>

                </form>

            </div>

        </aside>


        <!-- ================= CONTENT ================= -->

        <main class="pt-20 md:ml-64 px-6 pb-10">

            @if (session('success'))
            <div class="mb-5 rounded-lg border border-green-200 bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-5 rounded-lg border border-red-200 bg-red-100 p-4 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-5 rounded-lg border border-red-200 bg-red-100 p-4 text-red-700">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('anggota.buku') }}" method="GET"
              class="mb-8 flex flex-col gap-3 sm:flex-row">

            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul atau penulis buku..."
                    class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-11 pr-4 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
            </div>

            <button type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700">
                Cari Buku
            </button>

            @if (request('search'))
                <a href="{{ route('anggota.buku') }}"
                   class="rounded-xl bg-gray-200 px-6 py-3 text-center text-gray-700 hover:bg-gray-300">
                    Reset
                </a>
            @endif
        </form>

        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">
                Koleksi Buku
            </h2>

            <span class="text-sm text-gray-500">
                {{ $buku->total() }} buku ditemukan
            </span>
        </div>

        @if ($buku->isEmpty())
            <div class="rounded-2xl bg-white p-12 text-center shadow-sm">
                <i class="fa-solid fa-book-open mb-4 text-5xl text-gray-300"></i>

                <h3 class="text-xl font-semibold text-gray-700">
                    Buku tidak ditemukan
                </h3>

                <p class="mt-2 text-gray-500">
                    Coba gunakan kata kunci pencarian lain.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($buku as $item)
                    <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-48 items-center justify-center bg-blue-50">
                            <i class="fa-solid fa-book-open text-6xl text-blue-300"></i>
                        </div>

                        <div class="flex flex-1 flex-col p-5">

                            <h3 class="mb-2 text-lg font-bold text-gray-800">
                                {{ $item->judul }}
                            </h3>

                            <p class="mb-1 text-sm text-gray-600">
                                <i class="fa-solid fa-user-pen mr-2 text-blue-500"></i>
                                {{ $item->penulis }}
                            </p>

                            <p class="mb-1 text-sm text-gray-600">
                                <i class="fa-solid fa-building mr-2 text-blue-500"></i>
                                {{ $item->penerbit }}
                            </p>

                            <p class="mb-4 text-sm text-gray-600">
                                <i class="fa-solid fa-calendar mr-2 text-blue-500"></i>
                                Tahun {{ $item->tahun_terbit }}
                            </p>

                            <div class="mb-4">
                                @if ($item->stok > 0)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Stok tersedia: {{ $item->stok }}
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Stok habis
                                    </span>
                                @endif
                            </div>

                            <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
    @csrf

    <input type="hidden" name="buku_id" value="{{ $item->id }}">

    <label for="tanggal_pinjam" class="block mb-2">
        Tanggal Pinjam
    </label>

    <input
        type="date"
        id="tanggal_pinjam"
        name="tanggal_pinjam"
        min="{{ date('Y-m-d') }}"
        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
        required
        class="w-full rounded border p-2 mb-3"
    >

    <button
        type="submit"
        class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
        {{ $item->stok < 1 ? 'disabled' : '' }}
    >
        Ajukan Peminjaman
    </button>
</form>

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="mt-8">
                {{ $buku->links() }}
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('anggota.peminjaman') }}"
               class="inline-flex items-center gap-2 font-semibold text-blue-600 hover:text-blue-800">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Lihat Pengajuan Peminjaman Saya
            </a>
        </div>
        </main>

    </div>

</body>

</html>
```
{{-- ```blade
<div class="w-full mx-auto p-6 bg-gray-100 rounded-xl shadow-lg">

    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">
        Pokedex
    </h1>

    {{-- Search --}}
{{-- <div class="mb-6 text-center">
        <form action="{{ route('pokedex.index') }}" method="GET">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search Pokémon"
                class="p-2 border rounded-lg w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <button
                type="submit"
                class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600"
            >
                Search
            </button>
        </form>
    </div> --}}

{{-- Tidak ada Pokémon --}}
{{-- @if ($pokemonData->isEmpty())
        <p class="text-center">
            No Pokémon found...
        </p>
    @endif --}}

{{-- Card Pokémon --}}
{{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach ($pokemonData as $pokemon)

            <a href="{{ route('pokedex.show', $pokemon->id) }}"
               class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

                <img
                    src="{{ $pokemon->image }}"
                    alt="{{ $pokemon->name }}"
                    class="w-full h-40 object-contain"
                >

                <h2 class="text-center font-bold mt-3">
                    {{ ucfirst($pokemon->name) }}
                </h2>

            </a>

        @endforeach

    </div> --}}

{{-- Pagination --}}
{{-- <div class="flex justify-center mt-6 gap-4">

        @if ($pokemonData->onFirstPage())
            <button
                disabled
                class="bg-gray-300 text-gray-800 p-2 rounded-lg opacity-70"
            >
                Previous
            </button>
        @else
            <a
                href="{{ $pokemonData->previousPageUrl() }}"
                class="bg-gray-300 text-gray-800 p-2 rounded-lg hover:bg-gray-400"
            >
                Previous
            </a>
        @endif


        @if ($pokemonData->hasMorePages())
            <a
                href="{{ $pokemonData->nextPageUrl() }}"
                class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600"
            >
                Next
            </a>
        @else
            <button
                disabled
                class="bg-blue-500 text-white p-2 rounded-lg opacity-50"
            >
                Next
            </button>
        @endif

    </div> --}}

{{-- </div> --}} --
```
