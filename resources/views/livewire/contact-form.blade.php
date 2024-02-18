<div class="container mx-auto mt-20">

    @if(count($products) > 0)
        <div class="lg:mt-12 xl:mt-16 mx-4">
            <div class="flex justify-end">
                <x-partials.elements.subheader_line>Product basket</x-partials.elements.subheader_line>
            </div>
            <div class="flex flex-col gap-1"> {{-- border border-2 border-dashed --}}
                @foreach ($products as $product)
                    <div x-data="{cancel: false}" wire:key="{{ $product['reference'] }}"
                         class="flex flex-row items-center justify-between lg:py-8 xl:py-12 border-b border-dashed :group">
                        <a href="{{ $product['url'] }}" class="w-2/12" :class="{'opacity-30': cancel}">
                            <img src="{{ $product['image'] }}" class="h-28">
                        </a>
                        <a href="{{ $product['url'] }}" class="w-8/12 text-left hover:cursor-pointer"
                           :class="{'opacity-30': cancel}">
                            <div
                                class="text-rawl-purple text-2xl font-roboto font-light mb-2 :group-h$over:text-rawl-purple-dark">{{ $product['name'] }}</div>
                            <div
                                class="g:text-sm xl:text-base lg:leading-tight xl:leading-tight 2xl:leading-normal font-gilroy font-light text-zinc-400">
                                Ref {{ $product['reference'] }}
                            </div>
                        </a>
                        <div class="w-2/12 flex justify-end">
                            <div x-show=" !cancel
                        ">
                                <x-bi-x-circle-fill
                                    @click="cancel = true;setTimeout(() => cancel = false, 10000)"
                                    class="h-8 w-8 text-rawl-purple-pale hover:text-rawl-purple hover:scale-110 hover:cursor-pointer transition"
                                />
                            </div>
                            <div x-show="cancel" class="flex flex-row items-center">
                                <x-bi-x-circle-fill
                                    @click="cancel = false;"
                                    class="h-6 w-6 text-rawl-purple hover:scale-110 hover:cursor-pointer transition"
                                />
                                <div x-show="cancel"
                                     @click="cancel = false;"
                                     class="text-sm mx-3 text-rawl-purple font-open w-24 top-2 -left-32">
                                    Are you sure?
                                </div>
                                <x-bi-check-circle-fill
                                    @click="$wire.removeItem({{ $product['id'] }})"
                                    class="h-8 w-8 text-rawl-blue hover:scale-110 hover:cursor-pointer transition"
                                />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="lg:mt-12 xl:mt-12 mx-4">
        <form wire:submit.prevent="send">
            <div class="grid grid-cols-2 gap-12 items-start">

                <div class="w-full grid gap-6">

                    <x-partials.elements.contact_input wire:model.live="name" inputname="name" name="name"
                                                       placeholder="Your full name"/>

                    <x-partials.elements.contact_input wire:model.live="email" inputname="email" name="email"
                                                       placeholder="Your email"/>

                    <x-partials.elements.contact_input wire:model.live="phone" inputname="phone" name="phone"
                                                       placeholder="Your phone number"/>

                    <x-partials.elements.contact_select inputname="market" label="Your market sector" name="market"
                                                        :options="$markets"/>

                    <fieldset class="block mt-2">
                        <legend class="font-open text-base font-semibold @error('services') text-red-500 @else text-zinc-500 @enderror">
                            Type of enquiry
                        </legend>
                        <div class="grid lg:grid-cols-2  lg:gap-3 mt-4">
                            <x-partials.elements.contact_checkbox group="services" value="Packaging" label="Packaging"/>
                            <x-partials.elements.contact_checkbox group="services" value="Decoration" label="Decoration"/>
                            <x-partials.elements.contact_checkbox group="services" value="Design" label="Design"/>
                            <x-partials.elements.contact_checkbox group="services" value="Dolium" label="Dolium One Way Kegs"/>
                            <x-partials.elements.contact_checkbox group="services" value="Other" label="Other"/>
                        </div>
                        <x-error field="services" class="mt-2 text-sm font-open text-red-500"/>
                    </fieldset>

                </div>

                <div class="w-full grid gap-6">
                    <div class="">
                        <div>
                            <label for="enquiry" class="sr-only">Enquiry</label>
                            <textarea wire:model.live="enquiry" rows="4" name="enquiry" id="enquiry"
                                      placeholder="Please tell us about your project such as what product type, quantity, etc"
                                      class="h-64 block w-full rounded-md border-0 py-2 px-4 ring-1 ring-inset  focus:ring-2 focus:ring-inset text-base sm:leading-6 font-open @error('enquiry') text-red-900 ring-red-300 font-medium placeholder:text-red-500 focus:ring-red-500 @else text-zinc-800  font-medium ring-zinc-300 focus:ring-rawl-purple placeholder:text-zinc-400 @enderror"
                                      aria-invalid="true" aria-describedby="enquiry"></textarea>
                        </div>
                        <x-error field="enquiry" class="mt-2 text-sm font-open text-red-500"/>
                    </div>

                    <x-partials.elements.contact_input wire:model="source" inputname="source" name="source"
                                                       placeholder="How did you hear about us?"/>

                    <div class="mt-6 text-center">
                        <button type="submit"
                                class="bg-white px-8 py-4 rounded-full border border-2 uppercase text-rawl-purple font-bold text-sm font-gilroy tracking-widest border-rawl-purple hover:text-white hover:bg-rawl-purple transition">
                            Submit your enquiry
                        </button>
                    </div>
                </div>


            </div>

        </form>
    </div>
</div>
