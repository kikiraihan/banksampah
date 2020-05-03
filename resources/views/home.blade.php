@extends('layouts.app',[
'title'=>'home',
'bodyStyle'=>""
])

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-9 px-3">
            <section class="py-4 card mb-3">
            <div class="container-fluid">
                <h4>Hi {{$user->name}} !</h4>
                <p class="small text-right"><span class="badge badge-info">Profile</span></p>
                <div class="table-responsive small">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nama :</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Nomor telepon</td>
                                <td>{{$user->telepon}}</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>{{$user->username}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                        </tbody>
                    </table>

                    @role ('Nasabah')

                        <div class="collapse" id="collapseExample">
                        <p class="text-right"><span class="badge badge-info">{{$user->kategori}}</span></p>
                        <table class="table">
                        <tbody>
                        <tr>
                            <td>Ktp :</td>
                            <td>{{$user->nasabah->ktp==NULL?'-':$user->ktp}}</td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td>{{$user->nasabah->provinsi}}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{{$user->nasabah->kota}}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>{{$user->nasabah->kecamatan}}</td>
                        </tr>
                        <tr>
                            <td>Kelurahan</td>
                            <td>{{$user->nasabah->kelurahan}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{$user->nasabah->alamat}}</td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    @endrole

                    <a class="d-block text-center text-info" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        {{--  <i class="fas fa-plus-square"></i>
                        <i class="fas fa-search-plus"></i>
                        <i class="fas fa-plus-circle"></i>  --}}
                        <i class="fas fa-caret-square-down"></i>
                        Collapse
                    </a>

                </div>


            </div>
            </section>
        </div>

        <div class="d-none d-xl-flex col-md-3">
            <div class=" card text-center"style="overflow:hidden;">
                <a href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/250x250.png" height="250" width="250" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
                <a href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/IDCloudHost-SSD-Cloud-Hosting-Indonesia-250x250.jpg" height="250" width="250" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
            </div>
        </div>

    </div>


    <div class="d-flex d-xl-none  card p-0 text-center" style="overflow:hidden;">
        <a href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/IDCloudHost-SSD-Cloud-Hosting-Indonesia-970x250.jpg" height="100" width="388.2" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
    </div>
    <br class="d-flex d-xl-none">






    <div class="row justify-content-center">
        <div class="container-fluid">
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
                    <h3>Transaksi Sampah Per Provinsi</h3>
                    <canvas id="chart"></canvas>
                </div>
                <div class="card-body">
                    <h3>Nasabah per Provinsi</h3>
                    <canvas id="nasabah-chart"></canvas>
                </div>
            </div>
        </div>
    </div>


    <br>
    <div class="d-none d-xl-flex  card p-0 text-center" style="overflow:hidden;">
        <a href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/IDCloudHost-SSD-Cloud-Hosting-Indonesia-970x250.jpg" height="250" width="970" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
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
                        labels: {!!'["' . implode('", "', array_keys($transProv) ) . '"]'!!},
                        datasets: [{
                            label: 'Jumlah Transaksi',
                            data: {!!'["' . implode('", "', $transProv ) . '"]'!!},
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
                        labels: {!!'["' . implode('", "', array_keys($nasabahProvinsi) ) . '"]'!!},
                        datasets: [{
                            label: 'Jumlah Transaksi',
                            data: {!!'["' . implode('", "', $nasabahProvinsi ) . '"]'!!},
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