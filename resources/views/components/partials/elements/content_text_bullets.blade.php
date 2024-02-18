@props(['bullets', 'header', 'title'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between text-zinc-500']) }}>

    <div class="w-1/2 mx-auto">
        <div class="mx-auto lg:w-5/6 xl:w-3/4">
            <ul class="flex flex-col gap-4 mx-auto list-disc list-outside ms-8">
                @foreach(explode('|', $bullets) as $bullet)
                    <li class="lg:text-xl xl:text-xl text-rawl-purple font-roboto">
                        <span class="text-zinc-500 lg:text-base xl:text-lg">{{ $bullet }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex flex-col gap-6 w-1/2 lg:p-8 xl:p-12 2xl:px-16">

        <x-partials.elements.subheader_line>{{ $header }}</x-partials.elements.subheader_line>
        <div class="font-roboto leading-tight font-light tracking-wide text-zinc-600 lg:text-3xl xl:text-4xl ">{{ $title }}</div>
        <div class="font-open leading-relaxed tracking-normal lg:text-base xl:text-lg">{{ $slot }}</div>

    </div>
</div>
