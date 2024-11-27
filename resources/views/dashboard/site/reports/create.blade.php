@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . " " . __('dashboard.Reports'))

@section('css_addons')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" integrity="sha512-m52YCZLrqQpQ+k+84rmWjrrkXAUrpl3HK0IO4/naRwp58pyr7rf5PO1DbI2/aFYwyeIH/8teS9HbLxVyGqDv/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <style>
        .card{
            background-color: transparent !important;
            box-shadow: none
        }
        </style>

@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.NewReports')</h1>
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
                        <form action="{{ route('reports.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="summernote">@lang('dashboard.report')</label>
                                        <textarea name="report_text" type="text" class="form-control textareaReport" placeholder="">
                                            {{old('report_text')}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group col-8">
                                    <span class="titleCreate">How Do You Rate This Report ?</span>
                                    <fieldset class="rating">
                                        <input id="rate-5" type="radio" name="rating" value="5">
                                        <label for="rate-5">
                                            <svg viewBox="0 -4 80 80">
                                                <path d="M 40.000 60.000 L 63.511 72.361 L 59.021 46.180 L 78.042 27.639 L 51.756 23.820 L 40.000 0.000 L 28.244 23.820 L 1.958 27.639 L 20.979 46.180 L 16.489 72.361 L 40.000 60.000"></path>
                                            </svg>
                                        </label>
                                        <input id="rate-4" type="radio" name="rating" value="4">
                                        <label for="rate-4">
                                            <svg viewBox="0 -4 80 80">
                                                <path d="M 40.000 60.000 L 63.511 72.361 L 59.021 46.180 L 78.042 27.639 L 51.756 23.820 L 40.000 0.000 L 28.244 23.820 L 1.958 27.639 L 20.979 46.180 L 16.489 72.361 L 40.000 60.000"></path>
                                            </svg>
                                        </label>
                                        <input id="rate-3" type="radio" name="rating" value="3">
                                        <label for="rate-3">
                                            <svg viewBox="0 -4 80 80">
                                                <path d="M 40.000 60.000 L 63.511 72.361 L 59.021 46.180 L 78.042 27.639 L 51.756 23.820 L 40.000 0.000 L 28.244 23.820 L 1.958 27.639 L 20.979 46.180 L 16.489 72.361 L 40.000 60.000"></path>
                                            </svg>
                                        </label>
                                        <input id="rate-2" type="radio" name="rating" value="2">
                                        <label for="rate-2">
                                            <svg viewBox="0 -4 80 80">
                                                <path d="M 40.000 60.000 L 63.511 72.361 L 59.021 46.180 L 78.042 27.639 L 51.756 23.820 L 40.000 0.000 L 28.244 23.820 L 1.958 27.639 L 20.979 46.180 L 16.489 72.361 L 40.000 60.000"></path>
                                            </svg>
                                        </label>
                                        <input id="rate-1" type="radio" name="rating" value="1">
                                        <label for="rate-1">
                                            <svg viewBox="0 -4 80 80">
                                                <path d="M 40.000 60.000 L 63.511 72.361 L 59.021 46.180 L 78.042 27.639 L 51.756 23.820 L 40.000 0.000 L 28.244 23.820 L 1.958 27.639 L 20.979 46.180 L 16.489 72.361 L 40.000 60.000"></path>
                                            </svg>
                                        </label>
                                    </fieldset>
                                </div>
                                {{-- <div class="form-group col-6">
                                    <label for="exampleInputName1">@lang('dashboard.Reciver')</label>
                                    <select required name="reciver_id" id="exampleInputName1" class="form-control">
                                        @foreach(\App\Models\User::whereHasRole('admin')->get() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-12">
                                    <span class="titleCreate mb-3">
                                        Add Review About This Report
                                    </span>
                                    <textarea name="report_text" type="text" class="form-control" id="summernote" placeholder="">
                                        {{old('report_text')}}
                                    </textarea>

                                </div>
                                <button type="submit" class="btn btn-view mt-4">@lang('dashboard.Send Report')</button>
                                </div>
                            <!-- /.card-body -->
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

@section('js_addons')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js" integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
        $(function () {
            $('#summernote').summernote();
        });
    </script>
@endsection
