
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

                    <!-- Notifikasi -->
                    <button class="relative text-gray-600 hover:text-blue-600">
                        <i class="fa-solid fa-bell text-lg"></i>

                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5">
                            3
                        </span>
                    </button>

                    <!-- User -->
                    <div class="hidden md:flex items-center gap-2">

                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-700">
                                Anggota
                            </p>

                            <p class="text-xs text-gray-500">
                                Anggota
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
                <a href="/dashboard"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-chart-line w-5"></i>

                    Dashboard
                </a>


                <!-- Buku -->
                <a href="/buku"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

                    <i class="fa-solid fa-book w-5"></i>

                    Data Buku
                </a>

                <!-- Aanggota -->
                <a href="/anggota"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                    bg-blue-50 text-blue-600 font-medium mb-2">

                    <i class="fa-solid fa-user w-5"></i>

                    Data Anggota
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
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Data Anggota
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Daftar anggota perpustakaan
        </p>
    </div>

    <div class="pt-20 md:ml-64 px-6 pb-10">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Data Anggota
        </h1>
        <p class="text-sm text-gray-500">
            Daftar anggota perpustakaan
        </p>
    </div>

    {{-- Card Anggota --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Anggota 1 --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-full bg-blue-100
                            text-blue-600 flex items-center justify-center">
                    <i class="fa-solid fa-user text-xl"></i>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-800">
                        Budi Santoso
                    </h2>

                    <p class="text-sm text-gray-500">
                        budi@gmail.com
                    </p>
                </div>

            </div>

            <div class="mt-5 border-t pt-4">
                <span class="text-xs bg-blue-100 text-blue-600
                             px-3 py-1 rounded-full">
                    Anggota
                </span>
            </div>
        </div>


    </div>

</div>
</div>

     
    </div>

</body>

</html>
