<x-layout>
    <x-slot:title>Grafik Kasus Hepatitis A per Kecamatan</x-slot>
    <div class="max-w-4xl mx-auto my-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4 text-center">Grafik Jumlah Kasus Hepatitis A per Kecamatan</h2>
        <canvas id="kasusChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kasusChart').getContext('2d');
        const kasusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: {!! json_encode($values) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Kasus'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Kecamatan'
                        }
                    }
                }
            }
        });
    </script>
</x-layout>
