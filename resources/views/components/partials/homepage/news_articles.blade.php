@props(['news'])
<div class="container mx-auto lg:mt-16 xl:mt-20 2xl:mt-24">
    <div class="w-full bg-rawl-blue lg:text-3xl xl:text-4xl text-white font-gilroy text-center lg:py-6 2xl:py-8 font-bold">
        Latest News!
    </div>

    <div class="grid grid-cols-3 mt-2 lg:gap-x-8 xl:gap-x-8 gap-y-28">

        @foreach($news as $article)
            <x-partials.homepage.news_article_block :$article />
        @endforeach
    </div>
</div>
</div>
