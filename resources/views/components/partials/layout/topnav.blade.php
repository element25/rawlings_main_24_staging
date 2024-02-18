<nav x-data="{ navOpen: false, scrolledFromTop: false, showProducts: false, showServices: false }" x-cloak x-init="window.pageYOffset >= 50 ? scrolledFromTop = true : scrolledFromTop = false"
    @scroll.window="window.pageYOffset >= 50 ? scrolledFromTop = true : scrolledFromTop = false"
    :class="{
        'overflow-hidden': navOpen,
        'overflow-scroll2': !navOpen
    }"
    class="fixed top-0 z-40 w-full">
    <div class="flex flex-row items-center justify-between">
        <div class="mx-auto flex h-28 w-full items-center transition-all duration-200 ease-out lg:h-36"
            :class="{
                'h-28 lg:h-36 border-b border-transparent ': !scrolledFromTop,
                'h-20 border-b border-slate-100 drop-shadow-sm bg-white shadow-slate-100': scrolledFromTop
            }">
            <div class="container relative mx-auto flex flex-col">
                <div class="font-gilroy flex flex-row items-center justify-between px-4 md:pr-6 lg:pr-8">
                    <x-partials.elements.logo />

                    <ul class="fixed left-0 right-0 min-h-screen translate-x-full transform space-y-4 px-4 pt-8 text-sm font-semibold transition duration-300 md:relative md:flex md:min-h-0 md:translate-x-0 md:space-x-4 md:space-y-0 md:px-0 md:py-0 lg:space-x-7 lg:text-lg xl:space-x-10"
                        :class="{ 'translate-x-full': !navOpen }" :class="{ 'translate-x-0': navOpen }">
                        <li class="text-rawl-purple-dark hover:text-rawl-purple inline-flex items-center px-1 pt-1">
                            <a href="/about-us">About
                                @env(['local', 'production'])
                                <span class="">-
                                    <div class="sm:hidden">XS</div>
                                    <div class="hidden sm:inline-block md:hidden">SM</div>
                                    <div class="hidden md:inline-block lg:hidden">MD</div>
                                    <div class="hidden lg:inline-block xl:hidden">LG</div>
                                    <div class="hidden xl:inline-block 2xl:hidden">XL</div>
                                    <div class="hidden 2xl:inline-block">2XL</div>
                                </span>
                            @else
                                Us
                                @endenv
                            </a>
                        </li>
                        <li class="inline-flex items-center px-1 pt-1">
                            <div @click="showProducts = true"
                                class="text-rawl-purple-dark hover:text-rawl-purple hover:cursor-pointer">Products
                            </div>
                        </li>
                        <li class="inline-flex items-center px-1 pt-1">
                            <div @click="showServices = true"
                                class="text-rawl-purple-dark hover:text-rawl-purple hover:cursor-pointer">Services
                            </div>
                        </li>
                        <li class="text-rawl-purple-dark hover:text-rawl-purple inline-flex items-center px-1 pt-1">
                            <a href="/case-studies">Case Studies</a>
                        </li>
                        <li class="text-rawl-purple-dark hover:text-rawl-purple inline-flex items-center px-1 pt-1">
                            <a href="/news">News</a>
                        </li>
                    </ul>
                    <div>
                        <div class="group relative hidden md:flex md:items-center">
                            <a href="/contact-us"
                                class="bg-rawl-purple group-hover:text-rawl-purple border-rawl-purple group-hover:bg-rawl-white focus:ring-rawl-purple rounded-full border-2 px-4 py-2 text-xs font-bold uppercase tracking-wide text-white transition focus:outline-none focus:ring-2 focus:ring-offset-2 lg:px-8 lg:py-4 lg:text-sm">
                                <span class="">Get in Touch</span>
                            </a>
                            <livewire:enquiry-counter />
                        </div>
                        <div class="_-mr-2 mr-2 flex items-center md:hidden">
                            <!-- Mobile menu button -->
                            <button type="button"
                                class="text-rawl-purple hover:text-rawl-purple-dark z-50 inline-flex items-center justify-center rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <!--
                        Icon when menu is closed.

                        Menu open: "hidden", Menu closed: "block"
                      -->
                                <svg @click="navOpen = true" class="h-6 w-6"
                                    :class="{ 'hidden': navOpen, 'block': !navOpen }" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <!--
                        Icon when menu is open.

                        Menu open: "block", Menu closed: "hidden"
                      -->
                                <svg @click="navOpen = false" class="h-6 w-6"
                                    :class="{ 'block': navOpen, 'hidden': !navOpen }" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="z-50 w-full">
        <div x-show="showProducts" @click.outside="showProducts = false" class="bg-white" x-transition.opacity>
            <x-partials.layout.products_nav />
        </div>
    </div>

    <div class="z-50 w-full">
        <div x-show="showServices" @click.outside="showServices = false" class="bg-white" x-transition.opacity>
            <x-partials.layout.services_nav />
        </div>
    </div>
</nav>

<livewire:enquiry-basket />
