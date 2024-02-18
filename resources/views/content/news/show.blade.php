<x-layouts.main>
    <div class="container mx-auto">
        <h1 class="mx-auto max-w-4xl font-roboto text-3xl font-light text-slate-700">
            {{ $article->id }}
        </h1>

        <div class="mx-auto mt-12 flex max-w-4xl items-center justify-between">
            <div class="flex flex-row space-x-4">
                @foreach ($article->categories as $category)
                    <a href="/news/{{ strtolower($category->slug) }}"
                        class="flex text-sm font-semibold tracking-widest text-rawl-purple">
                        <div class="flex items-center">
                            <x-icon :name="$category->icon" class="mr-1 block h-5 w-5 stroke-2" />
                            {{ strtoupper($category->name) }}
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="text-xs font-bold uppercase tracking-wide text-slate-400">{{ $article->nice_date }}</div>
        </div>

        <div class="mt-12 w-full">
            {{ $article->imageHero->toHtml() }}
            <img src="{{ $article->imageHero->getUrl() }}" alt="Main image for {{ $article->title }}"
                class="h-auto w-full">
        </div>

        <div class="mx-auto mt-12 lg:max-w-3xl xl:max-w-4xl">

            <div class="news_content">

                <p>Packaging and design are both at the centre of what we do. Our purpose is to deliver standout
                    packaging that incorporates high-level branding and design that allows our clients to stand out from
                    the crowd. So, when we get an opportunity to help creatives produce something unique no matter what
                    the brief is, we’re on board!</p>

                <p>Recently we had the privilege of helping Giacinta, a Graphic Design student who was tasked to
                    re-brand and package a line of drinks from a local cider company. To turn the designs into reality
                    we were glad to supply our beer cans to help visualise Giacinta’s project, as you can see below.</p>

                <img src="https://rawlingswebsite.s3.amazonaws.com/news/Inner/Giacinta%20Inner%201.JPG"
                    alt="Project photo">

                <h6 class="font-roboto text-3xl font-light text-slate-700">The Packaging Brief</h6>

                <p>The target audience included those in the 30+ age bracket who typically spend most of their free time
                    in the countryside and would rather buy locally than from a retail chain to support their local
                    community.</p>

                <p>In the research phase, Giacinta noticed that popular, stand-out designs focused on colourful
                    illustrations and as a result wanted to explore this route.</p>

                <p>The name of the fictional company Giacinta was tasked to brand was the ‘English Drinks Company’, so
                    she instantly knew that she wanted to focus on a heritage design, whilst summarising a British
                    summer and freedom. An added interest in aviation sparked her creativity to incorporate
                    well-recognised British airplanes, with each flavour being named after a different aircraft.</p>

                <p>The sense of freedom and exploration was characterised by the skies, with individual lines and using
                    different colours to represent sunsets and calm summer afternoons.</p>

                <p>To enrich the design, Giacinta created a secondary package prototype. Boxes were designed to house
                    the cans and carry the design further. Choosing to relay the branding over both packaging forms not
                    only allowed the product to be instantly recognisable when displayed but also enhanced the branding
                    to the consumer.</p>

                <img src="https://rawlingswebsite.s3.amazonaws.com/news/Inner/Giacinta%20inner%202.JPG"
                    alt="Project photo">

                <h6>What encouraged you to switch to graphic design?</h6>

                <p>I worked as an engineer for 20 years and was looking for a new challenge, so I wanted to go back into
                    formal education. I always loved painting and had art as a hobby, but I wanted to also find
                    something more practical that allowed me to change career. That’s why I decided to start studying
                    Graphic Design.</p>

                <p>Illustration is being used a lot more across different industries, including packaging and branding.
                    People are drawn to the personal touch it brings to products, making it seem as though the product
                    was made for them and them alone.</p>

                <h6>How had packaging developed?</h6>

                <p>Labels are now covering the whole bottle, meaning that however it is placed on the shelf, it can be
                    recognized from all angles. Augmented reality has also proven to be a popular choice amongst bottle
                    designs and is something to keep an eye on in the future.</p>

                <p>We loved seeing the final designs and physical products Giacinta created and learning more about the
                    reasoning behind her creative decisions. Seeing new talent break through into the industry is
                    incredibly exciting and we can’t wait to see what else Giacinta has to offer in the future. We know
                    that she will take her course by a storm.</p>

                <p>Click <a href="https://www.giacintadesign.com/home-page">here</a> to see more of Giacintas' designs.
                </p>

            </div>

        </div>

        <div class="container mx-auto">
            <div class="mx-auto my-12 border-y-2 border-zinc-200 py-8 lg:max-w-3xl xl:max-w-4xl">

                <div class="flex items-center text-sm font-bold tracking-wider text-zinc-400">
                    <x-icon name="heroicon-o-squares-2x2" class="mr-1 block h-5 w-5 stroke-2" />
                    RELATED ARTICLES
                </div>

                <div class="mt-8 grid grid-cols-2 gap-x-16 gap-y-24">
                    @foreach ($article->related() as $related)
                        <div class="flex flex-col">
                            <div class="">
                                <a href="/news/{{ $related->slug }}">
                                    <img src="{{ $related->image_index_responsive }}" alt="{{ $related->title }}">
                                </a>
                            </div>
                            <div class="mt-6 flex lg:flex-col lg:gap-y-4">
                                <div class="flex flex-row lg:space-x-3 xl:space-x-4">
                                    @foreach ($related->categories as $category)
                                        <a href="/news/{{ strtolower($category->slug) }}"
                                            class="flex font-semibold tracking-widest text-rawl-purple lg:text-xxs xl:text-xs">
                                            <div class="flex items-center">
                                                <x-icon :name="$category->icon" class="mr-1 block h-5 w-5 stroke-2" />
                                                {{ strtoupper($category->name) }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="font-bold uppercase tracking-wide text-slate-400 lg:text-xxs xl:text-xs">
                                    {{ $related->nice_date }}</div>
                            </div>
                            <h2 class="mt-4">
                                <a href="/news/{{ $related->slug }}"
                                    class="font-roboto leading-10 text-slate-700 hover:text-rawl-purple lg:text-2xl 2xl:text-3xl">
                                    {{ $related->title }}
                                </a>
                            </h2>
                            <h4 class="mt-6 font-open leading-7 text-slate-600 lg:text-base 2xl:text-lg">
                                {{ $related->summary }}</h4>
                            <div class="mt-6 font-open leading-7 text-slate-600 lg:text-sm 2xl:text-base">
                                <a href="/news/{{ $related->slug }}"
                                    class="flex items-center text-rawl-purple hover:text-rawl-purple-dark">
                                    Read more
                                    <x-icon name="heroicon-o-chevron-double-right"
                                        class="ml-1 block h-4 w-4 stroke-2 pt-0.5" />
                                </a>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

            <x-partials.elements.project_cta />
        </div>

</x-layouts.main>
