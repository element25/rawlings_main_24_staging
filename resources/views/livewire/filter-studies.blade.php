<div x-data wire:poll.240s.keep-alive>

    <x-partials.elements.header_top wire:click="clear" class="hover:cursor-pointer text-rawl-purple-dark text-left mx-auto text-5xl w-4/5">Our work</x-partials.elements.header_top>

    <div class="w-4/5 mx-auto mt-8">
        @foreach ($categories as $category)
            <div wire:click="filter({{ $category->id }})" wire:key="{{ $category->id }}" class="text-2xl xl:text-3xl font-roboto hover:cursor-pointer transition font-medium inline-block pr-4 !leading-loose tracking-tight {{ $category->colour }} @if($category->id == $filter_category) underline decoration-dashed decoration-2 underline-offset-8 @endif">
                {{ $category->label }}
            </div>
        @endforeach
    </div>

    <div wire:loading.class="opacity-0" class="grid grid-cols-3 gap-1.5 mt-12 transition duration-700 ease-in-out">
        @foreach ($filtered_studies as $study)
            <div wire:key="{{ $study->id }}" class="hover:opacity-70 opacity-100 transition">
                <a href="{{ $study->url }}"><img src="{{ $study->image }}"></a>
            </div>
        @endforeach
    </div>
</div>
