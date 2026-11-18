@props([
    'label',
    'name',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'hint' => null,
])

<div>
    <label for="{{ $name }}" class="mb-1.5 flex items-center justify-between text-xs font-semibold text-heading">
        <span>{{ $label }} @if ($required)<span class="text-red-500">*</span>@endif</span>
        @if ($hint)
            <span class="font-mono text-[10px] font-normal text-outline">{{ $hint }}</span>
        @endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
        @class([
            'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors placeholder:text-outline focus:border-orange-500',
            'border-red-500/60' => $errors->has($name),
            'border-surface-highest' => ! $errors->has($name),
        ])
    >
    @error($name)
        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
    @enderror
</div>
