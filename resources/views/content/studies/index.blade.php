<x-layouts.main>

    <div class="container mx-auto">
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
        <div x-data="studyFilter">

            <x-partials.elements.header_top @click="clear"
                class="text-rawl-purple-dark mx-auto w-4/5 text-left text-5xl hover:cursor-pointer">
                Our work
            </x-partials.elements.header_top>

            <div class="mx-auto mt-8 w-4/5">
                <template x-for="category in categories">
                    <div @click="filterList(category.id)" x-text="category.name" :key="category.id"
                        :class="getClass(category)">
                    </div>
                </template>
            </div>

            <div x-show="show" x-transition:enter.duration.200ms x-transition:leave.duration.200ms
                class="mt-12 grid grid-cols-3 gap-1.5" no="transition duration-700 ease-in-out">
                <template x-for="filtered_study in filtered_studies">
                    <div class="block" :key="filtered_study.id">
                        <a :href="getSlug(filtered_study.slug)" x-html="filtered_study.logo_html">Image</a>
                        <span x-text="filtered_study.status"></span>
                    </div>
                </template>
            </div>
        </div>

        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("studyFilter", () => ({
                    categories: {!! $categories_json !!},
                    studies: {!! $studies_json !!},
                    filter_category: "",
                    filtered_studies: "",
                    show: false,
                    init() {
                        this.filtered_studies = this.studies;
                        this.show = true;
                        // console.log(Object.entries(this.categories));
                    },
                    filterList(category_id) {
                        // IMPROVE TRANSITION
                        // https://stackoverflow.com/questions/70271759/the-template-tag-doesnt-work-with-x-transition-in-alpine-js
                        this.show = false;
                        setTimeout(() => this.show = true, 100);
                        this.filter_category = category_id;
                        category_studies = _.find(this.categories, ["id", category_id]);
                        // console.log(category_studies.studies);
                        this.filtered_studies = category_studies.studies;
                        this.show = true;
                    },
                    getSlug(slug) {
                        return "/case-studies/" + slug;
                    },
                    getClass(category) {
                        base_class =
                            "font-roboto inline-block pr-4 text-2xl font-medium !leading-loose tracking-tight transition hover:cursor-pointer xl:text-3xl " +
                            category.colour + " ";
                        if (category.id == this.filter_category) {
                            base_class += "underline decoration-dashed decoration-2 underline-offset-8";
                        }
                        return base_class;
                    }
                }));
            });
        </script>

    </div>

    <x-partials.elements.project_cta />

</x-layouts.main>
