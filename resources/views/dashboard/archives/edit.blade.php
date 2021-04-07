@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.archives')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.archives.index') }}"> @lang('site.archives')</a></li>
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

                <form action="{{ route('dashboard.archives.update', $archive->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row ">
                        <div class=" col-md-12">
                     

                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.title')</label>
                                  
                                    <input type="text" name="title" class="form-control" value="{{ $archive->title }}">
                                </div>
                            </div>
                      

                            <div class="form-group col-md-4">
                                <label>@lang('site.Archivepdf')</label>
                                <input class="form-control" type="file" name="pdf" id="pdf" value="{{ $archive->pdf }}">
                                
                            </div>
                            <div class="form-group col-md-2">
                                <label></label>
                                
                                <embed src="{{ asset('uploads/archives/'.$archive->pdf) }}" width="100px" height="100px" />
                                <a  target="_blank" href="{{ asset('uploads/archives/'.$archive->pdf) }}">{{$archive->pdf }}</a>
                            </div>
                        </div>

                        </div>

                      
                        <div class=" col-md-12">
                        
                            <div class=" col-md-12 ">
                                <div class="form-group">
                               
                                    <label>@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ $archive->description }}</textarea>
                                </div>
                                
                            </div>
                       
                        </div>




                    </div>
                   
                      
                

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> @lang('site.save')</button>
                        </div>
                    </div>
                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->



@endsection
