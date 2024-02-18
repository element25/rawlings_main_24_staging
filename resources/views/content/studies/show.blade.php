<x-layouts.main>
    <div class="container mx-auto">

        <div class="relative">
            <div class="">
                {{ $study->getFirstMedia('studies_show_hero') }}
            </div>
            <div class="text-rawl-purple-dark absolute left-3 top-3 z-10 md:left-5 md:top-5 lg:left-8 lg:top-8">
                <h5 class="font-gilroy text-sm font-semibold uppercase tracking-wide lg:text-xl">
                    @foreach ($study->categories as $category)
                        {{ $category->name }}
                        @if (!$loop->last)
                            /
                        @endif
                    @endforeach
                </h5>
                <h1 class="font-gilroy mt-2 text-4xl font-bold uppercase tracking-wider lg:mt-4">{{ $study->title }}</h1>
            </div>
        </div>

        <div class="mt-8 grid gap-12 md:grid-cols-2 lg:mt-12">
            <div class="mx-2 flex flex-col gap-y-3 text-zinc-800 lg:gap-y-4 lg:px-4 xl:px-8">
                <x-partials.elements.subheader_line>The brief</x-partials.elements.subheader_line>
                <div class="font-gilroy prose prose-p:text-base prose-p:font-gilroy text-base">
                    {!! $study->brief !!}
                </div>
            </div>

            <div class="mx-2 flex flex-col gap-y-3 text-zinc-800 lg:gap-y-4 lg:px-4 xl:px-8">
                <x-partials.elements.subheader_line>The approach</x-partials.elements.subheader_line>
                <div class="font-gilroy prose prose-p:text-base prose-p:font-gilroy text-base">
                    {!! $study->approach !!}
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-2 gap-8 md:mt-12 md:gap-12">
            <div class="">{{ $study->getFirstMedia('studies_show_brief') }}</div>
            <div class="">{{ $study->getFirstMedia('studies_show_approach') }}</div>
        </div>

        <div class="mt-8 md:mt-12">
            {{ $study->getFirstMedia('studies_show_full_top') }}
        </div>

        <div class="mx-2 mt-8 grid md:grid-cols-2 md:gap-12 lg:mt-12">
            <div class="flex flex-col gap-y-3 text-zinc-800 lg:gap-y-4 lg:px-4 xl:px-8">
                <x-partials.elements.subheader_line>The result</x-partials.elements.subheader_line>
                <div class="font-gilroy prose prose-p:text-base prose-p:font-gilroy text-base">
                    {!! $study->result !!}
                </div>
            </div>

            <div class="text-rawl-purple-dark lg:mx-16 xl:mx-24">
                <div
                    class="font-roboto prose prose-p:font-roboto prose-p:text-2xl prose-p:font-light mb-4 mt-12 text-2xl font-light md:mt-8">
                    {!! $study->quote !!}
                </div>
                <p class="font-gilroy mb-8 text-sm font-semibold uppercase md:mb-0">{{ $study->client }}</p>
            </div>
        </div>

        <div class="mt-8 lg:mt-12">
            {{ $study->getFirstMedia('studies_show_full_bottom') }}
        </div>

        <div class="mx-2 mt-16">
            <x-partials.elements.subheader_line>Related Case Studies</x-partials.elements.subheader_line>
        </div>

        <div class="mx-2 mt-8 grid gap-12 md:grid-cols-3 md:gap-4 lg:mx-8 lg:mt-12 lg:gap-8 xl:mx-12 xl:gap-12">

            @foreach ($study->related() as $related)
                <div class="flex flex-col">
                    <h5 class="font-gilroy font-roboto font-bold uppercase text-zinc-800 md:text-lg lg:text-xl">
                        <a href="/case-studies/{{ $related->slug }}"
                            class="hover:text-rawl-purple inline-block decoration-dashed decoration-1 underline-offset-4 hover:underline">{{ $related->related_title }}</a>
                    </h5>
                    <h6
                        class="font-gilroy mt-2 flex flex-row text-sm font-semibold text-zinc-500 md:flex-col xl:flex-row xl:text-base">
                        @foreach ($related->categories as $related_category)
                            <a href="/case-studies"
                                class="hover:text-rawl-purple flex flex-row decoration-dashed decoration-1 underline-offset-4 hover:underline">
                                {{ $related_category->short_name }}
                            </a>
                            @if (!$loop->last)
                                <span class="inline px-2 md:hidden lg:px-1 xl:inline 2xl:px-2">/</span>
                            @endif
                        @endforeach
                    </h6>
                    <div class="mt-4">
                        <a
                            href="/case-studies/{{ $related->slug }}">{{ $related->getFirstMedia('studies_show_related') }}</a>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

    <x-partials.elements.project_cta />

</x-layouts.main>
