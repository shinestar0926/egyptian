@extends('layouts.dashboard.app')
<style>
    * {
        box-sizing: border-box
    }

    body {
        font-family: "Lato", sans-serif;
    }
    .box-body{
        overflow: auto;
    height: 282px;
    }

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 30%;
        height: 405px;
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 70%;
        border-left: none;
        height: auto;
    }

    .splitstandred {
        display: flex;


    }

    .splitleft {
        flex: 1;
    }

    .splitright {
        flex: 1;
    }

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
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.homepage')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.homepage')</li>
        </ol>
    </section>

    <section class="content">

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">@lang('site.showheader')</button>
            <button class="tablinks" onclick="openCity(event, 'Paris')">@lang('site.slide')</button>
            <button class="tablinks" onclick="openCity(event, 'Tokyo')"> @lang('site.slidervedios')</button>
            <button class="tablinks" onclick="openCity(event, 'importantpostss')"> @lang('site.importantposts')</button>
            <button class="tablinks" onclick="openCity(event, 'selectedcategory')"> @lang('site.selectedcategory')</button>
        </div>
        <!--------------------------------------------------  header @lang('site.showheader')   ---------------->
        <div id="London" class="tabcontent">

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



                                @foreach($categories as $category)


                                <label class="container2">{{ $category->name }}

                                    <input onclick="mainmenu()" {{$category->checked}} type="checkbox" class="messageCheckbox" value="{{ $category->id }}">

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

        </div>


        <!-------------------------------------------------- end    @lang('site.showheader') ---------------->


        <!--------------------------------------------------  header @lang('site.slide')   ---------------->
        <div id="Paris" class="tabcontent">



            <div class="row">


                <div class="col-md-4">
                    <select name="category_id" class="form-control category">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                        <option id="cat_id" value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>



            </div>


            <div class="products" id="products">

            </div>


        </div>

        <!-------------------------------------------------- end    @lang('site.slide') ---------------->

        <!-------------------------------------------------- end    @lang('site.slidervedios') ---------------->
        <div id="Tokyo" class="tabcontent">
            <div class="row">




                <div class="col-md-4">
                    <select name="category_id" class="form-control vedios">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                        <option id="cat_id" value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>



            </div>


            <div class="vedios" id="vedios">

            </div>
        </div>

        <!--------------------------------------------------     @lang('site.importantposts') ---------------->
        <div id="importantpostss" class="tabcontent">
            <div class="row">




                <div class="col-md-4">
                    <select name="important_id" class="form-control important">
                        <option value="">@lang('site.all_categories')</option>
                        @foreach ($categories as $category)
                        <option id="cat_id" value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>



            </div>


            <div class="importantposts" id="importantposts">

            </div>
        </div>
        <!-------------------------------------------------- end    @lang('site.importantposts') ---------------->

        <!--------------------------------------------------     @lang('site.selectedcategory') ---------------->

        <div id="selectedcategory" class="tabcontent">

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



                                @foreach($categories as $category)


                                <label class="container2">{{ $category->name }}

                                    <input onclick="selectedcat()" {{$category->importantchecked}} type="checkbox" class="messageCheckbox2" value="{{ $category->id }}">

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
                                    @foreach($importantposts as $row)
                                    <li style="font-size: 20px;font-weight: bold;">{{$row->category->name}}</li>
                                    @endforeach
                                </ol>
                            </div><!-- end of box body -->


                        </div><!-- end of box -->

                    </section><!-- end of content -->
                </div>



            </div>

        </div>


        <!--------------------------------------------------    end @lang('site.selectedcategory') ---------------->


        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>









    </section><!-- end of content -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
                    if (response == 'error') {


                        swal({
                                title: 'you reach to maximum category in header menu if you want to add new category please remove any other category',
                                text: "",
                                type: "warning",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    } else {
                        location.reload();
                    }

                },
                error: function(response) {
                    if (response == 'error') {

                        swal({
                                title: 'you reach to maximum category in header menu if you want to add new category please remove any other category',
                                text: "",
                                type: "warning",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    } else {
                        location.reload();
                    }
                }


            });

        }


        $(".category").change(function() {
            var id = $(this).val();
            data = {
                id: id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("dashboard/postdate") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#products').html(response);
                },
                error: function(response) {
                    // alert(response);
                }
            });
        });


        $(".vedios").change(function() {
            var id = $(this).val();
            data = {
                id: id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("dashboard/vediosdata") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#vedios').html(response);
                },
                error: function(response) {
                    // alert(response);
                }
            });
        });
        $(".important").change(function() {
            var id = $(this).val();
            data = {
                id: id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("dashboard/importantposts") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    $('#importantposts').html(response);
                },
                error: function(response) {
                    // alert(response);
                }
            });
        });









        function selectedcat() {
            var ids = [];
            var unchecked = [];
            var rowcollection = $(".messageCheckbox2:checked");

            rowcollection.each(function(index, elem) {
                ids.push($(elem).val());
            });


            var rowcollection2 = $(".messageCheckbox2:not(:checked)")
            rowcollection2.each(function(index, elem) {
                unchecked.push($(elem).val());
            });



            data = {
                ids: ids,
                unchecked: unchecked,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: '{{URL::to("dashboard/selectedcat") }}',
                type: 'get',
                dataType: 'html',
                data: data,
                success: function(response) {
                    if (response == 'error') {


                        swal({
                                title: 'you reach to maximum category if you want to add new post please remove any other category',
                                text: "",
                                type: "warning",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    } else {
                        location.reload();
                    }
                },
                error: function(response) {
                    if (response == 'error') {


                        swal({
                                title: 'you reach to maximum category if you want to add new post please remove any other category',
                                text: "",
                                type: "warning",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    } else {
                        location.reload();
                    }
                }


            });

        }
    </script>
</div><!-- end of content wrapper -->


@endsection