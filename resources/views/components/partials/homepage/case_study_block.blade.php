<div class="relative group " x-data="{showInfo: false}" @mouseover="showInfo=true" @mouseout="showInfo=false">
    <div class="group-hover:cursor-pointer overflow-hidden">
        <img src="{{ $imageUrl }}" alt="$imageAlt" class="scale-100 group-hover:scale-125 transition-all duration-300">
    </div>
    <div x-show="showInfo" class="absolute top-0 lg:p-[20px] xl:p-[25px] 2xl:p-[30px] mx-auto my-auto group-hover:cursor-pointer" x-transition>
        <div class="relative opacity-90 text-white bg-{{ $bgColour }} p-6 font-gilroy lg:w-[216px] lg:w-[216px] xl:w-[270px] xl:h-[270px] 2xl:w-[324px] 2xl:h-[324px]">
            <div class="mx-auto">
                <div class="lg:text-xl xl:text-3xl 2xl:text-5xl lg:leading-tight xl:leading-snug 2xl:leading-snug font-bold lg:mb-2">{{ $title }}</div>
                <div class="lg:text-base xl:text-xl 2xl:text-2xl lg:leading-tight xl:leading-snug 2xl:leading-snug lg:font-semibold xl:font-bold lg:mb-6">{{ $text }}</div>
            </div>
            <div class="absolute bottom-3 right-3 lg:text-base xl:text-xl 2xl:text-2xl font-bold"><a href="{{ $linkUrl }}" class="underline decoration-dotted decoration-from-font hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark underline-offset-4 transition">{{ $linkText }}</a></div>
        </div>
    </div>
</div>