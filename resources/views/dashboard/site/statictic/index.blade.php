@extends('dashboard.core.app')
@section('title', __('dashboard.Teams'))
@section('css_addons')
    <style>
        .card {
            background-color: transparent !important;
            box-shadow: none
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="d-flex justify-content-space-between">
            <h2>Statistic</h2>
            <div class="form-group col-2 mb-0">
                <select id="type" name="team_id" class="form-control">
                    <option value="ALL">@lang('dashboard.All Teams')</option>
                    <option value="c">UI</option>
                    <option value="c">UI</option>
                    <option value="c">UI</option>
                    <option value="c">UI</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <canvas id="myChart"></canvas>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

    <script>
        // HTML canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Data for the chart
        var data = {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                    label: 'Bar Dataset',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar chart color
                    borderColor: 'rgba(75, 192, 192, 1)', // Bar chart border color
                    borderWidth: 1, // Bar chart border width
                    type: 'bar', // Specify the chart type for this dataset (bar)
                },
                {
                    label: 'Line Dataset',
                    data: [10, 14, 12, 8, 6],
                    borderColor: 'rgba(255, 99, 132, 1)', // Line chart color
                    borderWidth: 2, // Line chart border width
                    fill: false, // Do not fill the area under the line
                    type: 'line', // Specify the chart type for this dataset (line)
                },
            ],
        };

        // Configuration options
        var options = {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        };

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar', // This is the default type, but you can change it if needed
            data: data,
            options: options,
        });
    </script>
@endsection
