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
                    <a href="/admin/dashboard" class="text-xl font-bold text-blue-600">
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
            "
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <div class="p-5">

                <p class="text-xs font-semibold text-gray-400 uppercase mb-4">
                    Menu Utama
                </p>

                <!-- Dashboard -->
                <a href="/admin/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    bg-blue-50 text-blue-600 font-medium mb-2">

                    <i class="fa-solid fa-chart-line w-5"></i>

                    Dashboard
                </a>


                <!-- Buku -->
                <a href="{{ route('buku.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-book w-5"></i>

                    Data Buku
                </a>


                <!-- Anggota -->
                <a href="{{ route('anggota.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-users w-5"></i>

                    Data Anggota
                </a>


                <!-- Peminjaman -->
                <a href="{{ route('peminjaman.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-hand-holding-heart w-5"></i>

                    Peminjaman
                </a>


                <!-- Pengembalian -->
                <a href="{{ route('pengembalian.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-rotate-left w-5"></i>

                    Pengembalian
                </a>


                <!-- Laporan -->
                {{-- <a href="/admin/reports"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-file-lines w-5"></i>

                    Laporan
                </a> --}}


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

        <main class="pt-20 px-6 pb-10 transition-all duration-300" :class="sidebarOpen ? 'md:ml-64' : 'md:ml-0'">

            <!-- Header -->
            <div class="mb-6">

                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-1">
                    Selamat datang kembali, Admin.
                    Kelola perpustakaan melalui dashboard ini.
                </p>

            </div>


            <!-- ================= STATISTIK ================= -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

                <!-- Total Buku -->
                <div class="bg-white rounded-xl shadow-sm p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Buku
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalBuku }}
                            </h2>

                           

                        </div>

                        <div
                            class="w-12 h-12 rounded-lg bg-blue-100
                            text-blue-600 flex items-center justify-center">

                            <i class="fa-solid fa-book text-xl"></i>

                        </div>

                    </div>

                </div>


                <!-- Total Anggota -->
                <div class="bg-white rounded-xl shadow-sm p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Anggota
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalAnggota }}
                            </h2>

                          

                        </div>

                        <div
                            class="w-12 h-12 rounded-lg bg-green-100
                            text-green-600 flex items-center justify-center">

                            <i class="fa-solid fa-users text-xl"></i>

                        </div>

                    </div>

                </div>


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
                                <i class="fa-solid fa-book-open"></i>
                                Buku sedang dipinjam
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-lg bg-yellow-100
                            text-yellow-600 flex items-center justify-center">

                            <i class="fa-solid fa-hand-holding-heart text-xl"></i>

                        </div>

                    </div>

                </div>


                {{-- <!-- Terlambat -->
                <div class="bg-white rounded-xl shadow-sm p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Terlambat
                            </p>

                            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                                4
                            </h2>

                            <p class="text-xs text-red-600 mt-2">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                Perlu ditindaklanjuti
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-lg bg-red-100
                            text-red-600 flex items-center justify-center">

                            <i class="fa-solid fa-clock text-xl"></i>

                        </div>

                    </div>

                </div> --}}

            </div>


            <!-- ================= CONTENT GRID ================= -->

          


                <!-- Peminjaman Terbaru -->

                 <table class="w-full text-sm">

                <!-- Header -->
                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-5 py-4 text-left font-semibold text-gray-600">
                            No
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-600">
                            Nama Peminjam
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-600">
                            Judul
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-600">
                            Tanggal Pinjam
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-600">
                            Tanggal Jatuh Tempo
                        </th>

                        <th class="px-5 py-4 text-center font-semibold text-gray-600">
                            Status
                        </th>

                       
                    </tr>

                </thead>


                <!-- Data -->
                <tbody class="divide-y divide-gray-100">
        @forelse ($peminjaman as $index => $item)
            <tr class="hover:bg-gray-50">
                <!-- Nomor -->
                <td class="px-5 py-4">
                    {{ $peminjaman->firstItem() + $index }}
                </td>

                <!-- Nama -->
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full
                                    bg-blue-100 text-blue-600
                                    flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <span class="font-medium text-gray-800">
                            {{ $item->user_id }}
                        </span>
                    </div>
                </td>

                <!--  -->
                <td class="px-5 py-4 text-gray-600">
                    {{ $item->buku_id }}
                </td>

                <!--  -->
                <td class="px-5 py-4 text-gray-600">
                    {{ $item->tanggal_pinjam }}
                </td>

                <!--  -->
                <td class="px-5 py-4 text-gray-600">
                    {{ $item->tanggal_kembali }}
                </td>
                <td class="px-5 py-4 text-gray-600">
                    {{ $item->status }}
                </td>

                
            </tr>
        @empty
            <tr>
                <td colspan="6"
                    class="px-5 py-8 text-center text-gray-500">
                    <i class="fa-solid fa-book text-3xl mb-3 block"></i>
                    Belum ada data Peminjaman.
                </td>
            </tr>
        @endforelse
    </tbody>

            </table>
             <!-- Pagination -->
                    <div
                        class="flex flex-col sm:flex-row items-center justify-between
            gap-4 px-5 py-4 border-t border-gray-200">

                        <p class="text-sm text-gray-500">
                            Menampilkan
                            {{ $peminjaman->firstItem() ?? 0 }}
                            sampai
                            {{ $peminjaman->lastItem() ?? 0 }}
                            dari
                            {{ $peminjaman->total() }} peminjaman
                        </p>

                        <div>
                            {{ $peminjaman->links() }}
                        </div>

                    </div>


              
            </div>


           
        </main>

    </div>

</body>

</html>
```
