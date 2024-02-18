<section
    class="container mx-auto mt-12 grid md:grid-cols-2 lg:mb-16 lg:mt-16 lg:grid-cols-4 xl:mb-20 xl:mt-20 2xl:mb-24 2xl:mt-24">

    <div class="mx-2 text-xs text-zinc-500 md:pl-4">
        <x-partials.elements.logo />

        <div class="mt-6">
            <address class="space-y-2 not-italic">
                <div class="font-bold text-rawl-purple">Rawlings &amp; Son (Bristol) Ltd</div>
                <div>Unit 3, Crown Road,</div>
                <div>Warmley, Bristol,</div>
                <div>BS30 8JJ,</div>
                <div>United Kingdom</div>
            </address>

            <div class="mt-3">Company No: 330872</div>

            <div class="mt-8">&copy; Rawlings &amp; Son (Bristol) Ltd</div>

            <ul class="mt-3 space-y-3">
                <li><a href="/terms-and-conditions" class="text-zinc-500 hover:text-zinc-800">Website Terms and
                        Conditions</a></li>
                <li><a href="/privacy-policy" class="text-zinc-500 hover:text-zinc-800">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="mt-8">
            <button class="termly-cookie-preference-button" type="button"
                style="background: white; width: 165px; height: 30px; border-radius: 3px; border: 1px solid #5f7d9c; font-family: Roboto, Arial; font-size: 10px; color: #5f7d9c; font-weight: 600; box-sizing: border-box; cursor: pointer; padding: 0; outline: none;"
                onclick="displayPreferenceModal()">Cookie preferences
            </button>
        </div>
    </div>

    <div class="mx-2 mt-8 md:mt-0 lg:pl-12">
        <x-partials.elements.subheader_line>Company</x-partials.elements.subheader_line>
        <ul class="mt-6 space-y-3 text-xs transition">
            <li>
                <a href="https://www.jarsdirect.com/" class="text-zinc-500 hover:text-zinc-800">Buy online</a>
            </li>
            <li>
                <a href="/about-us" class="text-zinc-500 hover:text-zinc-800">About us</a>
            </li>
            <li>
                <a href="/case-studies" class="text-zinc-500 hover:text-zinc-800">Case studies</a>
            </li>
            <li>
                <a href="/news" class="text-zinc-500 hover:text-zinc-800">News articles</a>
            </li>
            <li class="text-zinc-500 hover:text-zinc-800">
                <a href="/services">Services</a>
            </li>
        </ul>
        <div class="mt-6 md:mt-16">
            <div class="text-xs text-zinc-500">Part of the <a href="https://rawlingsgroup.co.uk"
                    class="text-rawl-purple underline decoration-dashed decoration-1 underline-offset-4 hover:text-rawl-purple-dark">Rawlings
                    Group</a></div>
            <a href="https://rawlingsgroup.co.uk" class="mt-3 inline-block"><img
                    src="https://rawlingsgroup.co.uk/images/rawlings_group_logo.png" alt="Rawlings Group logo"
                    width="200"></a>
        </div>
    </div>

    <div class="mx-2 mt-8 lg:mt-0 lg:pl-16">
        <x-partials.elements.subheader_line>Products</x-partials.elements.subheader_line>

        <ul class="mt-6 space-y-3 text-xs transition">

            @foreach (Cache::get('layout.navigation.product_categories') as $footer_category)
                <li>
                    <a href="/products/{{ $footer_category->slug }}"
                        class="text-zinc-500 hover:text-zinc-800">{{ $footer_category->name }}</a>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="x-2 mt-8 lg:mt-0 lg:pl-16">
        <div class="w-4/5">
            <x-partials.elements.subheader_line>Get in Touch</x-partials.elements.subheader_line>
            <div class="mt-6 text-xs text-zinc-500">
                <div class="leading-5">If you have an enquiry, please complete the enquiry form or give us a call or an
                    email. We will contact you as soon as possible.
                </div>
                <div class="mt-4 space-y-4">
                    <div><a href="mailto:hello@rawlingsgroup.co.uk"
                            class="text-rawl-purple underline decoration-dashed decoration-1 underline-offset-4 hover:text-rawl-purple-dark">hello@rawlingsgroup.co.uk</a>
                    </div>
                    <div><a href="tel:+441179604141"
                            class="text-rawl-purple underline decoration-dashed decoration-1 underline-offset-4 hover:text-rawl-purple-dark">+44
                            (0) 117
                            960 4141</a></div>
                    <div class="flex items-center space-x-8">
                        <a href="https://www.facebook.com/rawlingsson" class="text-rawl-purple">FB ICON</a>
                        <a href="https://twitter.com/rawlingsbristol" class="text-rawl-purple">TW ICON</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
