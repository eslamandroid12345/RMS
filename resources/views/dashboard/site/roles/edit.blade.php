@extends('dashboard.core.app')
@section('title', __('dashboard.Reports'))
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
                    <h1>@lang('dashboard.Roles_Permissions')</h1>
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

                        <form action="{{ route('roles.update',$role->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">

                        @csrf @method('PUT')
                        <div class="card-body">


                            <div class="row mt-3">
                                <h4>{{$role->name}} @lang('dashboard.Permissions')</h4>

                                <div class="form-group col-12">
                                    <label for="select1">@lang('dashboard.Teams')</label>
                                    <select id="select1" name="permissions[]" class="select2 select2-hidden-accessible" multiple=""  data-placeholder="Select a State" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                                        <option @if($permissions !== null && in_array('teams-read' , $permissions)) selected  @endif value="teams-read">@lang('dashboard.Read')</option>
                                        <option @if($permissions !== null && in_array('teams-create' , $permissions)) selected  @endif value="teams-create">@lang('dashboard.Create')</option>
                                        <option @if($permissions !== null && in_array('teams-update' , $permissions)) selected  @endif value="teams-update">@lang('dashboard.Edit')</option>
                                        <option @if($permissions !== null && in_array('teams-delete' , $permissions)) selected  @endif value="teams-delete">@lang('dashboard.Delete')</option>
                                    </select>
                                </div>


                                <div class="form-group col-12">
                                    <label for="select2">@lang('dashboard.Members')</label>
                                    <select id="select2" name="permissions[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                        <option @if($permissions !== null && in_array('members-read' , $permissions)) selected  @endif value="members-read">@lang('dashboard.Read')</option>
                                        <option @if($permissions !== null && in_array('members-create' , $permissions)) selected  @endif value="members-create">@lang('dashboard.Create')</option>
                                        <option @if($permissions !== null && in_array('members-update' , $permissions)) selected  @endif value="members-update">@lang('dashboard.Edit')</option>
                                        <option @if($permissions !== null && in_array('members-delete' , $permissions)) selected  @endif value="members-delete">@lang('dashboard.Delete')</option>
                                    </select>
                                </div>


                                <div class="form-group col-12">
                                    <label for="select34">@lang('dashboard.Reports')</label>
                                    <select id="select34" name="permissions[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                        <option @if($permissions !== null && in_array('reports-read' , $permissions)) selected  @endif value="reports-read">@lang('dashboard.Read')</option>
                                        <option @if($permissions !== null && in_array('reports-create' , $permissions)) selected  @endif  value="reports-create">@lang('dashboard.Create')</option>
                                        <option @if($permissions !== null && in_array('reports-update' , $permissions)) selected  @endif value="reports-update">@lang('dashboard.Edit')</option>
                                        <option @if($permissions !== null && in_array('reports-delete' , $permissions)) selected  @endif value="reports-delete">@lang('dashboard.Delete')</option>
                                    </select>
                                </div>


                                <div class="form-group col-12">
                                    <label for="select4">@lang('dashboard.Reviews')</label>
                                    <select id="select4" name="permissions[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="5" tabindex="-1" aria-hidden="true">
                                        <option @if($permissions !== null && in_array('reviews-read' , $permissions)) selected  @endif value="reviews-read">@lang('dashboard.Read')</option>
                                        <option @if($permissions !== null && in_array('reviews-create' , $permissions)) selected  @endif value="reviews-create">@lang('dashboard.Create')</option>
                                        <option @if($permissions !== null && in_array('reviews-update' , $permissions)) selected  @endif value="reviews-update">@lang('dashboard.Edit')</option>
                                        <option @if($permissions !== null && in_array('reviews-delete' , $permissions)) selected  @endif value="reviews-delete">@lang('dashboard.Delete')</option>
                                    </select>
                                </div>



                                <div class="form-group col-12">
                                    <label for="select5">@lang('dashboard.Statistics')</label>
                                    <select id="select5" name="permissions[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="6" tabindex="-1" aria-hidden="true">
                                        <option @if($permissions !== null && in_array('statistics-read' , $permissions)) selected  @endif value="statistics-read">@lang('dashboard.Read')</option>
                                        <option @if($permissions !== null && in_array('statistics-create' , $permissions)) selected  @endif value="statistics-create">@lang('dashboard.Create')</option>
                                        <option @if($permissions !== null && in_array('statistics-update' , $permissions)) selected  @endif value="statistics-update">@lang('dashboard.Edit')</option>
                                        <option @if($permissions !== null && in_array('statistics-delete' , $permissions)) selected  @endif value="statistics-delete">@lang('dashboard.Delete')</option>
                                    </select>
                                </div>



                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-dark">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                        <div class="card-footer">
{{--                            {{ $reports->appends(request()->all())->links() }}--}}
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

    @endsection

