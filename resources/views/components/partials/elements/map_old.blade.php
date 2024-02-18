<div class="container mx-auto">
    <div id="map" class="lg:mt-36"></div>
</div>

<style>
    #map {
        height: 400px; /* The height is 400 pixels */
        width: 100%; /* The width is the width of the web page */
    }

</style>

<script>
    (g => {
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
    })({
        key: "AIzaSyAy8IfN7kuCZX26o116kxbK0CpSwATgyYM",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
    });
</script>


<script>
    // Initialize and add the map
    let map;

    async function initMap() {

        const styles = [{"elementType": "geometry", "stylers": [{"color": "#f5f5f5"}]}, {
            "elementType": "labels.icon",
            "stylers": [{"visibility": "off"}]
        }, {"elementType": "labels.text.fill", "stylers": [{"color": "#616161"}]}, {
            "elementType": "labels.text.stroke",
            "stylers": [{"color": "#f5f5f5"}]
        }, {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#bdbdbd"}]
        }, {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#eeeeee"}]}, {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#757575"}]
        }, {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [{"color": "#e5e5e5"}]
        }, {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#9e9e9e"}]
        }, {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [{"color": "#ffffff"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#757575"}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [{"color": "#dadada"}]
        }, {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#616161"}]
        }, {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#9e9e9e"}]
        }, {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [{"color": "#e5e5e5"}]
        }, {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [{"color": "#eeeeee"}]
        }, {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{"color": "#c9c9c9"}]
        }, {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#7a7ade"}]
        }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#9e9e9e"}]}]

        const rawlings = {lat: 51.454784, lng: -2.474534}
        // Request needed libraries.
        //@ts-ignore
        const {Map} = await google.maps.importLibrary("maps");
        const {AdvancedMarkerElement} = await google.maps.importLibrary("marker");

        // The map, centered at Uluru
        map = new Map(document.getElementById("map"), {
            zoom: 16,
            center: rawlings,
            mapId: "b618c14e29d9eab0",
            styles
        });

        // The marker, positioned at Uluru
        const marker = new AdvancedMarkerElement({
            map: map,
            position: rawlings,
            title: "Rawlings",
        });
    }

    initMap();

</script>