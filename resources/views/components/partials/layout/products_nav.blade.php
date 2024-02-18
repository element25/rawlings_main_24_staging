<div class="container z-50 mx-auto bg-white">
    <div class="items-top z-50 ml-10 mr-14 grid grid-cols-8 justify-between gap-x-3 pb-8"
        :class="{ 'pb-12': !scrolledFromTop, 'pt-6 pb-6': scrolledFromTop }">

        @foreach ($categories as $category)
            <x-partials.layout.products_nav_block title="{!! $category->name !!}" class="{{ $category->class }}"
                url="/products/{{ $category->slug }}">
                @foreach ($category->subCategories as $subCategory)
                    <x-partials.layout.products_nav_line text="{!! $subCategory->name !!}"
                        url="/products/{{ $category->slug }}/{{ $subCategory->slug }}" />
                @endforeach
            </x-partials.layout.products_nav_block>
        @endforeach

    </div>
</div>
