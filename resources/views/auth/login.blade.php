
@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="flex min-h-screen items-center justify-center px-4 py-10">

    <div class="grid w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-xl md:grid-cols-2">

        <!-- Bagian Kiri -->
        <div class="hidden flex-col justify-between bg-blue-700 p-10 text-white md:flex">

            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20">
                        <i class="fa-solid fa-book-open text-2xl"></i>
                    </div>

                    <h1 class="text-2xl font-bold">
                        Perpustakaan Digital
                    </h1>
                </div>

                <div class="mt-20">
                    <h2 class="text-4xl font-bold leading-tight">
                        Selamat Datang
                        <br>
                        Kembali!
                    </h2>

                    <p class="mt-5 leading-relaxed text-blue-100">
                        Masuk ke akun Anda dan temukan berbagai koleksi
                        buku menarik untuk menambah wawasan dan pengetahuan.
                    </p>
                </div>
            </div>

            <div>
                <i class="fa-solid fa-book-open-reader text-8xl text-blue-300/80"></i>

               
            </div>

        </div>

        <!-- Bagian Form Login -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-16">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    Login
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Silakan masuk menggunakan akun Anda.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="font-semibold text-gray-700">
                        Email
                    </label>

                    <div class="relative mt-2">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full rounded-xl border border-gray-300 py-3 pl-11 pr-4 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <label for="password" class="font-semibold text-gray-700">
                        Password
                    </label>

                    <div class="relative mt-2">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                            class="w-full rounded-xl border border-gray-300 py-3 pl-11 pr-4 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        >
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mt-5 flex items-center justify-between">

                    <label for="remember_me" class="flex items-center gap-2">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-sm text-gray-600">
                            Ingat saya
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-800">
                            Lupa password?
                        </a>
                    @endif

                </div>

                <!-- Tombol Login -->
                <button
                    type="submit"
                    class="mt-7 flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 font-semibold text-white shadow-md transition hover:bg-blue-700"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Masuk
                </button>

                {{-- <!-- Register -->
                <div class="mt-7 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun?

                        <a href="{{ route('register') }}"
                            class="font-semibold text-blue-600 hover:text-blue-800">
                            Daftar sekarang
                        </a>
                    </p>
                </div> --}}

            </form>

        </div>

    </div>

</div>

@endsection
