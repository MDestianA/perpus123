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
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-book w-5"></i>

                    Data Buku
                </a>

                <!-- Peminjaman -->
                <a href="{{ route('anggota.peminjaman') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    bg-blue-50 text-blue-600 font-medium mb-2">

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

        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Peminjaman Saya
                </h1>

                <p class="mt-2 text-gray-500">
                    Pantau status pengajuan peminjaman buku kamu.
                </p>
            </div>

            <a href="{{ route('anggota.buku') }}"
               class="rounded-lg bg-blue-600 px-5 py-3 text-center font-semibold text-white hover:bg-blue-700">
                Cari Buku
            </a>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($peminjaman->isEmpty())
            <div class="rounded-xl bg-white p-10 text-center shadow-sm">
                <h2 class="text-xl font-semibold text-gray-700">
                    Belum Ada Pengajuan
                </h2>

                <p class="mt-2 text-gray-500">
                    Kamu belum mengajukan peminjaman buku.
                </p>

                <a href="{{ route('anggota.buku') }}"
                   class="mt-5 inline-block rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
                    Lihat Katalog Buku
                </a>
            </div>
        @else
            <div class="overflow-x-auto rounded-xl bg-white shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-5 py-4">No.</th>
                            <th class="px-5 py-4">Judul Buku</th>
                            <th class="px-5 py-4">Tanggal Pengajuan</th>
                            <th class="px-5 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($peminjaman as $item)
                            <tr>
                                <td class="px-5 py-4">
                                    {{ $peminjaman->firstItem() + $loop->index }}
                                </td>

                                <td class="px-5 py-4 font-medium text-gray-800">
                                    {{ $item->buku->judul ?? 'Buku tidak ditemukan' }}
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ $item->tanggal_pinjam }}
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                        $status = strtolower($item->status ?? 'menunggu');

                                        $warna = match ($status) {
                                            'disetujui', 'dipinjam' => 'bg-green-100 text-green-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                            'dikembalikan' => 'bg-blue-100 text-blue-700',
                                            default => 'bg-yellow-100 text-yellow-700',
                                        };
                                    @endphp

                                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $warna }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $peminjaman->links() }}
            </div>
        @endif

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



       