@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.comments')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.comments')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.comments') <small>{{ $comments->total() }}</small></h3>

                <form action="{{ route('dashboard.comments.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($comments->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.comment_name')</th>
                            <th>@lang('site.comment_email')</th>
                            <th>@lang('site.post_title')</th>
                            <th>@lang('site.comment')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comments as $index=>$comment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $comment->Client->first_name .' ' . $comment->Client->last_name }}</td>
                            <td>{{ $comment->Client->email }}</td>
                            <td style="word-break: break-word;">{{ $comment->posts->title }}</td>
                            <td style="word-break: break-word;">{{ $comment->comment }}</td>

                            <td>
                                @if (auth()->user()->hasPermission('update_clients'))
                                <a href="{{ route('dashboard.comments.edit', $comment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.approve')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.approve')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_clients'))
                                <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="post" style="display: inline-block">
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

                {{ $comments->appends(request()->query())->links() }}

                @else

                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection