<div class="group 2bg-zinc-200">
    <a href="{{ $url }}">
        <div class="mb-3">
            <div class="relative group-hover:bg-zinc-50 group-hover:shadow-sm p-4">
                <img src="{{ $image }}">
                <div class="absolute hidden top-2 right-1 group-hover:grid grid-rows-2 gap-3">

                    @if($loads)
                        <div class="flex flex-col items-center">
                            <x-carbon-delivery-truck class="lg:h-5 lg:w-5 2xl:h-6 2xl:w-6 text-zinc-500"/>
                            <div class="lg:text-xxs xl:text-xs text-zinc-500 font-gilroy font-bold">Full loads</div>
                        </div>
                    @endif
                    @if($pallets)
                        <div class="flex flex-col items-center">
                            <x-lineawesome-pallet-solid class="lg:h-5 lg:w-5 2xl:h-6 2xl:w-6 text-zinc-500"/>
                            <div class="lg:text-xxs xl:text-xs text-zinc-500 font-gilroy font-bold">Pallets</div>
                        </div>
                    @endif
                    @if($boxes)
                        <div class="flex flex-col items-center">
                            <x-bi-boxes class="lg:h-5 lg:w-5 2xl:h-6 2xl:w-6 text-zinc-500"/>
                            <div class="lg:text-xxs xl:text-xs text-zinc-500 font-gilroy font-bold">Boxes</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <h5 class="lg:text-sm xl:text-base lg:tracking-wide xl:tracking-wider 2xl:tracking-widest uppercase font-gilroy font-bold text-zinc-400 text-center mb-3 group-hover:text-rawl-purple">
            {{ $title }}
        </h5>
        <h6 class="lg:text-sm xl:text-base lg:leading-tight xl:leading-tight 2xl:leading-normal font-gilroy font-light text-zinc-400 text-center">
            Reference <span class="uppercase">{{ $reference }}</span>
        </h6>
    </a>
</div>
