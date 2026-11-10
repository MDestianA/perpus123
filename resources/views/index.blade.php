<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>Perpustakaan Digital</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-white text-gray-700">

    <!-- NAVBAR -->
    <nav x-data="{ open: false }"
        class="bg-white shadow-md fixed top-0 left-0 w-full z-50">

        <div class="max-w-7xl mx-auto px-4">

            <div class="flex items-center justify-between h-16 px-4 md:px-9">

                <!-- Logo -->
                <div>
                    <a href="#dashboard"
                        class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition">
                        MyWebsite
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8">

                    <a href="#dashboard"
                        class="font-medium text-gray-700 hover:text-blue-600 transition duration-300">
                        Home
                    </a>

                    <a href="#about"
                        class="font-medium text-gray-700 hover:text-blue-600 transition duration-300">
                        About
                    </a>

                    <a href="#services"
                        class="font-medium text-gray-700 hover:text-blue-600 transition duration-300">
                        Services
                    </a>

                    <a href="#contact"
                        class="font-medium text-gray-700 hover:text-blue-600 transition duration-300">
                        Contact
                    </a>

                </div>

                <!-- Login Desktop -->
                <div class="hidden md:block">
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg
                        hover:bg-blue-700 transition duration-300 shadow-sm hover:shadow-md">
                        Login
                    </a>
                </div>

                <!-- Hamburger Button -->
                <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">

                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition
                @click.outside="open = false"
                class="md:hidden border-t border-gray-200 py-3">

                <div class="flex flex-col space-y-2">

                    <a href="#dashboard" @click="open = false"
                        class="px-3 py-2 hover:bg-gray-100 rounded transition">
                        Home
                    </a>

                    <a href="#about" @click="open = false"
                        class="px-3 py-2 hover:bg-gray-100 rounded transition">
                        About
                    </a>

                    <a href="#services" @click="open = false"
                        class="px-3 py-2 hover:bg-gray-100 rounded transition">
                        Services
                    </a>

                    <a href="#contact" @click="open = false"
                        class="px-3 py-2 hover:bg-gray-100 rounded transition">
                        Contact
                    </a>

                    <a href="{{ route('login') }}"
                        class="bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition">
                        Login
                    </a>

                </div>
            </div>

        </div>
    </nav>


    <!-- DASHBOARD / HERO -->
    <div id="dashboard"
        class="flex flex-col md:flex-row mt-16 items-center justify-between
        px-6 md:px-12 lg:px-16 py-16 md:py-24 gap-10 shadow-sm">

        <!-- Konten Kiri -->
        <div class="md:w-1/2">

            <h1 class="text-3xl md:text-4xl font-bold text-blue-700 mb-5 leading-tight">
                Selamat Datang di Perpustakaan Digital
            </h1>

            <p class="text-gray-600 text-base md:text-lg mb-7 leading-relaxed">
                Temukan berbagai koleksi buku, jurnal, dan referensi akademik
                dengan mudah. Kelola peminjaman dan pengembalian buku secara
                cepat melalui sistem perpustakaan digital.
            </p>

           

        </div>

        <!-- Gambar Kanan -->
        <div class="hidden md:flex md:w-1/2 justify-center">

            <img src="{{ asset('images/book.jpg') }}"
                alt="Perpustakaan"
                class="w-full max-w-lg h-80 object-cover rounded-2xl shadow-lg
                hover:shadow-xl transition duration-300">

        </div>

    </div>


    <!-- ABOUT -->
    <div id="about"
        class="flex items-center justify-center mb-6 pt-20 mt-10 px-6">

        <div class="md:w-1/2 text-center">

            <h1 class="text-2xl md:text-3xl font-bold mb-3 text-gray-800">
                Selamat Datang di Perpustakaan
            </h1>

            <p class="text-gray-600 leading-relaxed">
                Kelola buku, anggota, dan peminjaman dengan mudah.
            </p>

        </div>

    </div>


    <!-- SERVICES / FITUR -->
    <div id="services"
        class="flex flex-col md:flex-row items-stretch justify-center
        mx-5 my-8 gap-5 md:gap-8">

        <!-- Fitur 1 -->
        <div class="flex flex-col items-center gap-3 p-6 rounded-xl
            hover:shadow-md hover:bg-blue-50 transition duration-300">

            <i class="fa-solid fa-book-open text-blue-600 text-3xl"></i>

            <span class="text-lg font-serif text-center font-semibold">
                Koleksi Lengkap
            </span>

            <p class="text-sm text-center text-gray-600 leading-relaxed">
                Ribuan buku, e-book, jurnal, dan referensi akademik tersedia
                untuk mendukung kegiatan belajar.
            </p>

        </div>

        <!-- Fitur 2 -->
        <div class="flex flex-col items-center gap-3 p-6 rounded-xl
            hover:shadow-md hover:bg-blue-50 transition duration-300">

            <i class="fa-solid fa-tv text-3xl text-blue-600"></i>

            <span class="text-lg font-serif text-center font-semibold">
                Akses Digital
            </span>

            <p class="text-sm text-center text-gray-600 leading-relaxed">
                Akses koleksi perpustakaan kapan saja dan di mana saja
                melalui perangkat yang terhubung ke internet.
            </p>

        </div>

        <!-- Fitur 3 -->
        <div class="flex flex-col items-center gap-3 p-6 rounded-xl
            hover:shadow-md hover:bg-blue-50 transition duration-300">

            <i class="fa-solid fa-people-group text-3xl text-blue-600"></i>

            <span class="text-lg font-serif text-center font-semibold">
                Ruang Belajar
            </span>

            <p class="text-sm text-center text-gray-600 leading-relaxed">
                Nikmati lingkungan belajar yang nyaman untuk membaca,
                berdiskusi, dan mengembangkan pengetahuan.
            </p>

        </div>

        <!-- Fitur 4 -->
        <div class="flex flex-col items-center gap-3 p-6 rounded-xl
            hover:shadow-md hover:bg-blue-50 transition duration-300">

            <i class="fa-solid fa-headset text-3xl text-blue-600"></i>

            <span class="text-lg font-serif text-center font-semibold">
                Bantuan Perpustakaan
            </span>

            <p class="text-sm text-center text-gray-600 leading-relaxed">
                Tim pustakawan siap membantu pencarian referensi,
                peminjaman, dan penggunaan layanan perpustakaan.
            </p>

        </div>

    </div>


    <!-- KOLEKSI POPULER -->
    <div class="mx-5 md:mx-10 mt-16 p-2 flex flex-col md:flex-row
        justify-between md:items-center gap-2">

        <div>
            <h1 class="text-2xl font-serif font-bold mb-2 text-gray-800">
                Koleksi populer
            </h1>

            <p class="text-sm text-gray-500">
                Koleksi yang banyak dicari
            </p>
        </div>

    </div>


    <!-- DAFTAR BUKU -->
   <!-- DAFTAR BUKU -->
