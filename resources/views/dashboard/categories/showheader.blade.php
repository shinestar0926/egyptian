@extends('layouts.dashboard.app')

@section('content')
<style>
    .splitstandred {
        display: flex;
        align-items: center;

    }

    .splitleft {
        flex: 1;
    }

    .splitright {
        flex: 1;
    }
</style>
<style>
    /* The container */
    .container2 {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 20px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        max-width: 50%;
    }

    /* Hide the browser's default checkbox */
    .container2 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0px;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container2:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container2 input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container2 input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container2 .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.showheader')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.allcategories')</li>
        </ol>
    </section>

    <div class="splitstandred">
        <div class="splitleft">
            <section class="content">

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title" style="margin-bottom: 15px">@lang('site.allcategories') <small>{{-- $categories->total() --}}</small></h3>

                        <form action="{{-- route('dashboard.standre4.index') --}}" method="get">

                            <div class="row">




                            </div>
                        </form><!-- end of form -->

                    </div><!-- end of box header checked="checked" -->

                    <div class="box-body">


                        <h4>@lang('site.allcategories')</h4>
                        @foreach($categories as $category)
                 
                     
                       <label class="container2">{{ $category->name }}
                          
                          <input  onclick="mainmenu()" {{$category->checked}}    type="checkbox" class="messageCheckbox" value="{{ $category->id }}">
              
                          <span class="checkmark"></span>
                     
                      </label>
                        
                        @endforeach


                    </div><!-- end of box body -->


                </div><!-- end of box -->

            </section><!-- end of content -->
        </div>
        <div class="splitright">
            <section class="content">

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title" style="margin-bottom: 15px">@lang('site.showheader') <small>{{-- count($woodcolors) --}}</small></h3>

                        <form action="{{-- route('dashboard.standre4.index') --}}" method="get">

                            <div class="row">



                            </div>
                        </form><!-- end of form -->

                    </div><!-- end of box header -->

                    <div class="box-body">

                    <ol>
                        @foreach($allmunes as $row)
                        <li style="font-size: 20px;font-weight: bold;">{{$row->category->name}}</li>
                        @endforeach
                    </ol> 



                    </div><!-- end of box body -->


                </div><!-- end of box -->

            </section><!-- end of content -->
        </div>



    </div>





</div><!-- end of content wrapper -->


<script>
    function mainmenu() {
        var ids = [];
        var unchecked = [];
        var rowcollection = $(".messageCheckbox:checked");
     
        rowcollection.each(function(index, elem) {
            ids.push($(elem).val());
        });


        var rowcollection2 = $(".messageCheckbox:not(:checked)")
        rowcollection2.each(function(index, elem) {
            unchecked.push($(elem).val());
        });

        

        data = {
            ids: ids,
            unchecked: unchecked,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: '{{URL::to("dashboard/mainmenu") }}',
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function(response) {
                location.reload();
            }
           

        });

    }
</script>

@endsection