@props([
    'label',
    'name',
    'options' => [],
    'value' => null,
    'required' => false,
    'placeholder' => null,
])

<div>
    <label for="{{ $name }}" class="mb-1.5 flex items-center justify-between text-xs font-semibold text-heading">
        <span>{{ $label }} @if ($required)<span class="text-red-500">*</span>@endif</span>
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes }}
        @class([
            'w-full rounded-xl border bg-background px-3.5 py-2.5 text-sm text-on-surface outline-none transition-colors focus:border-blue-500',
            'border-red-500/60' => $errors->has($name),
            'border-surface-highest' => ! $errors->has($name),
        ])
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
    @enderror
</div>
