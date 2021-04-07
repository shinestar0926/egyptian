@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.archives')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.archives.index') }}"> @lang('site.archives')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.archives.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="row ">
                    <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.title')</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('site.Archivepdf')</label>
                                <input class="form-control" type="file" name="pdf" id="pdf">
                            </div>
                        </div>


                        <div class=" col-md-12">
                            <div class=" col-md-12">
                                <div class="form-group ">
                                    <label>@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                   







                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary add"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
            </div>
            </form><!-- end of form -->

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>



</script>
@endsection