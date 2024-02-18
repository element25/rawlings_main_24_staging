<div
    x-data="{hovered: false, saved: @entangle('saved').live}"
    x-transition @click="hovered=false"
    @mouseenter="hovered=true" @mouseleave="hovered=false"
    wire:click="toggleSaved" ;
    class="flex flex-row items-center group gap-1" :class="hovered ? 'cursor-pointer' : ''">
    <div class="">
        <x-bi-bookmark-plus x-show="!hovered && !saved"
                            class="lg:h-5 lg:w-5 xl:h-6 xl:w-6 text-rawl-purple"/>
        <x-bi-bookmark-plus-fill x-show="hovered && !saved"
                                 class="lg:h-5 lg:w-5 xl:h-6 xl:w-6 text-zinc-700 group-hover:text-rawl-purple"/>
        <x-bi-bookmark-check-fill x-show="!hovered && saved"
                                  class="lg:h-5 lg:w-5 xl:h-6 xl:w-6 text-rawl-green"/>
        <x-bi-bookmark-x x-show="hovered && saved"
                         class="lg:h-5 lg:w-5 xl:h-6 xl:w-6 text-zinc-500 group-hover:text-rawl-purple"/>
    </div>
    <div
        class="lg:text-xs xl:text-sm font-gilroy font-bold group-hover:underline decoration-dotted decoration-2 underline-offset-4"
        x:class="{'text-rawl-purple': (saved && hovered), 'text-rawl-purple': (!saved && !hovered), 'text-rawl-purple': (hovered && !saved), 'text-rawl-green': (saved && !hovered)}"
        :class="(saved && !hovered) ? 'text-rawl-green' : 'text-rawl-purple'"
        {{--        :class="saved ? 'text-rawl-green' : 'text-rawl-purple'"--}}
        {{--        :class="hovered ? 'text-rawl-purple' : ''"--}}
    >
        Save<span :class="saved ? 'opacity-100' : 'opacity-0' ">d</span>
    </div>
</div>
