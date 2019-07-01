@extends('layouts.app',[
'title'=>'home',
'bodyStyle'=>""
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="card-body mb-4">
                    <h3>Transaksi Sampah Per Dusun</h3>
                    <canvas id="chart"></canvas>
                </div>
                <div class="card-body">
                    <h3>Nasabah per Dusun</h3>
                    <canvas id="nasabah-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-halaman')
<script>
    $(document).ready(function(){
            if($('#chart').length){
                let chart = $('#chart')[0].getContext('2d');
                let myChart = new Chart(chart, {
                    type: 'bar',
                    data: {
                        labels: {!!'["' . implode('", "', array_keys($transDus) ) . '"]'!!},
                        datasets: [{
                            label: 'Jumlah Transaksi',
                            data: {!!'["' . implode('", "', $transDus ) . '"]'!!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            if($('#nasabah-chart').length){
                let nasabahChart = $('#nasabah-chart')[0].getContext('2d');
                let myChart = new Chart(nasabahChart, {
                    type: 'bar',
                    data: {
                        labels: {!!'["' . implode('", "', array_keys($nasabahDusun) ) . '"]'!!},
                        datasets: [{
                            label: 'Jumlah Transaksi',
                            data: {!!'["' . implode('", "', $nasabahDusun ) . '"]'!!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })
</script>
@endsection