@extends('dashboard.core.app')
@section('title', __('dashboard.Reports'))
@section('css_addons')
    <style>
        .card{
            background-color: transparent !important;
            box-shadow: none
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-space-between">
                <h1>@lang('dashboard.Reports')</h1>
                <div class="card-tools">
                    <a href="{{ route('reports.create') }}" class="btn  btn-outline-dark border-circle mr-3">@lang('dashboard.Add Report')
                        <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="pt-4 pl-4 pr-4 d-flex flex-wrap justify-content-space-between">
                            <h3 class="card-title">@lang('dashboard.DailyReports')</h3>
                            <form action="{{ route('reports.index') }}">
                                <div class="row">

                                    <div class="form-group col-2">
                                        <select id="type" name="team_id" class="form-control">
                                            <option value="ALL">@lang('dashboard.All Teams')</option>
                                            @foreach ($teams as $team)
                                                <option @selected(request('team_id') == $team['id']) value="{{ $team['id'] }}">
                                                    {{ $team->t('name') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <select id="status" name="status" class="form-control">
                                            <option value="ALL">@lang('dashboard.All Reports')</option>
                                            <option @selected(request('status') == 'RECEIVED') value="RECEIVED">@lang('dashboard.RECEIVED')</option>
                                            <option @selected(request('status') == 'VIEWED') value="VIEWED">@lang('dashboard.VIEWED')</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <input value="{{ request('from_date') ?? '' }}" name="from_date" type="date"
                                            class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <p class="mt-2">@lang('dashboard.To')</p>
                                    <div class="form-group col-2">
                                        <input value="{{ request('to_date') ?? '' }}" name="to_date" type="date"
                                            class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <div class="form-group col-3">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Filter')</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="over-flow-x-auto">
                                <div class="box box-report d-flex justify-content-space-between flex-wrap mb-3" style="min-width: 900px">
                                    <div class="groupOne d-flex justify-content-space-between flex-wrap align-items-center w-50">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From Reda Mohamed</h3>
                                        <span>UI/UX</span>
                                        <span>Responded</span>
                                    </div>
                                    <div class="groupTwo d-flex flex-wrap align-items-center w-45">
                                        <span>Yesterday  05 : 30 : 56 PM </span>
                                        <button class="btn btn-view ml-4"> View Report </button>
                                    </div>
                                </div>
                            </div>
                            <div class="over-flow-x-auto">
                                <div class="box box-report d-flex justify-content-space-between flex-wrap mb-3" style="min-width: 900px">
                                    <div class="groupOne d-flex justify-content-space-between flex-wrap align-items-center w-50">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From Reda Mohamed</h3>
                                        <span>UI/UX</span>
                                        <span>Responded</span>
                                    </div>
                                    <div class="groupTwo d-flex flex-wrap align-items-center w-45">
                                        <span>Yesterday  05 : 30 : 56 PM </span>
                                        <button class="btn btn-view ml-4"> View Report </button>
                                    </div>
                                </div>
                            </div>
                            <div class="over-flow-x-auto">
                                <div class="box box-report d-flex justify-content-space-between flex-wrap mb-3" style="min-width: 900px">
                                    <div class="groupOne d-flex justify-content-space-between flex-wrap align-items-center w-50">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From Reda Mohamed</h3>
                                        <span>UI/UX</span>
                                        <span>Responded</span>
                                    </div>
                                    <div class="groupTwo d-flex flex-wrap align-items-center w-45">
                                        <span>Yesterday  05 : 30 : 56 PM </span>
                                        <button class="btn btn-view ml-4"> View Report </button>
                                    </div>
                                </div>
                            </div>
                            <div class="over-flow-x-auto">
                                <div class="box box-report d-flex justify-content-space-between flex-wrap mb-3" style="min-width: 900px">
                                    <div class="groupOne d-flex justify-content-space-between flex-wrap align-items-center w-50">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From Reda Mohamed</h3>
                                        <span>UI/UX</span>
                                        <span>Responded</span>
                                    </div>
                                    <div class="groupTwo d-flex flex-wrap align-items-center w-45">
                                        <span>Yesterday  05 : 30 : 56 PM </span>
                                        <button class="btn btn-view ml-4"> View Report </button>
                                    </div>
                                </div>
                            </div>
                            <div class="over-flow-x-auto">
                                <div class="box box-report d-flex justify-content-space-between flex-wrap mb-3" style="min-width: 900px">
                                    <div class="groupOne d-flex justify-content-space-between flex-wrap align-items-center w-50">
                                        <img class="mr-2" src="{{ asset('img/copy.svg') }}" alt="">
                                        <h3>Delay Report From Reda Mohamed</h3>
                                        <span>UI/UX</span>
                                        <span>Responded</span>
                                    </div>
                                    <div class="groupTwo d-flex flex-wrap align-items-center w-45">
                                        <span>Yesterday  05 : 30 : 56 PM </span>
                                        <button class="btn btn-view ml-4"> View Report </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
