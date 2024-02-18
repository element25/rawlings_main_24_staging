<div class="container mx-auto z-50 ">
    <div
        class="grid grid-cols-3 gap-x-2 justify-center xl:w-[790px] xl:ml-[330px] 2xl:w-[790px] 2xl:ml-[450px] items-top mx-auto pb-8 relative z-50"
        :class="{'pb-12': !scrolledFromTop, 'pt-6 pb-6': scrolledFromTop}">

        <x-partials.layout.products_nav_block title="Consultation" url="/services/project-planning">
            <x-partials.layout.products_nav_line text="Graphic Design" url="/services/product-branding"/>
            <x-partials.layout.products_nav_line text="Decoration and Customisation" url="/services/product-branding"/>
            <x-partials.layout.products_nav_line text="Logistics" url="/services/product-branding"/>
        </x-partials.layout.products_nav_block>

        <x-partials.layout.products_nav_block title="Production Equipment" url="/services/product-branding" class="mr-8">
            <x-partials.layout.products_nav_line text="Vigo ??" url="/services/product-branding"/>
            <x-partials.layout.products_nav_line text="Engineer support / Servicing" url="/services/product-branding"/>
            <x-partials.layout.products_nav_line text="Labelling" url="/services/product-branding"/>
        </x-partials.layout.products_nav_block>

        <x-partials.layout.products_nav_block class="grow" title="Packaging" url="/services/product-branding">
            <x-partials.layout.products_nav_line text="Containers" url="/products"/>
            <x-partials.layout.products_nav_line text="Closures" url="/services/product-branding"/>
            <x-partials.layout.products_nav_line text="Bags" url="https://www.paperbagco.co.uk/"/>
        </x-partials.layout.products_nav_block>


    </div>
</div>
