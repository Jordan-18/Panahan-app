@extends('layouts.frontend')

@section('title','Archery UNIDA')

@section('content')
    @php
        if ($jenis == 0) {
            $presentasehorsebow = 0;
            $presentasestandardbow = 0;
        }else {
            $presentasehorsebow = ($horsebow / $jenis) * 100;
            $presentasestandardbow = ($standard / $jenis) * 100;
        }
    @endphp
    <!-- Begin Page Content -->
    <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    @guest
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Mapping</h6>
            </div>
            <div class="card-body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1012322.4431620524!2d110.43409795918097!3d-7.641730772956607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a009f029d9ff%3A0x45ba8a5e3e861173!2sLapangan%20Panahan%20(%20Unida%20Archery%20Club%20)!5e0!3m2!1sid!2sid!4v1644202141084!5m2!1sid!2sid" style="border:0;" allowfullscreen=""loading="lazy" class="mapping"></iframe>
            </div>
        </div>
    @endguest 
    
    @auth
    @if (Auth::user()->roles == "ADMIN")
        <!-- Content Row -->
        <div class="row">

        <!-- Horse Bow -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Horse Bow
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{round($presentasehorsebow,2).'%'}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{round($presentasehorsebow,2).'%'}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <img src="https://img.icons8.com/external-game-ui-maxicons/50/000000/external-archer-avatar-classes-role-playing-game-game-ui-maxicons-2.png"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Standard Bow -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Standard Bow
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{round($presentasestandardbow,2).'%'}}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{round($presentasestandardbow,2).'%'}}"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-auto">
                                <img src="https://img.icons8.com/external-justicon-lineal-color-justicon/40/000000/external-archery-sport-avatar-justicon-lineal-color-justicon.png"/>
                            </div>
                    </div>
                </div>
            </div>
        </div>
                
        </div>
        <!-- chart line & pie -->
        <div class="row">
            <!-- point-line -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Data Pengunaan Busur</h6>
                </div>
                <div class="card-body">
                    <div id="point-line"></div>
                </div>
                </div>
            </div>
            <!--pie chart --> 
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">Data Dummy</h6>
                </div>
                <div class="card-body">
                    <div id="myPieChart"></div>
                </div>
                </div>
            </div>
        </div>
        
        {{-- data chart --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Data</h6>
            </div>
            <div class="card-body">
                <div id="container"></div>
            </div>
        </div>
    @elseif (Auth::user()->roles == "PUBLISHER")
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Data</h6>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    @endif
        <!-- File detail Card -->
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Your Data Equip</h6>
                    </div>
                    <div class="card-body">
                        <div id="userstandard"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Data</h6>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    @endauth
    </div>

{{-- script ADMIN --}}
<script type="text/javascript">
    var countusers = {{json_encode($countusers)}};
    var countuvents = {{json_encode($countuvents)}};
    const countdata = countusers.concat(countuvents);
    var counthorsebow = {{json_encode($counthorsebow)}};
    var countstandard = {{json_encode($countstandard)}};
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                scrollablePlotArea: {
                minWidth: 600,
                scrollPositionX: 1
                }
            },
            title: {
                text: 'Data Display'
            },
            subtitle: {
                text: 'Data Number of Users and Files'
            },
            xAxis: {
                categories: ['Users', 'Events']
            },
            yAxis: {
                title: {
                    text: 'Number of New Users & data Uploaded'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [
                {
                    name: 'Data',
                    data: countdata
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        Highcharts.chart('point-line', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Monthly Average Temperature'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                tickInterval: 7 * 24 * 3600 * 1000, // one week
                tickWidth: 0,
                gridLineWidth: 1,
                labels: {
                    align: 'left',
                    x: 3,
                    y: -3
                }
            },
            yAxis: {
                title: {
                    text: 'Data'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Standard Bow',
                data: countstandard
            }, {
                name: 'Horse Bow',
                data: counthorsebow
            }]
        });
        Highcharts.chart('myPieChart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Data Dummy'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Chrome',
                    y: 61.41,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Data',
                    y: 11.84
                }, {
                    name: 'Data',
                    y: 10.85
                }, {
                    name: 'Data',
                    y: 4.67
                }, {
                    name: 'Data',
                    y: 4.18
                }, {
                    name: 'Data',
                    y: 1.64
                }, {
                    name: 'Data',
                    y: 1.6
                }, {
                    name: 'Data',
                    y: 1.2
                }, {
                    name: 'Data',
                    y: 2.61
                }]
            }]
        });
        
</script>
<script>
    Highcharts.chart('userstandard', {
        title: {
            text: 'Data Equip'
        },
        chart: {
            type: 'spline',
        },
        yAxis: {
            title: {
                text: 'Total Data'
            },
            accessibility: {
                rangeDescription: 'Range: 0.1 to 31'
            }
        },

        xAxis: {
            type: 'day',
            labels: {
                overflow: 'justify'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        series: [{
            name: 'Standard Bow',
            data: {{$userstandard}}
        }, {
            name: 'Horse Bow',
            data: {{$userhorsebow}}
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
@endsection