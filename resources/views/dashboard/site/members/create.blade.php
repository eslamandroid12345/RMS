@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . " " . __('dashboard.Member'))


@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Members')</h1>
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
                        <form action="{{ route('members.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                        <input required name="name" type="text" class="form-control" id="exampleInputName1" value="{{ old('name') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Email')</label>
                                        <input required name="email" type="email" class="form-control" id="exampleInputName1" value="{{ old('email') }}" placeholder="">
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Password')</label>
                                        <input required name="password" type="password" class="form-control" id="exampleInputName1" value="" placeholder="Enter Your Password">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Confirm Password')</label>
                                        <input required name="password_confirmation" type="password" class="form-control" id="exampleInputName1" value="" placeholder="Enter Your Password">
                                    </div>



                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Phone Number')</label>
                                        <input required name="phone_number" type="text" class="form-control" id="exampleInputName1" value="{{ old('phone_number') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Activation')</label>
                                        <select required name="status" id="exampleInputName1" class="form-control">
                                            <option value="1">@lang('dashboard.Active')</option>
                                            <option value="0">@lang('dashboard.inActive')</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="select">@lang('dashboard.Teams')</label>
                                        <select id="select" name="teams[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            @foreach($teams as $team)
                                                <option @if( old('teams') !== null && in_array($team['id'] , old('teams'))) selected  @endif value="{{$team['id']}}" >{{$team->t('name')}}</option>
                                            @endforeach
                                        </select>
                                    </div>




                                    <div class="custom-file col-12">
                                        <input name="image" type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">@lang('dashboard.Image')</label>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <img id="previewImage" src="#" alt="Uploaded Image" style="display: none; max-width: 200px; height: auto;">
                                    </div>



                                </div>






                                </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
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

@section('js_addons')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#customFile').change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                        $('#previewImage').css('display', 'block');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>

@endsection
