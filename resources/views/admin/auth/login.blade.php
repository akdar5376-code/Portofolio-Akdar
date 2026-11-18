@extends('layouts.admin')

@section('title', 'Masuk Admin - DarFolio')

@section('body')
    <main class="relative z-10 flex min-h-screen flex-col items-center justify-center px-4 py-12 sm:px-6">
        <div class="w-full max-w-md">
            <a href="{{ route('home') }}" class="group mb-8 flex items-center justify-center gap-3">
                <div class="flex size-10 items-center justify-center border border-orange-700/40 bg-orange-700/10 transition-colors group-hover:bg-orange-700/15">
                    <span class="font-mono text-sm font-bold text-heading">D</span>
                </div>
                <span class="text-lg font-extrabold tracking-tight text-heading">
                    Dar<span class="text-orange-800 dark:text-orange-300">Folio</span>
                </span>
            </a>

            <div class="border-y border-surface-highest bg-surface-low p-8">
                <div class="mb-6">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-orange-800 dark:text-orange-300">Administrator</p>
                    <h1 class="text-xl font-semibold text-heading">Masuk ke Panel Admin</h1>
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
                                    'w-full rounded-md border bg-background py-2.5 pl-9 pr-3 text-sm text-on-surface outline-none transition-colors placeholder:text-outline/70 focus:border-orange-700 focus:ring-1 focus:ring-orange-700',
                                    'border-red-500/60' => $errors->has('email'),
                                    'border-surface-highest' => ! $errors->has('email'),
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
                                    'w-full rounded-md border bg-background py-2.5 pl-9 pr-3 text-sm text-on-surface outline-none transition-colors placeholder:text-outline/70 focus:border-orange-700 focus:ring-1 focus:ring-orange-700',
                                    'border-red-500/60' => $errors->has('password'),
                                    'border-surface-highest' => ! $errors->has('password'),
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
                            class="size-4 rounded border-surface-highest bg-background text-orange-800 focus:ring-orange-700 focus:ring-offset-0"
                        >
                        <span>Ingat saya di perangkat ini</span>
                    </label>

                    <button
                        type="submit"
                        class="mt-2 flex w-full cursor-pointer items-center justify-center gap-2 rounded-md bg-orange-800 px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-orange-900 active:scale-[0.99]"
                    >
                        <x-icon name="log-out" class="size-[18px] rotate-180" />
                        <span>Masuk</span>
                    </button>
                </form>
            </div>

            <a
                href="{{ route('home') }}"
                class="mt-6 flex items-center justify-center gap-1.5 text-xs font-medium text-on-surface-variant transition-colors hover:text-orange-800 dark:hover:text-orange-300"
            >
                <x-icon name="arrow-left" class="size-4" />
                <span>Kembali ke Website</span>
            </a>
        </div>
    </main>
@endsection
