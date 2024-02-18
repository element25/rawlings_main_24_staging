<div {{ $attributes->class(['grow-0 ']) }}>
    <h6 class="lg:text-sm xl:text-base lg:leading-tight xl:leading-tight 2xl:leading-normal uppercase font-gilroy font-semibold">
        <a href="{{ $url }}"
           class="text-rawl-purple-dark tracking-normal hover:underline hover:text-rawl-purple decoration-dashed decoration-1 underline-offset-4">{{ $title }}</a>
    </h6>
    <div class="grid gap-y-2 mt-1">
        {{ $slot }}
    </div>
</div>
