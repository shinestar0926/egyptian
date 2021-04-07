@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.advertisement')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.advertisement.index') }}"> @lang('site.advertisement')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.advertisement.update', $advertise->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row ">
                        <div class=" col-md-12">


                            <div class="form-group col-md-6">
                                <label>@lang('site.image')</label>
                                <input type="file" name="image" class="form-control image" value="{{$advertise->id}}">
                                <img src="{{ asset('uploads/advertise_images/'.$advertise->image) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>

                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.title')</label>

                                    <input type="text" name="title" class="form-control" value="{{ $advertise->title }}">
                                </div>
                            </div>


                        </div>


                        <div class=" col-md-12">

                            <div class=" col-md-12 ">
                                <div class="form-group">

                                    <label>@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ $advertise->description }}</textarea>
                                </div>

                            </div>

                        </div>





                    </div>




                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                    </div>
            </div>
            </form><!-- end of form -->

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection