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
    </style>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var map = L.map('map', {
                    zoomControl: false
                }).setView([-8.1724, 113.6950], 11);

                L.control.zoom({
                    position: 'topright'
                }).addTo(map);

                // Warna berdasarkan nama kecamatan
                var colors = {
                    "ARJASA": "#e41a1c",
                    "AMBULU": "#377eb8",
                    "BANGSALSARI": "#4daf4a",
                    "JELBUK": "#984ea3",
                    "JENGGAWAH": "#ff7f00",
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
                    "KASIANDAAN": "#41b6c4",
                    "GUMUK MAS": "#2c7fb8",
                    "SEMBORO": "#253494",
                    "JOMBANG": "#d95f02",
                    "TAMBAKSARI": "#7570b3"
                };

                // Fungsi getColor harus didefinisikan
                function getColor(kecamatan) {
                    return colors[kecamatan] || "#cccccc"; // default jika kecamatan tidak dikenali
                }

                function style(feature) {
                    return {
                        fillColor: getColor(feature.properties.kecamatan),
                        weight: 3,
                        opacity: 3,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                }

                function popUp(feature, layer) {
                    if (feature.properties) {
                        const content = Object.entries(feature.properties)
                            .map(([key, value]) => `${key}: ${value}`)
                            .join("<br>");
                        layer.bindPopup(content);
                    }
                }

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                // Tambahkan kontrol legenda
                var legend = L.control({
                    position: 'topleft'
                });

                legend.onAdd = function(map) {
                    var div = L.DomUtil.create('div', 'legend');
                    var kecamatanList = Object.keys(colors);
                    for (var i = 0; i < kecamatanList.length; i++) {
                        var kec = kecamatanList[i];
                        var color = colors[kec];
                        div.innerHTML +=
                            '<i style="background:' + color +
                            '; width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7;"></i> ' +
                            kec + '<br>';
                    }
                    return div;
                };

                legend.addTo(map); // <--- penting agar tampil

                fetch('{{ route('geojson') }}')
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
                            }
                        }).addTo(map);
                    });
            });
        </script>
    @endpush
</x-layout>
