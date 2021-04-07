@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.posts')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.posts')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.posts') <small>{{ $products->total() }}</small></h3>

                    <form action="{{ route('dashboard.products.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_products'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($products->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.details')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($products as $index=>$product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td style="word-break: break-word;">{!! $product->description !!}</td>
                                    <!--<td>{{--<img src="{{ asset('uploads/product_images/'.$product->image) }}" style="width: 100px"  class="img-thumbnail" alt="">--}}</td>-->
                                    <td >
                                    <button type="button" class="btn btn-primary "
														onclick="getpostdetails({{ $product->id }})"
														data-toggle="modal" data-target="#postdetails"> @lang('site.details')
												</button>

                          

                                    </td>
                                   

                                    <td style="margin-left: 20px;">
                                        @if (auth()->user()->hasPermission('update_products'))
                                            <a  href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_products'))
                                            <form  action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button style="margin-top: 10px;" type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $products->appends(request()->query())->links() }}

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
