@props(['label', 'group'])

<div class="relative flex items-start">
    <div class="flex h-6 items-center">
        <input id="{{ Str::of($label)->lower()->slug('_') }}" {{ $attributes }} wire:model.live="{{ $group }}" type="checkbox" class="h-4 w-4 rounded  focus:ring-rawl-purple-dark @error('services') border-red-300 text-rawl-purple @else border-gray-300 text-rawl-purple @endif">
    </div>
    <div class="ml-3 text-sm leading-6">
        <label for="{{ Str::of($label)->lower()->slug('_') }}" class="font-open text-base @error('services') text-red-500 @else text-zinc-500 @endif">{{ $label }}</label>
    </div>
</div>