<div class="mx-5 mt-6 flex gap-5 overflow-x-auto pb-6 md:mx-10">

    @forelse ($buku as $item)

        <div class="flex w-64 shrink-0 flex-col overflow-hidden rounded-xl bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

            <!-- GAMBAR BUKU -->
            <div class="flex h-48 items-center justify-center overflow-hidden bg-blue-50">

                @if ($item->gambar)
                    <img
                        src="{{ asset('storage/' . $item->gambar) }}"
                        alt="{{ $item->judul }}"
                        class="h-full w-full object-cover"
                    >
                @else
                    <i class="fa-solid fa-book-open text-6xl text-blue-300"></i>
                @endif

            </div>

            <!-- INFORMASI BUKU -->
            <div class="flex flex-1 flex-col p-4">

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

                

            </div>

        </div>

    @empty

        <div class="w-full rounded-2xl bg-white p-12 text-center shadow-sm">
            <i class="fa-solid fa-book-open mb-4 text-5xl text-gray-300"></i>

            <h3 class="text-xl font-semibold text-gray-700">
                Buku tidak ditemukan
            </h3>

            <p class="mt-2 text-gray-500">
                Belum ada buku yang ditambahkan.
            </p>
        </div>

    @endforelse

</div>


    <!-- FOOTER -->
    <footer id="contact" class="bg-gray-800 mt-10 text-white">

        <div class="max-w-7xl mx-auto flex flex-wrap gap-8
            justify-between px-6 md:px-10 py-12">

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

                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="#dashboard" class="hover:text-blue-400 transition">Beranda</a></li>
                    <li><a href="#services" class="hover:text-blue-400 transition">Katalog Buku</a></li>
                    <li><a href="#services" class="hover:text-blue-400 transition">Kategori</a></li>
                    <li><a href="#about" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                </ul>

            </div>

            <!-- Layanan -->
            <div class="w-64">

                <h3 class="text-lg font-semibold mb-4">Layanan</h3>

                <ul class="space-y-2 text-gray-300 text-sm">
                    <li>Peminjaman Buku</li>
                    <li>Reservasi Buku</li>
                    <li>E-Book</li>
                    <li>Jurnal Online</li>
                </ul>

            </div>

            <!-- Kontak -->
            <div class="w-64">

                <h3 class="text-lg font-semibold mb-4">Kontak</h3>

                <ul class="space-y-3 text-gray-300 text-sm">

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

                    <a href="#" class="hover:text-blue-400 transition">
                        <i class="fa-brands fa-facebook"></i>
                    </a>

                    <a href="#" class="hover:text-pink-500 transition">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" class="hover:text-sky-400 transition">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                    <a href="#" class="hover:text-red-500 transition">
                        <i class="fa-brands fa-youtube"></i>
                    </a>

                </div>

            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-700 text-center py-4
            text-gray-400 text-sm">
            © 2026 Perpustakaan Digital. All Rights Reserved.
        </div>

    </footer>

</body>
</html>
