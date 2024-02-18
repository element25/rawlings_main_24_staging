<div x-show="showText=='{{ $name }}'" class="z-20 relative text-white bg-rawl-purple w-full h-full font-gilroy transition">

    <h5 class="w-4/5 mx-auto lg:text-2xl xl:text-4xl 2xl:text-4xl lg:leading-tight xl:leading-snug 2xl:leading-snug lg:pt-12 xl:pt-16 2xl:pt-20 pl-6 lg:mb-2 font-bold">{{ $title }}</h5>

    <p class="w-4/5 mx-auto lg:text-lg xl:text-2xl 2xl:text-2xl lg:leading-tight xl:leading-snug 2xl:leading-snug font-bold lg:mb-6 px-6">{{ $text }}</p>

    <div class="absolute top-2 right-2 lg:text-base xl:text-xl 2xl:text-2xl font-bold">
        <x-bi-x-square-fill class="h-6 w-6 hover:text-rawl-purple-dark hover:cursor-pointer" @click="showText='default'"/>
    </div>

    <div class="absolute bottom-3 right-3 lg:text-base xl:text-xl 2xl:text-2xl font-bold"><a href="/{{ $linkUrl }}" class="underline decoration-dotted decoration-from-font hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark underline-offset-4 transition">{{ $linkText }}</a></div>

</div>