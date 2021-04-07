@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.contact_us')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.contact_us')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.contact_us') <small>{{ $clients->total() }}</small></h3>

                    <form action="{{ route('dashboard.contacts.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                             <!--   @if (auth()->user()->hasPermission('create_clients'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif-->
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.message')</th>
                                <th>@lang('site.send_email')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td style="word-break: break-word;">{{ $client->message }}</td>
                                    <td>
												<button type="button" class="btn btn-primary "
														onclick="$('#username').val('<?= $client->name ?>');$('#emailaddress').val('<?= $client->email ?>');"
														data-toggle="modal" data-target="#send_email-modal"> Send Email
												</button>
											</td>
                                    <td>
                                   
                                        @if (auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{ route('dashboard.contacts.destroy', $client->id) }}" method="post" style="display: inline-block">
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

                        {{ $clients->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
	<div id="send_email-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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

							<form class="pl-3 pr-3" action=""
								  id="send_email_form">

								<div class="form-group">
									<label for="username">Name</label>
									<input class="form-control" type="text" id="username" name="username"
										   placeholder="user name" readonly data-validation="required">
								</div>
								<div class="form-group">
									<label for="emailaddress">Email address</label>
									<input class="form-control" type="email" id="emailaddress" name="emailaddress"
										   readonly placeholder="john@deo.com" data-validation="required">
								</div>
								<div class="form-group">
									<label for="emailsubject">Email subject</label>
									<input class="form-control" type="text" id="emailsubject" name="emailsubject"
										   placeholder="emailsubject" data-validation="required">
								</div>
								<div class="form-group">
									<label for="editor1">Email content</label>
									<textarea class="textarea form-control" id="editor1" name="email_content"
											  placeholder="Place some text here"></textarea>
								</div>
								<div class="form-group text-center">
									<button type="button" class="btn btn-info  " data-toggle="tooltip"
											data-placement="top" title data-original-title="Send Email"
											onclick="send_email()">
										 Send Email
									</button>
								</div>

							</form>

						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
            <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    CKEDITOR.replace('editor1');
</script>

<script>
function send_email() {
    var email = $('#emailaddress').val();
    var subject = $('#emailsubject').val();
    var content = CKEDITOR.instances['editor1'].getData();
    var send_email = document.getElementById("send_email-modal");
  
         data = {
            email: email,
            subject: subject,
            content: content,
          _token: "{{csrf_token()}}",
        };
       $.ajax({
          url: '{{URL::to("/send/mail") }}',
          type: 'get',
          dataType: 'html',
          data: data,
          success: function (response) {
           
       
            $("#send_email-modal").modal('hide');
            
            swal({
            title: "SEND!",
            text: response,
            icon: "success",
            });

          },
            error: function (response) {
             
                swal({
            title: "SEND!",
            text: response,
            icon: "error",
            });

            }
          });
      }
     </script>
@endsection
