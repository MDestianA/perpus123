
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Perpustakaan Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-5xl mx-auto px-4 py-10">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                Profil Saya
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Kelola informasi akun dan keamanan password Anda.
            </p>
        </div>

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-lg mb-6">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Notifikasi error -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-lg mb-6">
                <p class="font-semibold mb-2">Terjadi kesalahan:</p>

                <ul class="list-disc pl-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Kartu Identitas -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 h-fit">

                <div class="flex flex-col items-center text-center">

                    <div class="w-24 h-24 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-user text-4xl"></i>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $user->email }}
                    </p>

                    <span class="mt-4 px-4 py-1.5 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                        {{ ucfirst($user->role) }}
                    </span>

                </div>

                <hr class="my-6 border-gray-200">

                <div class="space-y-4">

                    <div>
                        <p class="text-xs text-gray-400">Nama Pengguna</p>
                        <p class="text-sm font-medium text-gray-700 mt-1">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">Email</p>
                        <p class="text-sm font-medium text-gray-700 mt-1">
                            {{ $user->email }}
                        </p>
                    </div>

                    

                </div>

            </div>

            <!-- Kolom Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Form Edit Profil -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Informasi Profil
                            </h3>
                            <p class="text-xs text-gray-500">
                                Perbarui informasi akun Anda.
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('anggota.profil.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan email"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Role
                            </label>

                            <input
                                type="text"
                                value="{{ ucfirst($user->role) }}"
                                disabled
                                class="w-full border border-gray-200 bg-gray-100 rounded-lg px-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>

                <!-- Form Ganti Password -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                    <div class="flex items-center gap-3 mb-6">

                        <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-lock"></i>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Keamanan Password
                            </h3>
                            <p class="text-xs text-gray-500">
                                Perbarui password untuk menjaga keamanan akun.
                            </p>
                        </div>

                    </div>

                    <form action="{{ route('anggota.password.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password Lama
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                placeholder="Masukkan password lama"
                                autocomplete="current-password"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
                                required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition">
                                <i class="fa-solid fa-key mr-2"></i>
                                Ganti Password
                            </button>
                        </div>
                        
                    </form>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('anggota.dashboard') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition">
                            Kembali
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
