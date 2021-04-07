@extends('layouts.dashboard.app')

@section('content')
<div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.adminreset')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                
                <li class="active">@lang('site.adminreset')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.saveemailadmin') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class=" col-md-12">
                        <div class="form-group col-md-4">
                                <label>@lang('site.email')</label>
                                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email}}">
                            </div>
                           
                            <div class="form-group col-md-4">
                                <label>@lang('site.new_password')</label>
                                <input type="text" name="password" class="form-control" >
                            </div>
                            </div>
                         



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.update')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection