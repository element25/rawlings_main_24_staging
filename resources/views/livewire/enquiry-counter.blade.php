<div x-data="{showanimation: false}"
     x-on:counter-broadcast.window="showanimation = true;setTimeout(() => showanimation = false, 1000)">
    @if($counter > 0)
        <div>
            <a href="/contact-us" x-ref="counter" class="absolute -right-3 -top-3 rounded-full bg-rawl-blue text-white w-8 h-8
    font-extrabold font-sans text-center flex items-center justify-center text-xs "
               :class="{'animation-pulse' : showanimation}">
                <div class="top-[8px] absolute">{{ $counter }}</div>
            </a>
        </div>
    @endif
    {{--<div>£{{ implode(',', $basket_list) }}£</div>
    <div wire:click="clear">Reset</div>--}}
</div>
