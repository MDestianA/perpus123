<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <nav x-data="{ open: false }" class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16 px-9 shadow-md">

                <!-- Logo -->
                <div>
                    <a href="#dashboard" class="text-2xl font-bold text-blue-600">
                        MyWebsite
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8">
                    <a href="#dashboard" class="font-medium  text-gray-700 hover:text-blue-600">
                        Home
                    </a>
                    <a href="#about" class="font-medium  text-gray-700 hover:text-blue-600">
                        About
                    </a>
                    <a href="#services" class="font-medium  text-gray-700 hover:text-blue-600">
                        Services
                    </a>
                    <a href="#contact" class="font-medium  text-gray-700 hover:text-blue-600">
                        Contact
                    </a>
                </div>

                <!-- Login Desktop -->
                <div class="hidden md:block">
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                </div>

                <!-- Hamburger Button -->
                <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg font-medium  text-gray-700 hover:bg-gray-100">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition class="md:hidden border-t border-gray-200 py-3">

                <div class="flex flex-col space-y-3">
                    <a href="#dashboard" class="px-2 py-2 hover:bg-gray-100 rounded">
                        Home
                    </a>

                    <a href="#about" class="px-2 py-2 hover:bg-gray-100 rounded">
                        About
                    </a>

                    <a href="/services" class="px-2 py-2 hover:bg-gray-100 rounded">
                        Services
                    </a>

                    <a href="#contact" class="px-2 py-2 hover:bg-gray-100 rounded">
                        Contact
                    </a>

                    <a href="" class="bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
    {{-- dashboard --}}
    <div id="dashboard" class="flex flex-col md:flex-row mt-24 items-center justify-between px-9 pt-27  pb-10 shadow-md">

        <!-- Konten Kiri -->
        <div class="md:w-1/2 ">
            <h1 class="text-4xl font-bold text-blue-700 mb-4 ">
                Selamat Datang di Perpustakaan Digital
            </h1>

            <p class="text-gray-600 text-lg mb-6">
                Temukan berbagai koleksi buku, jurnal, dan referensi akademik
                dengan mudah. Kelola peminjaman dan pengembalian buku secara
                cepat melalui sistem perpustakaan digital.
            </p>

            <div class="flex gap-4">
                <a href="#" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Lihat Katalog
                </a>

                <a href="#" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <!-- Gambar Kanan -->
        <div class="hidden md:flex md:w-1/2 justify-center">
            <img src="{{ asset('images/book.jpg') }}" alt="Perpustakaan" class="w-full max-w-lg rounded-2xl shadow-lg">
        </div>

    </div>

    {{-- 2 --}}
    <div id="about" class="flex items-center justify-center mb-6 pt-25 mt-10 px-9">
        <div class="md:w-1/2 text-center md:text-left mb-3">
            <h1 class="text-2xl text-center font-bold mb-2">
                Selamat Datang di Perpustakaan
            </h1>
            <p class="text-gray-600 text-center">
                Kelola buku, anggota, dan peminjaman dengan mudah.
            </p>
        </div>

    </div>

    <div class="flex flex-col md:flex-row items-center justify-center mx-5 my-4 gap-6 md:gap-16">
        <div class="flex flex-col items-center gap-3 p-6 rounded-xl">
            <i class="fa-solid fa-book-open text-blue-600 text-3xl"></i>
            <span class="text-lg font-serif text-center">
                Koleksi Lengkap
            </span>
            <p class="text-sm text-center">
                Ribuan buku, e-book, jurnal, dan referensi akademik tersedia untuk mendukung kegiatan belajar.
            </p>
        </div>

        <div class="flex flex-col items-center gap-3 p-6">
            <i class="fa-solid fa-tv text-3xl text-blue-600"></i>
            <span class="text-lg font-serif text-center">
                Akses Digital
            </span>
            <p class="text-sm text-center text-gray-600">
                Akses koleksi perpustakaan kapan saja dan di mana saja melalui perangkat yang terhubung ke internet.
            </p>
        </div>

        <div class="flex flex-col items-center gap-3 p-6">
            <i class="fa-solid fa-people-group text-3xl text-blue-600"></i>
            <span class="text-lg font-serif text-center">
                Ruang Belajar
            </span>
            <p class="text-sm text-center text-gray-600">
                Nikmati lingkungan belajar yang nyaman untuk membaca, berdiskusi, dan mengembangkan pengetahuan.
            </p>
        </div>

        <div class="flex flex-col items-center gap-3 p-6">
            <i class="fa-solid fa-headset text-3xl text-blue-600"></i>
            <span class="text-lg font-serif text-center">
                Bantuan Perpustakaan
            </span>
            <p class="text-sm text-center text-gray-600">
                Tim pustakawan siap membantu pencarian referensi, peminjaman, dan penggunaan layanan perpustakaan.
            </p>
        </div>
    </div>
    </div>

    {{-- 3 --}}

    <div class="mx-5 mt-16 p-2 flex justify-between">
        <div class="">
            <h1 class="text-2xl font-serif weight-bold mb-2">Koleksi populer</h1>
            <p class="text-sm">Koleksi yang banyak dicari
        </div>
        <h1>Koleksi populer
    </div>

    <div class="flex mx-5 mt-6 gap-5 overflow-x-auto pb-4 scrollbar-hide">

        <!-- Buku 1 -->
        <div class="min-w-45 bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">Atomic Habits</h3>
                <p class="text-xs text-gray-500">James Clear</p>
            </div>
        </div>

        <!-- Buku 2 -->
        <div class="min-w-[180px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">Clean Code</h3>
                <p class="text-xs text-gray-500">Robert C. Martin</p>
            </div>
        </div>

        <!-- Buku 3 -->
        <div class="min-w-[180px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">Deep Work</h3>
                <p class="text-xs text-gray-500">Cal Newport</p>
            </div>
        </div>

        <!-- Buku 4 -->
        <div class="min-w-[180px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1524578271613-d550eacf6090?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">The Pragmatic Programmer</h3>
                <p class="text-xs text-gray-500">Andrew Hunt</p>
            </div>
        </div>

        <!-- Buku 5 -->
        <div class="min-w-[180px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1524578271613-d550eacf6090?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">Refactoring</h3>
                <p class="text-xs text-gray-500">Martin Fowler</p>
            </div>
        </div>

        <!-- Buku 6 -->
        <div class="min-w-[180px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
            <img src="https://images.unsplash.com/photo-1524578271613-d550eacf6090?w=400" alt="Buku"
                class="w-36 h-52 object-cover">

            <div class="p-3">
                <h3 class="font-semibold text-sm">Laravel Up & Running</h3>
                <p class="text-xs text-gray-500">Matt Stauffer</p>
            </div>
        </div>

    </div>

    {{-- footer --}}
    <footer class="bg-gray-800 mt-10 text-white">
    <div class="max-w-7xl mx-auto flex flex-wrap gap-8 px-10 py-10">

        <!-- Tentang -->
        <div class="w-64">
            <h3 class="text-xl font-bold mb-4 text-blue-400">
                <i class="fa-solid fa-book-open mr-2"></i>
                Perpustakaan Digital
            </h3>

            <p class="text-gray-300 text-sm leading-6">
                Perpustakaan Digital menyediakan ribuan koleksi buku,
                jurnal, dan referensi yang dapat diakses kapan saja
                dan di mana saja untuk mendukung kegiatan belajar.
            </p>
        </div>

        <!-- Menu -->
        <div class="w-64">
            <h3 class="text-lg font-semibold mb-4">Menu</h3>

            <ul class="space-y-2 text-gray-300">
                <li><a href="#" class="hover:text-blue-400">Beranda</a></li>
                <li><a href="#" class="hover:text-blue-400">Katalog Buku</a></li>
                <li><a href="#" class="hover:text-blue-400">Kategori</a></li>
                <li><a href="#" class="hover:text-blue-400">Tentang Kami</a></li>
            </ul>
        </div>

        <!-- Layanan -->
        <div class="w-64">
            <h3 class="text-lg font-semibold mb-4">Layanan</h3>

            <ul class="space-y-2 text-gray-300">
                <li>Peminjaman Buku</li>
                <li>Reservasi Buku</li>
                <li>E-Book</li>
                <li>Jurnal Online</li>
            </ul>
        </div>

        <!-- Kontak -->
        <div id="contact" class="w-64">
            <h3 class="text-lg font-semibold mb-4">Kontak</h3>

            <ul class="space-y-3 text-gray-300">
                <li>
                    <i class="fa-solid fa-location-dot mr-2 text-blue-400"></i>
                    Jl. Pendidikan No. 123
                </li>

                <li>
                    <i class="fa-solid fa-phone mr-2 text-blue-400"></i>
                    (021) 12345678
                </li>

                <li>
                    <i class="fa-solid fa-envelope mr-2 text-blue-400"></i>
                    info@perpustakaan.id
                </li>
            </ul>
        </div>

        <!-- Sosial Media -->
        <div class="w-64">
            <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>

            <div class="flex gap-4 text-2xl">
                <a href="#" class="hover:text-blue-400">
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="#" class="hover:text-pink-500">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#" class="hover:text-sky-400">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#" class="hover:text-red-500">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-700 text-center py-4 text-gray-400 text-sm">
        © 2026 Perpustakaan Digital. All Rights Reserved.
    </div>
</footer>

</body>

</html>
