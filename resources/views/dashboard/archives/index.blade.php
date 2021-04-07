@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.archives')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.archives')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.archives') <small> {{$archives->total()}} </small></h3>

                    <form action="{{ route('dashboard.archives.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_products'))
                                    <a href="{{ route('dashboard.archives.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($archives->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.Archivepdf')</th>
                              
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($archives as $index=>$archive)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $archive->title }}</td>
                                    <td style="word-break: break-word;">{!! $archive->description !!}</td>
                                    <td>
                                    <embed src="{{ asset('uploads/archives/'.$archive->pdf) }}" width="200px" height="100px" />
                                    <a  target="_blank" href="{{ asset('uploads/archives/'.$archive->pdf) }}">{{$archive->pdf }}</a>
                                    </td>
                                 
                                   

                                    <td>
                                        @if (auth()->user()->hasPermission('update_products'))
                                            <a  href="{{ route('dashboard.archives.edit', $archive->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_products'))
                                            <form  action="{{ route('dashboard.archives.destroy', $archive->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $archives->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->


        <div id="postdetails" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<div class="text-center mt-2 mb-4">
								<a class="text-success"><span>
										<img class="mr-2" src="{{ asset('web_files/images/logo.png') }}"
											 alt="homepage" height="18"/>
										
									</span>
								</a>
							</div>
                            <div class="details" id="details">
								
							</div>

						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>

    </div><!-- end of content wrapper -->



    <script>
        function getpostdetails(id){
           

            data = {
                id: id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("dashboard/getpostdetails") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#details').html(response);
                },
                error: function(response) {
                    // alert(response);
                }
            });


        }


    </script>
@endsection
