<x-layouts.main>

    <div class="mx-auto">
        <div class="container mx-auto grid grid-cols-3 lg:h-[500px] xl:h-[625px] 2xl:h-[750px]">

            <div class="group relative row-span-3" x-data="{ showInfo: false }">
                <div class="transition" x-bind:class="showInfo ? 'opacity-90' : 'opacity-100'">
                    <img src="/images/homepage/hero/exeter.jpg" alt="" class="">
                </div>
                <div
                    class="absolute bottom-4 right-4 z-10 text-white opacity-80 transition hover:scale-110 hover:cursor-pointer hover:opacity-100">
                    <x-bi-plus-circle-fill @click="showInfo=!showInfo"
                        class="transition lg:h-7 lg:w-7 xl:h-8 xl:w-8 2xl:h-10 2xl:w-10"
                        x-bind:class="showInfo ? 'rotate-45' : ''" />
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 transform lg:left-[35px] lg:w-[271px] xl:left-[35px] xl:w-[357px] 2xl:left-[50px] 2xl:w-[412px]"
                    x-bind:class="showInfo ? 'opacity-95' : 'opacity-0'">
                    <div x-show="showInfo" class="" x-transition.delay.50ms.opacity
                        x-bind:class="showInfo ? 'opacity-100' : 'opacity-0'">
                        <div class="relative bg-rawl-purple p-6 font-gilroy text-white">
                            <div class="mx-auto">
                                <div
                                    class="font-bold lg:mb-2 lg:text-xl lg:leading-tight xl:text-3xl xl:leading-snug 2xl:text-5xl 2xl:leading-snug">
                                    Exeter Gin
                                </div>
                                <div
                                    class="font-bold lg:mb-2 lg:text-base lg:leading-tight xl:text-xl xl:leading-snug 2xl:text-2xl 2xl:leading-snug">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut nisl sit amet nisi
                                    venenatis porttitor eu sit amet ante.
                                </div>
                                <div
                                    class="font-bold lg:mb-2 lg:text-base lg:leading-tight xl:text-xl xl:leading-snug 2xl:text-2xl 2xl:leading-snug">
                                    Morbi et porttitor metus, et tempor nisl. Curabitur ut congue neque
                                </div>

                                <div
                                    class="font-bold lg:mb-2 lg:text-base lg:leading-tight xl:text-xl xl:leading-snug 2xl:text-2xl 2xl:leading-snug">
                                    &bull;&nbsp;Lorem ipsum dolor sit amet
                                </div>
                                <div
                                    class="font-bold lg:mb-6 lg:text-base lg:leading-tight xl:mb-8 xl:text-xl xl:leading-snug 2xl:text-2xl 2xl:leading-snug">
                                    &bull;&nbsp;Lorem ipsum dolor sit amet
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-lg 2xl:text-xl">
                                <a href="/why"
                                    class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative" x-data="{ showInfo: false }">
                <div class="transition" x-bind:class="showInfo ? 'opacity-90' : 'opacity-100'">
                    <img src="/images/homepage/hero/pallets.jpg">
                </div>
                <div
                    class="absolute z-10 text-white opacity-80 transition hover:scale-110 hover:cursor-pointer hover:opacity-100 lg:bottom-3 lg:right-3 xl:bottom-4 xl:right-4">
                    <x-bi-plus-circle-fill @click="showInfo=!showInfo"
                        class="transition lg:h-7 lg:w-7 xl:h-8 xl:w-8 2xl:h-10 2xl:w-10"
                        x-bind:class="showInfo ? 'rotate-45' : ''" />
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 transform lg:left-[20px] lg:w-[265px] xl:left-[35px] xl:w-[327px] 2xl:left-[50px] 2xl:w-[362px]"
                    x-bind:class="showInfo ? 'opacity-95' : 'opacity-0'">
                    <div x-show="showInfo" class="" x-transition.delay.50ms.opacity
                        x-bind:class="showInfo ? 'opacity-100' : 'opacity-0'">
                        <div class="relative bg-rawl-blue p-4 font-gilroy text-white">
                            <div class="mx-auto">
                                {{--                            <div class="lg:text-2xl xl:text-4xl 2xl:text-5xl lg:leading-tight xl:leading-snug 2xl:leading-snug font-bold lg:mb-2">Exeter Gin</div> --}}
                                <div
                                    class="font-bold lg:mb-6 lg:text-base lg:leading-tight xl:mb-8 xl:text-xl xl:leading-snug 2xl:text-2xl 2xl:leading-snug">
                                    Lorem ipsum dolor sit amet. Cras ut nisl sit amet nisi venenatis porttitor eu sit.
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-lg 2xl:text-xl">
                                <a href="/why"
                                    class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative" x-data="{ showInfo: false }">
                <div class="transition" x-bind:class="showInfo ? 'opacity-90' : 'opacity-100'">
                    <img src="/images/homepage/hero/melange.jpg">
                </div>
                <div
                    class="absolute bottom-4 right-4 z-10 text-white opacity-80 transition hover:scale-110 hover:cursor-pointer hover:opacity-100">
                    <x-bi-plus-circle-fill @click="showInfo=!showInfo"
                        class="transition lg:h-7 lg:w-7 xl:h-8 xl:w-8 2xl:h-10 2xl:w-10"
                        x-bind:class="showInfo ? 'rotate-45' : ''" />
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 transform lg:left-[20px] lg:w-[265px] xl:left-[35px] xl:w-[327px] 2xl:left-[50px] 2xl:w-[362px]"
                    x-bind:class="showInfo ? 'opacity-95' : 'opacity-0'">
                    <div x-show="showInfo" class="" x-transition.delay.50ms.opacity
                        x-bind:class="showInfo ? 'opacity-100' : 'opacity-0'">
                        <div class="relative bg-rawl-purple p-4 font-gilroy text-white">
                            <div class="mx-auto">
                                <div
                                    class="font-bold lg:mb-6 lg:text-base lg:leading-tight xl:mb-8 xl:text-xl xl:leading-tight 2xl:text-2xl 2xl:leading-snug">
                                    Lorem ipsum dolor sit amet. Cras ut nisl sit amet nisi venenatis porttitor eu sit.
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-lg 2xl:text-xl">
                                <a href="/why"
                                    class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CENTRAL BLOCK -->
            <div class="lg:h-[220px] xl:h-[275px] 2xl:h-[330px]">
                <div class="relative h-full w-full bg-rawl-blue font-gilroy text-white">
                    <div
                        class="mx-auto w-4/5 pl-8 font-bold lg:pt-16 lg:text-3xl lg:leading-tight xl:pt-20 xl:text-4xl xl:leading-snug 2xl:pt-24 2xl:text-5xl 2xl:leading-snug">
                        Glass packaging made different
                    </div>
                    <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-xl 2xl:text-2xl">
                        <a href="/why"
                            class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">How?</a>
                    </div>
                </div>
            </div>

            <div class="group relative row-span-2" x-data="{ showInfo: false }">
                <div class="transition" x-bind:class="showInfo ? 'opacity-90' : 'opacity-100'">
                    <img src="/images/homepage/hero/summit.jpg">
                </div>
                <div
                    class="absolute bottom-4 right-4 z-10 text-white opacity-80 transition hover:scale-110 hover:cursor-pointer hover:text-white hover:opacity-100">
                    <x-bi-plus-circle-fill @click="showInfo=!showInfo"
                        class="transition lg:h-7 lg:w-7 xl:h-8 xl:w-8 2xl:h-10 2xl:w-10"
                        x-bind:class="showInfo ? 'rotate-45' : ''" />
                </div>

                <div class="absolute top-1/2 -translate-y-1/2 transform lg:left-[35px] lg:w-[271px] xl:left-[35px] xl:w-[357px] 2xl:left-[50px] 2xl:w-[412px]"
                    x-bind:class="showInfo ? 'opacity-95' : 'opacity-0'">
                    <div x-show="showInfo" class="" x-transition.delay.50ms.opacity
                        x-bind:class="showInfo ? 'opacity-100' : 'opacity-0'">
                        <div class="relative bg-rawl-blue p-6 font-gilroy text-white">
                            <div class="mx-auto">
                                <div
                                    class="font-bold lg:mb-2 lg:text-xl lg:leading-tight xl:text-3xl 2xl:text-5xl 2xl:leading-snug">
                                    Exeter Gin
                                </div>
                                <div
                                    class="font-bold lg:mb-2 lg:text-base lg:leading-tight xl:text-xl 2xl:text-2xl 2xl:leading-snug">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut nisl sit amet nisi
                                    venenatis porttitor eu sit amet ante.
                                </div>

                                <div
                                    class="font-bold lg:mb-2 lg:text-base lg:leading-none xl:text-xl xl:leading-tight 2xl:text-2xl 2xl:leading-snug">
                                    &bull;&nbsp;Lorem ipsum dolor sit amet
                                </div>
                                <div
                                    class="font-bold lg:mb-6 lg:text-base lg:leading-none xl:mb-8 xl:text-xl xl:leading-tight 2xl:text-2xl 2xl:leading-snug">
                                    &bull;&nbsp;Lorem ipsum dolor sit amet
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-lg 2xl:text-xl">
                                <a href="/why"
                                    class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative" x-data="{ showInfo: false }">
                <div class="transition" x-bind:class="showInfo ? 'opacity-90' : 'opacity-100'">
                    <img src="/images/homepage/hero/pump.jpg">
                </div>
                <div
                    class="absolute bottom-4 right-4 z-10 text-white opacity-80 transition hover:scale-110 hover:cursor-pointer hover:text-white hover:opacity-100">
                    <x-bi-plus-circle-fill @click="showInfo=!showInfo"
                        class="transition lg:h-7 lg:w-7 xl:h-8 xl:w-8 2xl:h-10 2xl:w-10"
                        x-bind:class="showInfo ? 'rotate-45' : ''" />
                </div>

                <div class="absolute top-1/2 -translate-y-1/2 transform lg:left-[20px] lg:w-[265px] xl:left-[35px] xl:w-[327px] 2xl:left-[50px] 2xl:w-[362px]"
                    x-bind:class="showInfo ? 'opacity-95' : 'opacity-0'">
                    <div x-show="showInfo" class="" x-transition.delay.50ms.opacity
                        x-bind:class="showInfo ? 'opacity-100' : 'opacity-0'">
                        <div class="relative bg-rawl-purple p-4 font-gilroy text-white">
                            <div class="mx-auto">
                                <div
                                    class="font-bold lg:mb-6 lg:text-base lg:leading-tight xl:mb-8 xl:text-xl xl:leading-tight 2xl:text-2xl 2xl:leading-snug">
                                    Lorem ipsum dolor sit amet. Cras ut nisl sit amet nisi venenatis porttitor eu sit.
                                </div>
                            </div>
                            <div class="absolute bottom-3 right-3 font-bold lg:text-base xl:text-lg 2xl:text-xl">
                                <a href="/why"
                                    class="underline decoration-dotted decoration-from-font underline-offset-4 transition hover:text-rawl-purple-dark hover:decoration-rawl-purple-dark">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{--    <x-partials.homepage.text_block/> --}}

    {{--    <x-partials.homepage.case_studies/> --}}

    {{--    <x-partials.homepage.news_articles :$news/> --}}

    {{--    <x-partials.elements.project_cta/> --}}

</x-layouts.main>
