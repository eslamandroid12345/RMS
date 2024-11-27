@extends('dashboard.core.app')
@section('title', __('dashboard.Members'))
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
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.Members')</h3>
                            <div class="card-tools">
                                <a href="{{route('members.create')}}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="#">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input value="{{request('search') ?? ""}}" name="search" type="search" class="form-control" placeholder="#">
                                    </div>
                                    <div class="form-group col-3">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.Filter')</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 50px;">@lang('dashboard.Image')</th>
                                    <th>@lang('dashboard.Name')</th>
                                    <th>@lang('dashboard.Email')</th>
                                    <th>@lang('dashboard.Teams')</th>
                                    <th>@lang('dashboard.Activation')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($members as $member)
                                   @continue($member['id'] == 1 || $member['id'] == auth()->id())
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $member->image ?? '' }}" style="width: 50px;" /></td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>
                                            @forelse($member->teams as $team)
                                                | {{$team->t('name')}}
                                            @empty
                                                @lang('dashboard.none')
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input name="status" data-id="{{$member['id']}}" @checked($member->status == true) type="checkbox" class="custom-control-input statusChanger" id="customSwitch{{$loop->iteration}}">
                                                <label class="custom-control-label" for="customSwitch{{$loop->iteration}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="operations-btns" style="">
{{--                                                <a href="#" class="btn  btn-dark">@lang('dashboard.Show')</a>--}}
                                                <a href="{{route('members.edit',$member->id)}}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$loop->iteration}}">@lang('dashboard.Delete')</button>
                                                <div id="delete-modal{{$loop->iteration}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">تأكيد الحذف</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.sure_delete')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form action="{{route('members.destroy' , $member->id)}}" method="post">
                                                                    @csrf
                                                                    {{method_field('delete')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
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
                            {{ $members->appends(request()->all())->links() }}
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
    <script>
        $('.statusChanger').on('change' , function () {
            $.ajax({
                url: "{{route('members.toggle')}}",
                type: "post",
                data: {
                    id: $(this).data('id'),
                    status : this.checked ? 1 : 0 ,
                    _token: '{!! csrf_token() !!}',
                },
            });
        })
    </script>
@endsection
