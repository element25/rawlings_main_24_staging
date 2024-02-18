<div class="flex flex-col sitems-start sjustify-start">

    <div class="mx-auto">

        <div class="">
            <img src="{{ $photo }}" alt="Photo of {{ $name }}" class="mx-auto rounded-lg"/>
        </div>


        <div class="flex flex-col lg:gap-2 xl:gap-3 text-center lg:mt-2 xl:mt-6">

            <h5 class="font-roboto tracking-wide text-zinc-700 lg:lext-lg xl:text-xl">
                {{ $name }}
            </h5>

            <h6 class="font-gilroy text-rawl-purple font-bold uppercase lg:text-xs xl:text-sm">
                {{ $title }}
            </h6>

            @if(isset($sectorsss))
                <h6 class="font-open text-rawl-blue font-semibold lg:text-xs xl:text-sm">
                    {{ $sector }}
                </h6>
            @endif

        </div>
    </div>

</div>
