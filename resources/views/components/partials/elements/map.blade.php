@once
    <script>(g => {
            var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
                m = document, b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })
        ({key: "AIzaSyB6-FSKjCuJMcW1utmDMK0PEYINMSaFnsU", v: "weekly"});
    </script>
@endonce

<script>
    let {{ $mapId }};

    async function initMap() {

        const position = {lat: {{ $lat }}, lng: {{ $lng }}};
        //@ts-ignore
        const {Map} = await google.maps.importLibrary("maps");
        const {AdvancedMarkerElement} = await google.maps.importLibrary("marker");

        // The map, centered at Uluru
        {{ $mapId }} = new Map(document.getElementById("{{ $mapId }}"), {
            zoom: {{ $zoom }},
            center: position,
            mapId: "8a74ca179e03edb3s"
        });

        // The marker, positioned at Uluru
        const marker = new AdvancedMarkerElement({
            map: {{ $mapId }},
            position: position,
            title: "Rawlings",
        });
    }

    initMap();

</script>
<style>
    #{{ $mapId }}2 {
        height: {{ $height }}; /* The height is 400 pixels */
    }

</style>

<div id="{{ $mapId }}" class="w-full {{ $height }}"></div>
@isset($href)
    <div class="text-right pt-2">
        <a href="https://www.google.com/maps/place/53°47'11.6%22N+1°30'09.1%22W/@53.7865667,-1.5031692,19z/data=!3m1!4b1!4m4!3m3!8m2!3d53.7865659!4d-1.5025255?entry=ttu"
           class="font-roboto text-rawl-purple hover:text-rawl-purple-dark text-sm">View
            on larger map</a>
    </div>
@endisset
