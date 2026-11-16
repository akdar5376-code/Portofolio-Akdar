<footer class="relative z-10 border-t border-surface-highest/60 bg-surface-lowest">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <a class="mb-4 flex items-center gap-2.5" href="{{ route('home') }}">
                <div class="flex size-8 items-center justify-center rounded-lg border border-blue-500/40 bg-blue-600/10">
                    <span class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400">D</span>
                </div>
                <span class="text-base font-extrabold tracking-tight text-heading">Dar<span class="text-blue-600 dark:text-blue-400">Folio</span></span>
            </a>
            <p class="max-w-xs text-sm leading-relaxed text-on-surface-variant">
                {{ $siteProfile->tagline ?: 'Portofolio digital siswa SMKN 2 Banjarmasin.' }}
            </p>

            @if (count($siteProfile->social_links))
                <div class="mt-5 flex items-center gap-2">
                    @foreach ($siteProfile->social_links as $social)
                        <a
                            href="{{ $social['url'] }}"
                            @if (! str_starts_with($social['url'], 'mailto:')) target="_blank" rel="noopener noreferrer" @endif
                            class="flex size-9 items-center justify-center rounded-full border border-surface-highest bg-surface-low text-on-surface-variant transition-colors hover:border-blue-500/40 hover:text-blue-600 dark:hover:text-blue-300"
                            aria-label="{{ $social['label'] }}"
                        >
                            <x-icon :name="$social['icon']" class="size-4" />
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="md:justify-self-center">
            <h2 class="mb-4 font-mono text-[11px] font-bold uppercase tracking-widest text-outline">Navigasi</h2>
            <div class="grid grid-cols-2 gap-x-8 gap-y-2">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-1.5 text-sm text-on-surface-variant transition-colors hover:text-heading">
                        <span class="size-1.5 shrink-0 rounded-full {{ $item['accent']['dot'] }}"></span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="md:justify-self-end">
            <h2 class="mb-4 font-mono text-[11px] font-bold uppercase tracking-widest text-outline">Kontak</h2>
            <ul class="space-y-2.5 text-sm text-on-surface-variant">
                @if ($siteProfile->email)
                    <li class="flex items-center gap-2">
                        <x-icon name="mail" class="size-4 shrink-0 text-blue-500" />
                        <a href="mailto:{{ $siteProfile->email }}" class="hover:text-blue-600 dark:hover:text-blue-300">{{ $siteProfile->email }}</a>
                    </li>
                @endif
                @foreach ([
                    ['label' => 'GitHub', 'url' => $siteProfile->github_url, 'icon' => 'github'],
                    ['label' => 'Instagram', 'url' => $siteProfile->instagram_url, 'icon' => 'instagram'],
                    ['label' => 'LinkedIn', 'url' => $siteProfile->linkedin_url, 'icon' => 'linkedin'],
                ] as $contact)
                    @if ($contact['url'])
                        <li class="flex items-center gap-2">
                            <x-icon :name="$contact['icon']" class="size-4 shrink-0 text-blue-500" />
                            <a href="{{ $contact['url'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-blue-600 dark:hover:text-blue-300">{{ $contact['label'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="border-t border-surface-highest/60">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-5 text-xs text-outline sm:flex-row sm:px-6 lg:px-8">
            <p>&copy; {{ now()->year }} {{ $siteProfile->full_name }}.</p>
        </div>
    </div>
</footer>
