@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.Team'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Teams')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('teams.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="name_ar" type="text" class="form-control" id="exampleInputName1"
                                            value="{{ old('name_ar') }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="name_en" type="text" class="form-control" id="exampleInputName1"
                                            value="{{ old('name_en') }}" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.email')</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.department')</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">UI/UX</option>
                                            <option value="">UI/UX</option>
                                            <option value="">UI/UX</option>
                                            <option value="">UI/UX</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.password')</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.password Confirmation')</label>
                                        <input name="password" type="password" class="form-control" id="exampleInputName1" placeholder="">
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-view">@lang('dashboard.Create')</button>
                            </div>
                        </form>
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
