<div class="flex items-center uppercase ml-3">
    <div class="font-semibold tracking-wide text-zinc-400 text-xxs">Products</div>
    @isset($categoryBreadcrumbs)
        <div class="mx-4 font-bold text-zinc-400 text-xxs">/</div>
        <a href="/products/{{ $categoryBreadcrumbs["full_url"] }}"
           class="font-semibold tracking-wide text-zinc-400 text-xxs">{{ $categoryBreadcrumbs["name"] }}</a>
    @endisset
    @isset($productBreadcrumbs)
        <div class="mx-4 font-bold text-zinc-400 text-xxs">/</div>
        <a href="/products/{{ $categoryBreadcrumbs["base_url"] }}/{{ $productBreadcrumbs["family_slug"] }}"
           class="tracking-widest {{ (! isset($productvariant)) ? 'font-extrabold text-sm text-rawl-purple' : 'font-semibold text-xxs text-zinc-400'  }}">{{ $productBreadcrumbs["family_name"] }}</a>
    @endisset
    @isset($productvariant)
        <div class="mx-4 font-bold text-zinc-400 text-xxs"> /</div>
        <a href="/products/{{ $categoryBreadcrumbs["url"] }}/{{ $productBreadcrumbs["family_slug"] }}"
           class="text-sm font-extrabold tracking-widest text-rawl-purple">{{ $productvariant["variant_display_name"] }}</a>
    @endisset
</div>
