<div x-data="{
        id: {{ $id }},
        get expanded() {
            return this.active === this.id
        },
        set expanded(value) {
            this.active = value ? this.id : null
        },
    }" role="region" class="rounded-lg bg-white border border-gray-200 p-4 mb-4">
    <h2>
        <button
            x-on:click="expanded = !expanded"
            :aria-expanded="expanded"
            class="flex w-full items-center justify-between text-xl font-bold"
        >
            <span>{{ $title }}</span>
            <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
            <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
        </button>
    </h2>

    {{ $slot }}
</div>
