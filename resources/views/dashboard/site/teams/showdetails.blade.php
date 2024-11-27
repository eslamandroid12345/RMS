@extends('dashboard.core.app')
@section('title', __('dashboard.Teams'))
@section('css_addons')
    <style>
        .card {
            background-color: transparent !important;
            box-shadow: none
        }

        .footer {
            display: none;
        }

        .wrapper .content-wrapper {
            min-height: 91vh
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex mb-2 align-items-center personDetails">
                <img class="img-fluid img-circle mr-3" style="width: 100px;height:100px" id="profileImage"
                    src="{{ asset('img/NiImage.jpg') }}">
                <div>
                    <div class="d-flex mb-2">
                        <h1 class="mr-3 name">@lang('dashboard.Teams') - </h1>
                        <span class="mr-3 align-self-center specialty"> UI / UX</span>
                        <div class="feedback mr-3 align-self-center">
                            <i class="fas fa-star star-fill"></i>
                            <i class="fas fa-star star-fill"></i>
                            <i class="far fa-star star-emp"></i>
                            <i class="far fa-star star-emp"></i>
                            <i class="far fa-star star-emp"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="email">ahmed@gmail.com</h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-space-evenly mt-4">
                <div class="col-md-3 col-sm-5">
                    <div class="box box-showDetails text-center p-4">
                        <img class="img-fluid img-circle mr-3" style="width: 50px;height:50px" id="profileImage"
                            src="{{ asset('img/statistic.svg') }}">
                        <p class="mt-2">30 Total Reports</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="box box-showDetails text-center p-4">
                        <img class="img-fluid img-circle mr-3" style="width: 50px;height:50px" id="profileImage"
                            src="{{ asset('img/notRecieved.svg') }}">
                        <p class="mt-2">20 Not Received </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="box box-showDetails text-center p-4">
                        <img class="img-fluid img-circle mr-3" style="width: 50px;height:50px" id="profileImage"
                            src="{{ asset('img/reply.svg') }}">
                        <p class="mt-2">10 Waiting Reply </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="box box-showDetails text-center p-4">
                        <img class="img-fluid img-circle mr-3" style="width: 50px;height:50px" id="profileImage"
                            src="{{ asset('img/responsed.svg') }}">
                        <p class="mt-2">50 Responded </p>
                    </div>
                </div>
            </div>
            <div class="mt-4 d-flex align-items-center">
                <label for="yearSelect" class="mr-3">Select Year:</label>
                <select id="yearSelect" class="form-control w-25"></select>
            </div>
            <canvas id="myChart" width="400" height="200"></canvas>
            <div class="col-md-12 mt-5">
                <div class="container boxActivity personActivity">

                    <h2 class="mb-4">Recent Activities</h2>
                    <div class="activity mt-3 shadowCard">
                        <div class="d-flex justify-content-space-between">
                            <div class="d-flex">
                                <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                <h3>Delay Report From Reda Mohamed</h3>
                            </div>
                            <div class="feedback">
                                <i class="fas fa-star star-fill"></i>
                                <i class="fas fa-star star-fill"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                            </div>
                        </div>
                        <hr style="margin: 0">
                        <span>Yesterday 05 : 30 : 56 PM </span>
                    </div>
                    <div class="activity mt-3 shadowCard">
                        <div class="d-flex justify-content-space-between">
                            <div class="d-flex">
                                <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                <h3>Delay Report From Reda Mohamed</h3>
                            </div>
                            <div class="feedback">
                                <i class="fas fa-star star-fill"></i>
                                <i class="fas fa-star star-fill"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                            </div>
                        </div>
                        <hr style="margin: 0">
                        <span>Yesterday 05 : 30 : 56 PM </span>
                    </div>
                    <div class="activity mt-3 shadowCard">
                        <div class="d-flex justify-content-space-between">
                            <div class="d-flex">
                                <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                <h3>Delay Report From Reda Mohamed</h3>
                            </div>
                            <div class="feedback">
                                <i class="fas fa-star star-fill"></i>
                                <i class="fas fa-star star-fill"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                            </div>
                        </div>
                        <hr style="margin: 0">
                        <span>Yesterday 05 : 30 : 56 PM </span>
                    </div>
                    <div class="activity mt-3 shadowCard">
                        <div class="d-flex justify-content-space-between">
                            <div class="d-flex">
                                <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                <h3>Delay Report From Reda Mohamed</h3>
                            </div>
                            <div class="feedback">
                                <i class="fas fa-star star-fill"></i>
                                <i class="fas fa-star star-fill"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                                <i class="far fa-star star-emp"></i>
                            </div>
                        </div>
                        <hr style="margin: 0">
                        <span>Yesterday 05 : 30 : 56 PM </span>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        // Sample data for different years
        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales Data',
                data: [100, 110, 130, 120, 140, 135],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
            }]
        };

        // Create the chart
        const chart = new Chart(ctx, {
            type: 'line',
            data: data,
        });

        // Populate the year filter dropdown
        const yearSelect = document.getElementById('yearSelect');
        const years = [2021, 2022, 2023]; // List of available years

        years.forEach(year => {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        });

        // Add an event listener to update the chart when the year is changed
        yearSelect.addEventListener('change', (event) => {
            const selectedYear = parseInt(event.target.value);

            // You would need to update the chart data based on the selected year here
            // For this example, we'll just update the chart title
            chart.options.title = {
                display: true,
                text: `Sales Data for ${selectedYear}`
            };
            chart.update();
        });
    </script>
@endsection
