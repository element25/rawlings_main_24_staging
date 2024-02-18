<x-layouts.main>

    <div class="container mx-auto">

        <x-partials.elements.header_top class="mx-auto w-4/5 text-center text-6xl leading-tight text-rawl-purple">
            {{ $category->name ?? 'News' }}
        </x-partials.elements.header_top>

        <div class="mx-auto mt-12 flex w-full justify-center space-x-12">
            @foreach ($categories as $category)
                <a href="/news/{{ $category->slug }}" class="flex text-sm font-bold tracking-widest text-rawl-purple">
                    <div class="flex items-center">
                        <x-icon :name="$category->icon" class="mr-2 block h-7 w-7 stroke-2" />
                        {{ strtoupper($category->name) }}
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-24 grid grid-cols-3 gap-y-28 lg:gap-x-12 xl:gap-x-20">
            @foreach ($news as $article)
                <div class="flex flex-col">
                    <div class="">
                        <a href="/news/{{ $article->slug }}">
                            <img src="{{ $article->id }}" alt="{{ $article->title }}">
                        </a>
                    </div>
                    <div class="mt-6 flex lg:flex-col lg:gap-y-4">
                        <div class="flex flex-row lg:space-x-3 xl:space-x-4">
                            @foreach ($article->categories->ray() as $cat)
                                <a href="/news/{{ strtolower($cat->slug) }}"
                                    class="flex font-semibold tracking-widest text-rawl-purple lg:text-xxs xl:text-xs">
                                    <div class="flex items-center">
                                        <x-icon :name="$cat->icon" class="mr-1 block h-5 w-5 stroke-2" />
                                        {{ strtoupper($cat->name) }}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="font-bold uppercase tracking-wide text-slate-400 lg:text-xxs xl:text-xs">
                            {{ $article->nice_date }}</div>
                    </div>
                    <h2 class="mt-4">
                        <a href="/news/{{ $article->slug }}"
                            class="font-roboto leading-10 text-slate-700 hover:text-rawl-purple lg:text-2xl 2xl:text-3xl">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <h4 class="mt-6 font-open leading-7 text-slate-600 lg:text-base 2xl:text-lg">
                        {{ $article->summary }}</h4>
                    <div class="mt-6 font-open leading-7 text-slate-600 lg:text-sm 2xl:text-base">
                        <a href="/news/{{ $article->slug }}"
                            class="flex items-center text-rawl-purple hover:text-rawl-purple-dark">
                            Read more
                            <x-icon name="heroicon-o-chevron-double-right" class="ml-1 block h-4 w-4 stroke-2 pt-0.5" />
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

</x-layouts.main>
