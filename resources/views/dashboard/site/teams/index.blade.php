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
        <div class="container-fluid">
            <div class="d-flex mb-2 justify-content-space-between">
                <h1>@lang('dashboard.Teams')</h1>
                <div class="form-group col-2 mb-0">
                    <select id="type" name="team_id" class="form-control">
                        <option value="ALL">@lang('dashboard.All Teams')</option>
                        @foreach ($teams as $team)
                            <option @selected(request('team_id') == $team['id']) value="{{ $team['id'] }}">
                                {{ $team->t('name') }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-2 mb-0">
                    <select id="type" name="team_id" class="form-control">
                        <option value="ALL">@lang('dashboard.All Teams')</option>
                        @foreach ($teams as $team)
                            <option @selected(request('team_id') == $team['id']) value="{{ $team['id'] }}">
                                {{ $team->t('name') }}</option>
                        @endforeach
                    </select>
                </div>

                <a href="{{ route('teams.create') }}" class="btn  btn-dark">@lang('dashboard.Create')</a>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.Name')</th>
                                        <th>@lang('dashboard.email')</th>
                                        <th>@lang('dashboard.activation')</th>
                                        <th>@lang('dashboard.Operations')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($teams as $team)
                                        <tr>
                                            <td>

                                                {{ $loop->iteration }}

                                            </td>
                                            <td>

                                                {{ $team->t('name') }}</td>
                                            <td>ahmed@gmail.com</td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="operations-btns" style="">
                                                    <a href="{{ route('teams.edit', ['team' => $team->id]) }}"
                                                        class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                    <button class="btn btn-dark waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{ $loop->iteration }}" class="modal fade modal2 "
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                        aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">تأكيد الحذف</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                        @lang('dashboard.close')
                                                                    </button>
                                                                    <form action="{{ route('teams.destroy', $team->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{ method_field('delete') }}
                                                                        <button type="submit"
                                                                            class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $teams->appends(request()->all())->links() }}
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
