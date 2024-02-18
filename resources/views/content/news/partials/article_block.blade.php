<div class="flex flex-col">
    <div class="">
        <a href="/news/{{ $article->slug }}">
            <img src="{{ $article->summary_image }}" alt="{{ $article->title }}">
        </a>
    </div>
    <div class="flex lg:flex-col lg:gap-y-4  mt-6">
        <div class="flex flex-row lg:space-x-3 xl:space-x-4">
            @foreach($article->cats as $cat)
                <a href="/news/{{ strtolower(config('arrays.news_cats_names')[$cat]) }}" class="flex lg:text-xxs xl:text-xs font-semibold tracking-widest text-rawl-purple">
                    <div class="flex items-center">
                        <x-icon :name="config('arrays.news_cats_icons')[$cat]" class="block w-5 h-5 mr-1 stroke-2"/>
                        {{ strtoupper(config('arrays.news_cats_names')[$cat]) }}
                    </div>
                </a>
            @endforeach
        </div>
        <div class="lg:text-xxs xl:text-xs font-bold tracking-wide uppercase text-slate-400">{{ $article->nice_date }}</div>
    </div>
    <h2 class="mt-4">
        <a href="/news/{{ $article->slug }}" class="lg:text-2xl 2xl:text-3xl leading-10 text-slate-700 font-roboto hover:text-rawl-purple">
            {{ $article->title }}
        </a>
    </h2>
    <h4 class="mt-6 lg:text-base 2xl:text-lg leading-7 font-open text-slate-600">{{ $article->summary_text }}</h4>
    <div class="mt-6 leading-7 lg:text-sm 2xl:text-base font-open text-slate-600">
        <a href="/news/{{ $article->slug }}" class="flex items-center text-rawl-purple hover:text-rawl-purple-dark">
            Read more
            <x-icon name="heroicon-o-chevron-double-right" class="block w-4 h-4 pt-0.5 ml-1 stroke-2"/>
        </a>
    </div>

</div>
