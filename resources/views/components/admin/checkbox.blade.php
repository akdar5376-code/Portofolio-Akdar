@props([
    'label',
    'name',
    'checked' => false,
])

<label class="flex cursor-pointer items-center gap-2 rounded-xl border border-surface-highest bg-surface-container/50 px-3.5 py-2.5 text-xs font-medium text-on-surface">
    <input type="hidden" name="{{ $name }}" value="0">
    <input
        type="checkbox"
        name="{{ $name }}"
        value="1"
        @checked(old($name, $checked))
        {{ $attributes->merge(['class' => 'size-4 rounded border-surface-highest accent-blue-600']) }}
    >
    <span>{{ $label }}</span>
</label>
