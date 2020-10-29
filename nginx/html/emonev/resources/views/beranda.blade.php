@extends('layouts.admin')

@section('konten')
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Beranda</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Beranda</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-light">{{ $var['jum_sp2d'] }}</h3>
                            <h5 class="text-muted m-b-0">Jumlah Data SP2D</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{ $var['jum_spj'] }}</h3>
                            <h5 class="text-muted m-b-0">Jumlah Data SPJ</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-account"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h3 class="m-b-0 font-lgiht">{{ $var['jum_user'] }}</h3>
                            <h5 class="text-muted m-b-0">Jumlah Pengguna</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="myChartBar" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <canvas id="myChartBar2" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')    
    <script type="text/javascript">
        var ctx = document.getElementById("myChartBar").getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $var['bulan2'] !!},
                datasets: [
                    {
                        label: "Total SP2D",
                        backgroundColor: 'rgba(255, 99, 132, 1)',
                        data: {!! $var['listJumTotal'] !!}
                    },
                    {
                        label: "UP",
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        data: {!! $var['listJumUP'] !!}
                    },
                    {
                        label: "GU",
                        backgroundColor: 'rgba(255, 206, 86, 1)',
                        data: {!! $var['listJumGU'] !!}
                    },
                    {
                        label: "TU",
                        backgroundColor: 'rgba(75, 192, 192, 1)',
                        data: {!! $var['listJumTU'] !!}
                    },
                    {
                        label: "LS",
                        backgroundColor: 'rgba(153, 102, 255, 1)',
                        data: {!! $var['listJumLS'] !!}
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah SP2D Per Bulan Tahun {{ \Carbon\Carbon::now()->format('Y') }}',
                    fontSize: 16,
                },
                tooltips: {
                    mode: 'label',
                    callbacks: {
                        label: function(tooltipItems, data) { 
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = tooltipItems.yLabel.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return data.datasets[tooltipItems.datasetIndex].label + ' : Rp ' + value;
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                
                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return 'Rp ' + value;
                            }
                        },
                    }]
                }
            }
        });

        var ctx2 = document.getElementById("myChartBar2").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! $var['bulan2'] !!},
                datasets: [
                    {
                        label: "Debet",
                        backgroundColor: 'rgba(255, 99, 132, 1)',
                        data: {!! $var['listJumSpjDebet'] !!}
                    },
                    {
                        label: "Kredit",
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        data: {!! $var['listJumSpjKredit'] !!}
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Jumlah SPJ Per Bulan Tahun {{ \Carbon\Carbon::now()->format('Y') }}',
                    fontSize: 16,
                },
                tooltips: {
                    mode: 'label',
                    callbacks: {
                        label: function(tooltipItems, data) { 
                             console.log(tooltipItems);
                            console.log(data);
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = tooltipItems.yLabel.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            
                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return data.datasets[tooltipItems.datasetIndex].label + ' : Rp ' + value;
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);
                                
                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return 'Rp ' + value;
                            }
                        },
                    }]
                }
            }
        });
    </script>
@endsection