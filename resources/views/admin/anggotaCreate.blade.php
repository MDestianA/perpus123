
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Tambah Anggota - Perpustakaan Digital</title>
</head>

<body class="min-h-screen bg-gray-100 px-4 py-10">

    <div class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-lg">

        <div class="mb-8 border-b border-gray-200 pb-5">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fa-solid fa-user-plus mr-2 text-blue-600"></i>
                Tambah Anggota
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Masukkan informasi anggota baru perpustakaan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                <p class="mb-2 font-semibold">Terjadi kesalahan!</p>
                <ul class="list-inside list-disc text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('anggota.store') }}"
              method="POST"
              class="space-y-5">

            @csrf

            <!-- Nama Anggota -->
            <div>
                <label for="name" class="mb-2 block font-semibold text-gray-700">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="mb-2 block font-semibold text-gray-700">
                    Email
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="mb-2 block font-semibold text-gray-700">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="mb-2 block font-semibold text-gray-700">
                    Konfirmasi Password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Masukkan ulang password"
                    minlength="8"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >
            </div>

            <!-- Role Anggota -->
            <div class="hidden">
                <label class="mb-2 block font-semibold text-gray-700">
                    Role
                </label>
                <input
                    type="text"
                    value="Anggota"
                    readonly
                    class="w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-gray-600"
                >
                <p class="mt-2 text-xs text-gray-500">
                    Role otomatis ditetapkan sebagai anggota.
                </p>
            </div>

            <!-- Tombol -->
            <div class="flex flex-col gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('anggota.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-3 text-center font-semibold text-gray-700 transition hover:bg-gray-100"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white shadow transition hover:bg-blue-700 focus:ring-4 focus:ring-blue-200"
                >
                    <i class="fa-solid fa-user-plus mr-2"></i>
                    Simpan Anggota
                </button>

            </div>

        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
</body>
</html>
```