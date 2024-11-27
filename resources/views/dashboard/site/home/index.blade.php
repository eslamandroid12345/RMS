@extends('dashboard.core.app')
@section('title', __('dashboard.Home'))
@section('content')
    <style>
        .main-footer{
            display: none;
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid homeDashboard">
            <div class="intro">
                <h1>
                    {{-- @lang('dashboard.Home') --}}
                    @lang('dashboard.Welcome_Back') {{ $user->name }}</h1>
                <p>{{$user->email}}</p>
            </div>
            <hr>
            <div class="row mb-2 justify-content-space-between">
                <div class="col-md-6 col-border shadowCard">

                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <div class="box">
                                <h2>@lang('dashboard.Team_Members')</h2>
                                <p>{{$users->count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box">
                                <h2>@lang('dashboard.Today_Reports')</h2>
                                <p>{{$reports->count()}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box">
                                <h2>@lang('dashboard.Responded_Report')</h2>
                                <p>{{$veiwedReports}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box">
                                <h2>@lang('dashboard.Waiting_For_Reply')</h2>
                                <p>{{$recievedReports}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-border chart shadowCard">
                    <div class="d-flex justify-content-space-between">
                        <h2>
                            Team Status
                        </h2>
                        <span>Data Updates Every 24 hours</span>
                    </div>
                        <canvas id="myChart"></canvas>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="container boxActivity">

                            <h2 class="mb-4">Recent Activities</h2>
                        @foreach($recentReports as $report)
                            <div class="activity mt-3 shadowCard">
                                <div class="d-flex justify-content-space-between">
                                    <div class="d-flex">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From {{$report->user->name}}</h3>
                                    </div>
                                    <div class="feedback">
                                    @for($i=1;$i<=5;$i++)
                                        @if($i<=$report->rating)
                                            <i class="fas fa-star star-fill"></i>
                                        @else
                                            <i class="far fa-star star-emp"></i>
                                        @endif
                                    @endfor
                                    </div>
{{--                                    <div class="feedback">--}}
{{--                                        <i class="fas fa-star star-fill"></i>--}}
{{--                                        <i class="fas fa-star star-fill"></i>--}}
{{--                                        <i class="far fa-star star-emp"></i>--}}
{{--                                        <i class="far fa-star star-emp"></i>--}}
{{--                                        <i class="far fa-star star-emp"></i>--}}
{{--                                    </div>--}}
                                </div>
                                <hr style="margin: 0">
                                <span>{{$report->created_at}} </span>
                            </div>
                        @endforeach


                    </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
    <script>
        const ctx = document.getElementById('myChart');
        const chartData = @json($teamStatus);

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.map(item => item.label),
                datasets: [{
                    data: chartData.map(item => item.value),
                    backgroundColor: chartData.map(item => item.color), // Specify colors here
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
<script>

</script>
@endsection
