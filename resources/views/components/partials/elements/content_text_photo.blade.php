@props(['src', 'alt', 'header', 'title', 'button_text', 'button_url'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between text-zinc-500']) }}>

    <div class="lg:w-2/5 xl:w-1/2 mx-12 text-center">
        <img src="{{ $src }}" alt="{{ $alt }}" class="mx-auto"/>
    </div>

    <div class="flex flex-col gap-6 lg:w-3/5 xl:w-1/2 lg:p-8 xl:p-12 2xl:px-16">

        <x-partials.elements.subheader_line>{{ $header }}</x-partials.elements.subheader_line>
        <div class="font-roboto leading-tight font-light tracking-wide text-zinc-600 lg:text-3xl xl:text-4xl ">{{ $title }}</div>
        <div class="font-open leading-relaxed tracking-normal lg:text-base xl:text-lg">{{ $slot }}</div>

        @if(isset($button_text))
            <div class="mt-6">
                <a href="{{ $button_url }}" class="bg-white px-8 py-6 rounded-full border border-2 uppercase text-rawl-purple font-bold text-sm font-gilroy tracking-widest border-rawl-purple hover:text-white hover:bg-rawl-purple transition">{{ $button_text }}</a>
            </div>
        @endif
    </div>
</div>
