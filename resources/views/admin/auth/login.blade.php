@extends('layouts.admin')

@section('title', 'Masuk Admin - DarFolio')

@section('body')
    <main class="relative z-10 flex min-h-screen flex-col items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="group mb-8 flex items-center justify-center gap-3">
                <div class="size-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-blue-500 to-cyan-400 p-px shadow-lg shadow-indigo-500/20 transition-transform group-hover:scale-105">
                    <div class="flex size-full items-center justify-center rounded-[11px] bg-background">
                        <span class="font-mono text-sm font-bold text-white">D</span>
                    </div>
                </div>
                <span class="text-lg font-extrabold tracking-tight text-white">
                    Dar<span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Folio</span>
                </span>
            </a>

            <div class="rounded-2xl border border-surface-highest bg-surface-low/85 p-8 shadow-card-dark backdrop-blur-md">
                <div class="mb-6 flex flex-col items-center text-center">
                    <h1 class="text-xl font-bold text-white">Masuk ke Panel Admin</h1>
                    <p class="mt-1 text-xs text-on-surface-variant">Kelola seluruh konten portofolio dari satu tempat.</p>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-xs font-semibold text-slate-50">Email</label>
                        <div class="relative flex items-center">
                            <x-icon name="mail" class="absolute left-3 size-[18px] text-outline" />
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@example.com"
                                @class([
                                    'w-full rounded-xl border bg-background py-2.5 pl-9 pr-3 text-sm text-white shadow-inner outline-none transition-all placeholder:text-outline/50 focus:border-blue-500 focus:ring-1 focus:ring-blue-500',
                                    'border-red-500/60' => $errors->has('email'),
                                    'border-slate-700' => ! $errors->has('email'),
                                ])
                            >
                        </div>
                        @error('email')
                            <p class="flex items-center gap-1 text-[11px] text-red-400">
                                <x-icon name="info" class="size-3" />
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-50">Password</label>
                        <div class="relative flex items-center">
                            <x-icon name="shield-check" class="absolute left-3 size-[18px] text-outline" />
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                @class([
                                    'w-full rounded-xl border bg-background py-2.5 pl-9 pr-3 text-sm text-white shadow-inner outline-none transition-all placeholder:text-outline/50 focus:border-blue-500 focus:ring-1 focus:ring-blue-500',
                                    'border-red-500/60' => $errors->has('password'),
                                    'border-slate-700' => ! $errors->has('password'),
                                ])
                            >
                        </div>
                        @error('password')
                            <p class="flex items-center gap-1 text-[11px] text-red-400">
                                <x-icon name="info" class="size-3" />
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <label for="remember" class="flex cursor-pointer items-center gap-2 text-xs text-on-surface-variant">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            value="1"
                            class="size-4 rounded border-slate-600 bg-background text-blue-600 focus:ring-blue-500 focus:ring-offset-0"
                        >
                        <span>Ingat saya di perangkat ini</span>
                    </label>

                    <button
                        type="submit"
                        class="mt-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-xl border border-blue-400/30 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/35 transition-all hover:from-blue-500 hover:to-indigo-500 active:scale-[0.99]"
                    >
                        <x-icon name="log-out" class="size-[18px] rotate-180" />
                        <span>Masuk</span>
                    </button>
                </form>
            </div>

            <a
                href="{{ route('home') }}"
                class="mt-6 flex items-center justify-center gap-1.5 text-xs font-medium text-on-surface-variant transition-colors hover:text-white"
            >
                <x-icon name="arrow-left" class="size-4" />
                <span>Kembali ke Website</span>
            </a>
        </div>
    </main>
@endsection
