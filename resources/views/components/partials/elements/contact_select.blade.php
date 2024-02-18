@props(['inputname', 'label', 'options'])
<div class=""
     x-data="{
         selected: {{ json_encode($options[0]) }},
         open: false,
         selectedIndex: 0,
         activeIndex: 0,
         items: {{ json_encode($options) }} ,
     }"
     x-init="">
    <label id="listbox-label" class="sr-only">{{ $label }}</label>
    <div class="relative">
        <button @click="open = ! open" x-ref="button"
                class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left text-base font-medium font-open ring-1 ring-inset  focus:outline-none focus:ring-2 focus:ring-rawl-purple @error($inputname) ring-red-500 @else ring-gray-300 @enderror"
                type="button" aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
            <span x-text="selected.name" class="block truncate"
                  :class="{ 'text-zinc-800': selectedIndex !== 0, 'text-zinc-400': selectedIndex === 0 }"></span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
          <svg class="h-5 w-5 " viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
  <path fill-rule="evenodd"
        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
        clip-rule="evenodd"></path>
</svg>
        </span>
            <input wire:model.live="{{ $inputname }}" :value="selected.value" type="hidden"/>
        </button>


        <ul x-show="open" x-anchor="$refs.button" x-ref="listbox" tabindex="-1" role="listbox"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class=" z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white ring-1 ring-zinc-300 focus:ring-rawl-purple"
            x-max="1" @click.away="open = false"
            aria-labelledby="listbox-label">
            <template x-for="item in items">
                <li x-show="item.id !== '0'" x-state:on="Highlighted" x-state:off="Not Highlighted"
                    class="font-medium text-base relative cursor-default select-none py-0.5 pl-3 pr-9 hover:cursor-pointer"
                    :id="'listbox-option-'+item.id" role="option"
                    @mouseEnter="activeIndex=item.id" @mouseLeave="activeIndex=0"
                    @click="$wire.validate_{{ $inputname }}(item.value);selectedIndex=item.id;selected=item;open=false"
                    :class="{ 'text-white bg-rawl-purple': (activeIndex === item.id || selectedIndex === item.id), 'text-zinc-800': !(activeIndex === item.id)}">
                    <span x-text="item.name" :class="{ 'text-white bg-rawl-purple': selectedIndex === item.id, '': !(selectedIndex === item.id) }"></span>
                </li>
            </template>
        </ul>

    </div>
    <x-error field="{{ $inputname }}" class="mt-2 text-sm font-open text-red-500"/>
</div>
