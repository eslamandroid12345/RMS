@extends('dashboard.core.app')
@section('title', __('dashboard.Report Details') )

@section('css_addons')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Reports')</h1>
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
                        <div>
                            <div class="timeline-item p-4">
                                <h3 class="timeline-header">{{$report->user->name}}</h3>
                                <div class="timeline-body">
                                    {!! $report->report_text !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->hasPermission('reports-update'))

                    <div class="card p-3">
                        <form method="POST" action="{{route('review.store')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="report_id" value="{{$report['id']}}">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    How Do You Rate This Report ?
                                </div>
                                <div class="col-2 stars">
                                    <select required class="form-control text-center" name="rating">
                                        <option @selected(old('rating') == 1 ) value="1">1</option>
                                        <option @selected(old('rating') == 2 ) value="2">2</option>
                                        <option @selected(old('rating') == 3 ) value="3">3</option>
                                        <option @selected(old('rating') == 4 ) value="4">4</option>
                                        <option @selected(old('rating') == 5 ) value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="summernote">@lang('dashboard.Review')</label>
                                    <textarea required name="review_text" type="text" class="form-control" id="summernote" placeholder="">
                                            {{old('review_text')}}
                                        </textarea>
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-dark" type="submit">@lang('dashboard.Add Review')</button>

                                </div>
                            </div>
                        </div>

                        </form>
                    </div>

                    @endif

                    <div class="col-12 ">
                        <h4>Reviews</h4>

                        @forelse($report->reviews as $review)
                            <div class="card p-3 ml-4">

                                <div>
                                    <div class="timeline-item p-4">
                                        <h3 class="timeline-header">{{$review->author->name}} </h3>
                                        <span>{{$review->rating}} <i class="fa fa-star"></i></span>
                                        <div class="timeline-body">
                                            {!! $review->review_text !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @lang('dashboard.No Reviews')
                        @endforelse
                <div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
        });
    </script>
@endsection
