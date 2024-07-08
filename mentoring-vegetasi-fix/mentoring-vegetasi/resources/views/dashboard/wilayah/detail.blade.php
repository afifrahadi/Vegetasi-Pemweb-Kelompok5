@extends('layouts.app')

@section('background_url', '/assets/topographic-5.1.svg')

@section('content')
    <h1>Detail Wilayah {{ $wilayah->name }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-soft-primary">&leftarrow; Kembali</a>

    <canvas id="myChart" width="400" height="100"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Jumlah Spesies',
                        data: {!! json_encode($data) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Spesies'
                            },
                            ticks: {
                                precision: 0,
                                callback: function(value, index, values) {
                                    return value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Vegetasi'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (!isNaN(context.parsed.y)) {
                                        label += context.parsed.y.toLocaleString('id-ID');
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
