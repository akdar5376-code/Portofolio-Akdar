@php
    $stack = [
        ['icon' => 'code', 'color' => 'text-orange-400', 'hover' => 'hover:border-orange-400/40', 'name' => 'HTML / CSS', 'note' => 'Frontend Base'],
        ['icon' => 'zap', 'color' => 'text-yellow-400', 'hover' => 'hover:border-yellow-400/40', 'name' => 'JavaScript', 'note' => 'Logic & DOM'],
        ['icon' => 'database', 'color' => 'text-sky-400', 'hover' => 'hover:border-sky-400/40', 'name' => 'MySQL', 'note' => 'Database'],
        ['icon' => 'terminal', 'color' => 'text-indigo-400', 'hover' => 'hover:border-indigo-400/40', 'name' => 'PHP', 'note' => 'Backend & API'],
        ['icon' => 'palette', 'color' => 'text-cyan-400', 'hover' => 'hover:border-cyan-400/40', 'name' => 'Tailwind CSS', 'note' => 'Styling System'],
        ['icon' => 'git-branch', 'color' => 'text-emerald-400', 'hover' => 'hover:border-emerald-400/40', 'name' => 'Git / GitHub', 'note' => 'Version Control'],
    ];
@endphp

<section class="mx-auto max-w-7xl border-t border-surface-lowest/70 px-4 py-16 sm:px-6 lg:px-8" data-purpose="tech-stack-strip">
    <div class="mb-8 flex flex-col items-center text-center">
        <span class="mb-1 font-mono text-xs font-medium uppercase tracking-wider text-blue-400">Capabilities</span>
        <h3 class="text-xl font-bold tracking-tight text-white sm:text-2xl">Core Tech Stack &amp; Tools</h3>
    </div>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-6">
        @foreach ($stack as $item)
            <div class="group flex flex-col items-center justify-center rounded-xl border border-surface-highest/70 bg-surface-low/60 p-4 text-center transition-all hover:bg-surface-container {{ $item['hover'] }}">
                <x-icon :name="$item['icon']" class="mb-2 size-6 {{ $item['color'] }} transition-transform group-hover:scale-110" />
                <span class="text-sm font-semibold text-white">{{ $item['name'] }}</span>
                <span class="mt-0.5 font-mono text-[11px] text-outline">{{ $item['note'] }}</span>
            </div>
        @endforeach
    </div>
</section>
