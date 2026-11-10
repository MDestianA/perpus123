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
                    <a href="/dashboard" class="text-xl font-bold text-blue-600">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Perpustakaan Digital
                    </a>

                </div>

                <!-- Kanan -->
                <div class="flex items-center gap-4">



                    <!-- User -->
                    <div class="hidden md:flex items-center gap-3">



                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div class="flex flex-col">
                            <a href="{{ route('anggota.profil') }}"
                                class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition">
                                {{ Auth::user()->name }}
                            </a>

                            <a href="{{ route('anggota.profil') }}"
                                class="text-xs text-gray-500 hover:text-blue-500 transition">
                                {{ ucfirst(Auth::user()->role) }}
                            </a>
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
                    bg-blue-50 text-blue-600 font-medium mb-2">

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

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-1">
                    Selamat datang kembali, anggota.
                    Kelola perpustakaan melalui dashboard ini.
                </p>

            </div>


            <!-- ================= STATISTIK ================= -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                <!-- Sedang Dipinjam -->
                <div class="bg-white rounded-xl shadow-sm p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Sedang Dipinjam
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalPeminjaman }}
                            </h2>

                            <p class="text-xs text-blue-600 mt-2">
                                <i class="fa-solid fa-book"></i>
                                Buku sedang dipinjam
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-lg bg-yellow-100
                            text-yellow-600 flex items-center justify-center">

                            <i class="fa-solid fa-book-open text-xl"></i>

                        </div>

                    </div>

                </div>


            </div>


            <!-- ================= CONTENT GRID ================= -->
 @if (session('success'))
                        <div class="mb-5 rounded-lg bg-green-100 p-4 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                <!-- Peminjaman Terbaru -->

                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm">

                    <div class="p-5 border-b border-gray-200
                        flex justify-between items-center">

                        <div>

                            <h2 class="font-bold text-gray-800">
                                Peminjaman Terbaru
                            </h2>

                            <p class="text-sm text-gray-500">
                                Daftar transaksi peminjaman terbaru
                            </p>

                        </div>

                        <a href="/anggota/loans" class="text-sm text-blue-600 hover:text-blue-800">
                            Lihat semua
                        </a>

                    </div>

                   

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
                        <div class="overflow-x-auto">

                            <table class="w-full text-sm">

                                <thead class="bg-gray-50">

                                    <tr>

                                        <th class="text-left px-5 py-3 text-gray-500">
                                            No
                                        </th>

                                        <th class="text-left px-5 py-3 text-gray-500">
                                            Buku
                                        </th>

                                        <th class="text-left px-5 py-3 text-gray-500">
                                            Tanggal Pengajuan
                                        </th>

                                        <th class="text-left px-5 py-3 text-gray-500">
                                            Status
                                        </th>

                                    </tr>

                                </thead>

                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($peminjaman as $item)
                                        <tr class="hover:bg-gray-50">

                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-3">

                                                    {{ $peminjaman->firstItem() + $loop->index }}



                                                </div>

                                            </td>

                                            <td class="px-5 py-4">
                                                {{ $item->buku->judul ?? 'Buku tidak ditemukan' }}
                                            </td>

                                            <td class="px-5 py-4 text-gray-500">
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

                                                <span
                                                    class="rounded-full px-3 py-1 text-xs font-semibold {{ $warna }}">
                                                    {{ ucfirst($status) }}
                                                </span>

                                            </td>

                                        </tr>
                                    @endforeach








                                </tbody>

                            </table>
                            <div class="mt-6">
                                {{ $peminjaman->links() }}
                            </div>
                    @endif
                </div>

            </div>




    </div>



    </main>

    </div>

</body>

</html>
