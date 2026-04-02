@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Pasien</div>
                    <div class="card-body">
                        <h3>{{ $totalPasien }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Reservasi Hari Ini</div>
                    <div class="card-body">
                        <h3>{{ $totalReservasiHariIni }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Pilihan Grafik -->
        <div class="d-flex justify-content-start mt-3">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" id="btnBulan" class="btn btn-danger" onclick="fetchData('bulan')">Grafik Per Bulan</button>
                <button type="button" id="btnHari" class="btn btn-success" onclick="fetchData('hari')">Grafik Per Hari</button>
            </div>
            {{-- <button id="btnBulan" class="btn btn-primary me-2" onclick="fetchData('bulan')"></button>
            <button id="btnHari" class="btn btn-outline-primary" ></button> --}}
        </div>

        <!-- Grafik -->
        <div class="card">
            <div class="card-header"><span id="judulGrafik">Grafik Kunjungan Per Bulan</span></div>
            <div class="card-body">
                <canvas id="reservasiChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let chart; // Variabel global untuk chart

        function fetchData(mode) {
            fetch(`/dashboard?mode=${mode}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Data dari server:", data); // Debugging
                    document.getElementById('judulGrafik').textContent = mode === 'bulan' ?
                        'Grafik Kunjungan Per Bulan' : 'Grafik Kunjungan Per Hari';

                    // Update tombol active/inactive
                    document.getElementById('btnBulan').classList.toggle('btn-danger', mode === 'bulan');
                    document.getElementById('btnBulan').classList.toggle('btn-outline-danger', mode !== 'bulan');
                    document.getElementById('btnHari').classList.toggle('btn-success', mode === 'hari');
                    document.getElementById('btnHari').classList.toggle('btn-outline-success', mode !== 'hari');

                    loadChart(data.labels, data.values);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function loadChart(labels, values) {
            const ctx = document.getElementById('reservasiChart').getContext('2d');

            if (chart) {
                chart.destroy(); // Hapus chart lama sebelum buat baru
            }

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Reservasi',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Panggil fungsi fetchData('bulan') saat halaman pertama kali dibuka
        window.onload = function() {
            fetchData('bulan');
        };
    </script>
@endsection
