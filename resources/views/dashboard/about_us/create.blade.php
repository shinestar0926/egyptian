@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.aboutus')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.aboutus.index') }}"> @lang('site.aboutus')</a></li>
            <li class="active">@lang('site.aboutus')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.aboutus')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.aboutus.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class=" col-md-12">
                        <div class="form-group col-md-4">
                            <label>@lang('site.aboutus')</label>

                            <textarea name="about_us" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('about_us') }}</textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label>@lang('site.about_us_image')</label>
                            <input type="file" name="about_us_image" class="form-control about_us_image">
                        </div>


                    </div>
                    <div class=" col-md-12">
                    <h1>our team information</h1>
                    </div>
                    <!-- start our team -->
                    <div class=" col-md-12">
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') </label>

                            <textarea name="our_team" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('our_team') }}</textarea>
                        </div>
                        


                    </div>
                    <div class=" col-md-12 " >
                        
                    <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image1</label>
                            <input type="file" name="our_team_image1" class="form-control our_team_image1">
                        </div>

                    </div>
                    <div class=" col-md-12">
                        
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image2</label>
                            <input type="file" name="our_team_image2" class="form-control our_team_image2">
                        </div>

                    </div>
                    <div class=" col-md-12">
                        
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image3</label>
                            <input type="file" name="our_team_image3" class="form-control image">
                        </div>


                    </div>

                    <div class=" col-md-12">
                      
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image4</label>
                            <input type="file" name="our_team_image4" class="form-control image">
                        </div>
                    </div>

                    <!-- end our team -->

                    <h1>our partaner information</h1>
                      <!-- start our partaner  -->
                      <div class=" col-md-12">
                       
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image1</label>
                            <input type="file" name="partners1" class="form-control ">
                        </div>


                    </div>

                    <div class=" col-md-12">
                       
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image2</label>
                            <input type="file" name="partners2" class="form-control ">
                        </div>


                    </div>
                    <div class=" col-md-12">
                        
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image3</label>
                            <input type="file" name="partners3" class="form-control image">
                        </div>


                    </div>

                    <div class=" col-md-12">
                        
                        <div class="form-group col-md-4">
                            <label>@lang('site.our_team') image4</label>
                            <input type="file" name="partners4" class="form-control image">
                        </div>
                    </div>

                    <!-- end our team -->


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection