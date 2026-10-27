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
                    text-gray-600 hover:bg-blue-50 hover:text-blue-600 mb-2">

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
                    bg-blue-50 text-blue-600 font-medium mb-2">

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
                    Data Anggota
                </h1>

                <p class="text-gray-500 mt-1">
                    Daftar anggota perpustakaan
                </p>
            </div>


            <!-- Card Tabel -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <!-- Header Tabel -->
                <div class="p-5 border-b border-gray-200 flex justify-between items-center">

                    <div>
                        <h2 class="font-bold text-gray-800">
                            Daftar Anggota
                        </h2>

                        <p class="text-sm text-gray-500">
                            Data anggota perpustakaan
                        </p>
                    </div>

                    <!-- Tombol hanya tampilan -->
                    <a href="{{ route('anggota.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white
                       px-4 py-2 rounded-lg text-sm
                       flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Anggota
                    </a>

                </div>


                <!-- Tabel -->
                <div class="overflow-x-auto">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="w-full text-sm">
                        <!-- Header Tabel -->
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold text-gray-600">
                                    No
                                </th>

                                <th class="px-5 py-4 text-left font-semibold text-gray-600">
                                    Nama
                                </th>

                                <th class="px-5 py-4 text-left font-semibold text-gray-600">
                                    Email
                                </th>

                                <th class="px-5 py-4 text-center font-semibold text-gray-600">
                                    Role
                                </th>

                                <th class="px-5 py-4 text-left font-semibold text-gray-600">
                                    Tanggal Daftar
                                </th>

                                <th class="px-5 py-4 text-center font-semibold text-gray-600">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Data Anggota dari Database -->
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($anggota as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <!-- Nomor -->
                                    <td class="px-5 py-4">
                                        {{ $anggota->firstItem() + $index }}
                                    </td>

                                    <!-- Nama -->
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-full
                                    bg-blue-100 text-blue-600
                                    flex items-center justify-center">
                                                <i class="fa-solid fa-user"></i>
                                            </div>

                                            <span class="font-medium text-gray-800">
                                                {{ $item->name }}
                                            </span>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $item->email }}
                                    </td>

                                    <!-- Role -->
                                    <td class="px-5 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full
                                 bg-green-100 text-green-700 text-xs">
                                            {{ ucfirst($item->role) }}
                                        </span>
                                    </td>

                                    <!-- Tanggal Daftar -->
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <!-- Aksi: tampilan saja -->
                                    <td class="px-5 py-4">
                                        <form action="{{ route('anggota.destroy', $item->id) }}" method="POST">
                                            <div class="flex justify-center gap-2">
                                                {{-- <button
                            type="button"
                            title="Lihat"
                            class="w-8 h-8 rounded-lg bg-blue-100
                                   text-blue-600 hover:bg-blue-200">
                            <i class="fa-solid fa-eye"></i>
                        </button> --}}

                                                <a href="{{ route('anggota.edit', ['anggota' => $item->id]) }}"
                                                    title="Edit"
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg
          bg-yellow-100 text-yellow-600 hover:bg-yellow-200">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>

                                                <button type="SUBMIT" title="Hapus"
                                                    class="w-8 h-8 rounded-lg bg-red-100
                                   text-red-600 hover:bg-red-200">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-8 text-center text-gray-500">
                                        <i class="fa-solid fa-users text-3xl mb-3 block"></i>
                                        Belum ada data anggota.
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
                            {{ $anggota->firstItem() ?? 0 }}
                            sampai
                            {{ $anggota->lastItem() ?? 0 }}
                            dari
                            {{ $anggota->total() }} anggota
                        </p>

                        <div>
                            {{ $anggota->links() }}
                        </div>

                    </div>


                </div>

            </div>

        </main>

    </div>

</body>

</html>
```
