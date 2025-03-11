@props(['hasNavbar' => false, 'id' => 'map'])
@pushOnce('js-scripts')
<script type="text/javascript">
    function addDrawControls(map, options) {
        const draw_options = {...DEFAULT_DRAW_OPTIONS, ...options};

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems)

        const shape_options = ['polyline', 'polygon', 'rectangle', 'circle'];


        for (let shape of shape_options) {
            if (draw_options[shape]) {
                draw_options[shape] = {
                    shapeOptions: draw_options.drawColor
                }
            }
        }
        console.log(draw_options)

        var drawControl = new L.Control.Draw({
            position: 'topright',
            draw: draw_options,
            edit: {
                featureGroup: drawnItems,
            }
        });

        map.on(L.Draw.Event.CREATED, function (e) {
            let radius;
            var type = e.layerType,
                layer = e.layer;

            if (type === 'marker') {
                // Do marker specific actions
            }
            // Do whatever else you need to. (save to db; add to map etc)
            drawnItems.addLayer(layer);
        });

        map.addControl(drawControl);
    }

    const DEFAULT_SHAPE_OPTIONS = {
        color: '#000',
        opacity: 0.85,
        fillOpacity: 0.55
    };

    const DEFAULT_DRAW_OPTIONS = {
        polyline: false,
        circle: true,
        rectangle: true,
        polygon: true,
        control: true,
        circlemarker: false,
        marker: false,
        multiDraw: false,
        drawColor: DEFAULT_SHAPE_OPTIONS,
        lang: "en",
    };

    function initMap(id) {
        const DEFAULT_MAP_OPTIONS = {
            center: [0, 0],
            zoom: 2,
            minZoom: 2,
        };

        let map = L.map(id, DEFAULT_MAP_OPTIONS);

        const terrainLayer = L.tileLayer('https://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            maxZoom: 20,
            worldCopyJump: true,
            detectRetina: true,
        }).addTo(map);

        const basicLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            displayRetina: true,
            maxZoom: 20,
            noWrap: true,
            tileSize: 256,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        const layers = {
            "Terrain": terrainLayer,
            "Basic": basicLayer,
        };
        L.control.layers(layers).addTo(map);

        if (!window.maps) {
            window.maps = {
                [id]: map
            }
        } else {
            window.maps[id] = map;
        }

        document.dispatchEvent(new CustomEvent("mapIntialized", {
            detail: {
                map_id: id,
                type: 'leaflet'
            }
        }));
    }
</script>
@endPushOnce

@push('js-scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        initMap("{{ $id }}");
    }, {once: true});
</script>
@endpush

@if($hasNavbar)
{{-- TODO (Logan) figure out how to make this value always reflect nav bar height--}}
<div id="{{ $id }}" class="w-full h-[calc(100vh_-_56px)]"></div>
@else
<div id="{{ $id }}" class="w-full h-[100vh]"></div>
@endif
