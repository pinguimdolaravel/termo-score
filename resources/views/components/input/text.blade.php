@props(['name', 'label'])
<div class="flex flex-col space-y-1">
    <label for="{{ $name }}" class="text-sm text-slate-700 font-semibold">{{ $label }}</label>
    <input wire:model="{{ $name }}" name="{{ $name }}" id="{{ $name }}"
        class="text-xs rounded border p-2 border-slate-300 focus:ring-inset focus:border-0 focus:ring-indigo-400 focus:border-indigo-400" />
    @error($name)
        <span class="text-rose-700 text-sm">{{ $message }}</span>
    @enderror
</div>
