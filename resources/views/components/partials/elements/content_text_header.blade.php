@props(['bullets', 'header', 'title'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between text-zinc-500']) }}>

    <div class="lg:w-2/5 xl:w-1/2 mx-auto">

        <x-partials.elements.header_top tag="h4" class=" text-left lg:text-5xl xl:text-7xl text-rawl-purple">
            {{ $header }}
        </x-partials.elements.header_top>

    </div>

    <div class="lg:w-3/5 xl:w-1/2 lg:p-12 xl:p-12 2xl:px-16">

        <div class="prose prose-p:text-zinc-500 font-open leading-relaxed tracking-normal lg:text-sbase xl:text-lg">
            {{ $text }}
        </div>

    </div>
</div>
