```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <title>Dashboard - Perpustakaan Digital</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: false }">

        <!-- ================= NAVBAR ================= -->
        <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">

            <div class="h-16 flex items-center justify-between px-6">

                <!-- Kiri -->
                <div class="flex items-center gap-4">

                    <!-- Hamburger -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-600 hover:text-blue-600 text-xl">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <!-- Logo -->
                    <a href="/dashboard"
                        class="text-xl font-bold text-blue-600">
                        <i class="fa-solid fa-book-open mr-2"></i>
                        Perpustakaan Digital
                    </a>

                </div>

                <!-- Kanan -->
                <div class="flex items-center gap-4">

                   

                    <!-- User -->
                    <div class="hidden md:flex items-center gap-2">

                        <div
                            class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
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
                                25
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


            </div>


            <!-- ================= CONTENT GRID ================= -->

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

                        <a href="/anggota/loans"
                            class="text-sm text-blue-600 hover:text-blue-800">
                            Lihat semua
                        </a>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="text-left px-5 py-3 text-gray-500">
                                        Anggota
                                    </th>

                                    <th class="text-left px-5 py-3 text-gray-500">
                                        Buku
                                    </th>

                                    <th class="text-left px-5 py-3 text-gray-500">
                                        Tanggal
                                    </th>

                                    <th class="text-left px-5 py-3 text-gray-500">
                                        Status
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">


                                <tr class="hover:bg-gray-50">

                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 bg-blue-100 text-blue-600
                                                rounded-full flex items-center justify-center">

                                                <i class="fa-solid fa-user"></i>

                                            </div>

                                            <span class="font-medium">
                                                Budi
                                            </span>

                                        </div>

                                    </td>

                                    <td class="px-5 py-4">
                                        Atomic Habits
                                    </td>

                                    <td class="px-5 py-4 text-gray-500">
                                        12 Sep 2026
                                    </td>

                                    <td class="px-5 py-4">

                                        <span
                                            class="px-3 py-1 rounded-full
                                            bg-yellow-100 text-yellow-700 text-xs">

                                            Dipinjam

                                        </span>

                                    </td>

                                </tr>


                                <tr class="hover:bg-gray-50">

                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 bg-green-100 text-green-600
                                                rounded-full flex items-center justify-center">

                                                <i class="fa-solid fa-user"></i>

                                            </div>

                                            <span class="font-medium">
                                                Andi
                                            </span>

                                        </div>

                                    </td>

                                    <td class="px-5 py-4">
                                        Clean Code
                                    </td>

                                    <td class="px-5 py-4 text-gray-500">
                                        11 Sep 2026
                                    </td>

                                    <td class="px-5 py-4">

                                        <span
                                            class="px-3 py-1 rounded-full
                                            bg-green-100 text-green-700 text-xs">

                                            Dikembalikan

                                        </span>

                                    </td>

                                </tr>


                                <tr class="hover:bg-gray-50">

                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-9 h-9 bg-purple-100 text-purple-600
                                                rounded-full flex items-center justify-center">

                                                <i class="fa-solid fa-user"></i>

                                            </div>

                                            <span class="font-medium">
                                                Siti
                                            </span>

                                        </div>

                                    </td>

                                    <td class="px-5 py-4">
                                        Deep Work
                                    </td>

                                    <td class="px-5 py-4 text-gray-500">
                                        10 Sep 2026
                                    </td>

                                    <td class="px-5 py-4">

                                        <span
                                            class="px-3 py-1 rounded-full
                                            bg-red-100 text-red-700 text-xs">

                                            Terlambat

                                        </span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>


                <!-- Buku Populer -->

                <div class="bg-white rounded-xl shadow-sm">

                    <div class="p-5 border-b border-gray-200">

                        <h2 class="font-bold text-gray-800">
                            Buku Populer
                        </h2>

                        <p class="text-sm text-gray-500">
                            Buku yang sering dipinjam
                        </p>

                    </div>


                    <div class="p-5 space-y-5">


                        <div class="flex items-center gap-4">

                            <div
                                class="w-12 h-14 bg-blue-100 rounded-lg
                                flex items-center justify-center text-blue-600">

                                <i class="fa-solid fa-book text-xl"></i>

                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-sm">
                                    Atomic Habits
                                </h3>

                                <p class="text-xs text-gray-500">
                                    James Clear
                                </p>

                                <p class="text-xs text-blue-600 mt-1">
                                    35 kali dipinjam
                                </p>

                            </div>

                        </div>


                        <div class="flex items-center gap-4">

                            <div
                                class="w-12 h-14 bg-green-100 rounded-lg
                                flex items-center justify-center text-green-600">

                                <i class="fa-solid fa-book text-xl"></i>

                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-sm">
                                    Clean Code
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Robert C. Martin
                                </p>

                                <p class="text-xs text-blue-600 mt-1">
                                    29 kali dipinjam
                                </p>

                            </div>

                        </div>


                        <div class="flex items-center gap-4">

                            <div
                                class="w-12 h-14 bg-purple-100 rounded-lg
                                flex items-center justify-center text-purple-600">

                                <i class="fa-solid fa-book text-xl"></i>

                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-sm">
                                    Deep Work
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Cal Newport
                                </p>

                                <p class="text-xs text-blue-600 mt-1">
                                    24 kali dipinjam
                                </p>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


         
        </main>

    </div>

</body>

</html>
```
