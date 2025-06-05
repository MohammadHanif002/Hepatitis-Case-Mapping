<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div id="map"></div>

    <style>
        #map {
            height: 180vh;
        }

        .legend {
            background: white;
            padding: 10px;
            line-height: 18px;
            color: #333;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            font-size: 12px;
        }

        .legend i {
            display: inline-block;
        }

        .kecamatan-label {
            font-weight: bold;
            font-size: 12px;
            color: black;
            text-shadow: 1px 1px 2px white;
            background: none;
            pointer-events: none;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const map = L.map('map', {
                    zoomControl: false
                }).setView([-8.1724, 113.6950], 11);

                L.control.zoom({
                    position: 'topright'
                }).addTo(map);

                const colors = {
                    "ARJASA": "#e41a1c",
                    "AJUNG": "#28f7e6",
                    "AMBULU": "#377eb8",
                    "BANGSALSARI": "#4daf4a",
                    "JELBUK": "#984ea3",
                    "JENGGAWAH": "#ff7f00",
                    "KALISAT": "#e9f728",
                    "KALIWATES": "#ffff33",
                    "KENCONG": "#a65628",
                    "LEDOKOMBO": "#f781bf",
                    "MAYANG": "#999999",
                    "MUMBULSARI": "#66c2a5",
                    "PAKUSARI": "#fc8d62",
                    "PANTI": "#8da0cb",
                    "PATRANG": "#e78ac3",
                    "PUGER": "#a6d854",
                    "RAMBIPUJI": "#ffd92f",
                    "SILO": "#e5c494",
                    "SUKORAMBI": "#b3b3b3",
                    "SUKOWONO": "#1f78b4",
                    "SUMBER BARU": "#33a02c",
                    "SUMBER JAMBE": "#82ed3b",
                    "SUMBERSARI": "#fdbf6f",
                    "TANGGUL": "#cab2d6",
                    "TEMPUREJO": "#34d942",
                    "UMBULSARI": "#ffff99",
                    "WULUHAN": "#b15928",
                    "BALUNG": "#a1dab4",
                    "GUMUKMAS": "#2c7fb8",
                    "SEMBORO": "#253494",
                    "JOMBANG": "#d95f02",
                };

                const kecamatanLayers = {};

                function getColor(jumlahKasus) {
                    if (jumlahKasus >= 10) return "#e41a1c"; // Merah
                    if (jumlahKasus >= 5) return "#ffff33"; // Kuning
                    return "#4daf4a"; // Hijau
                }

                function style(feature) {
                    return {
                        fillColor: getColor(feature.properties.jumlah_kasus),
                        weight: 3,
                        opacity: 3,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                }

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                // Tambahkan legenda interaktif
                const legend = L.control({
                    position: 'topleft'
                });

                legend.onAdd = function(map) {
                    const div = L.DomUtil.create('div', 'legend');
                    const zones = [{
                            label: "Zona Merah (≥ 10 kasus)",
                            color: "#e41a1c"
                        },
                        {
                            label: "Zona Kuning (5 - 9 kasus)",
                            color: "#ffff33"
                        },
                        {
                            label: "Zona Hijau (< 5 kasus)",
                            color: "#4daf4a"
                        }
                    ];

                    zones.forEach(zone => {
                        const item = document.createElement('div');
                        item.innerHTML =
                            `<i style="background:${zone.color}; width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7;"></i> ${zone.label}`;
                        div.appendChild(item);
                    });


                    L.DomEvent.disableClickPropagation(div);
                    return div;
                };

                legend.addTo(map);

                // Ambil dan tampilkan GeoJSON
                fetch('/index.php/geojson')
                    .then(res => res.json())
                    .then(data => {
                        L.geoJSON(data, {
                            style: style,
                            onEachFeature: function(feature, layer) {
                                const p = feature.properties;
                                const popup = `
                                    <strong>ID:</strong> ${p.id}<br>
                                    <strong>Kecamatan:</strong> ${p.kecamatan}<br>
                                    <strong>Jumlah Kasus:</strong> ${p.jumlah_kasus ?? 'Tidak ada data'}<br>
                                    <strong>Tahun:</strong> ${p.tahun ?? '-'}
                                `;
                                layer.bindPopup(popup);

                                layer.bindTooltip(p.kecamatan, {
                                    permanent: true,
                                    direction: "center",
                                    className: "kecamatan-label"
                                });

                                // Simpan referensi layer berdasarkan kecamatan
                                if (p.kecamatan) {
                                    kecamatanLayers[p.kecamatan] = layer;
                                }
                            }
                        }).addTo(map);
                    });
            });
        </script>
    @endpush
</x-layout>
