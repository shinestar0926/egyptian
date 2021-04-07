@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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

                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="row ">
                        <div class=" col-md-12">
                            <div class="form-group col-md-6">
                                <label>@lang('site.categories')</label>
                                <select disabled readonly id="category_id" onchange="appear()" name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                    <option readonly value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <input type="hidden" value="{{$product->category_id}}" name="category_id">
                            </div>


                            <div class=" col-md-6 ">
                                <div class="form-group">
                                    <label>@lang('site.title')</label>

                                    <input type="text" name="title" class="form-control" value="{{ $product->title }}">
                                </div>
                            </div>


                        </div>


                        <div class=" col-md-12">

                            <div class=" col-md-12 ">
                                <div class="form-group">

                                    <label>@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ $product->description }}</textarea>
                                </div>

                            </div>

                        </div>

                        <div class=" col-md-4">

                            <div class="form-check">
                                <input class="form-check-input" onclick="imagesappear()" id="images" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    add more image
                                </label>
                            </div>

                        </div>
                        <div class=" col-md-12" id="imagesa" style="display: none;">
                            <div class=" col-md-12">
                                <div class="input-group-append">
                                    <button class="btn btn-rounded btn-primary btn-sm" type="button" onclick="add_row();" style="margin: 0px 7px 5px 2px;"><i class="fa fa-plus"></i>
                                    </button>
                                    <button class="btn btn-rounded btn-primary btn-sm " type="button" onclick="remove_row();" style="margin: 0px 7px 5px 2px;"><i class="fa fa-minus"></i>
                                    </button>

                                </div>

                            </div>

                            <div class=" col-md-12" id="bouquet_div">
                                <div class="form-group col-md-12">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image2[]" class="form-control image">


                                </div>


                            </div>

                        </div>
                        @if(!empty($images))
                        @foreach($images as $image)
                        <div class=" col-md-12" id="">

                            <input type="hidden" name="image_id[]" value="{{$image->id}}" class="form-control image{{$image->id}}">
                            <div class=" col-md-12" id="bouquet_disv">
                                <div class="form-group col-md-12">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image[]" value="" class="form-control image{{$image->id}}">

                                    <img src="{{ asset('uploads/product_images/'.$image->image) }}" style="width: 100px" class="img-thumbnail image{{$image->id}}-preview" alt="">

                                    <!--    <input type="file" multiple name="image[]" accept="image/*" class="form-control image">-->
                                </div>


                            </div>

                        </div>
                        @endforeach













                        @endif










                    
                        <div class=" col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" onclick="viedioappear()" id="videos" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                add more vedios
                                </label>
                            </div>
                        </div>


                        <div class=" col-md-12" id="videoa" style="display:none">
                            <div class=" col-md-12">
                                <div class="input-group-append">
                                    <button class="btn btn-rounded btn-primary btn-sm" type="button" onclick="add_row22();" style="margin: 0px 7px 5px 2px;"><i class="fa fa-plus"></i>
                                    </button>
                                    <button class="btn btn-rounded btn-primary btn-sm" type="button" onclick="remove_row22();" style="margin: 0px 7px 5px 2px;"><i class="fa fa-minus"></i>
                                    </button>

                                </div>

                            </div>

                            <div class=" col-md-12" id="bouquet_div22">
                                <div class="form-group col-md-12">
                                    <label>@lang('site.vedios')</label>
                                    <input type="text" name="vedios2[]" class="form-control image">
                                </div>


                            </div>

                        </div>



                        
                        <!-- end product images--->
                        <!-- start slider vedios-->

                        @if(!empty($vedios)  )

                      
                        @foreach($vedios as $vedio)
                        <div class=" col-md-12" id="videoa">


                            <div class=" col-md-12" id="bouquet_div2">
                                <div class="form-group col-md-12">
                                    <label>@lang('site.vedios')</label>
                                    <input type="text" name="vedios[]" value="{{$vedio->vedios}}" class="form-control image">
                                    <input type="hidden" name="vedio_id[]" value="{{$vedio->id}}" class="form-control image">
                                </div>


                            </div>

                        </div>
                        @endforeach
                      

                        @endif

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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    function add_row() {

        var frist_input = document.getElementById("bouquet_div").firstElementChild.outerHTML;



        $('#bouquet_div').append(frist_input);

    }

    function remove_row() {
        var last_input = document.getElementById("bouquet_div").lastChild;

        var len = $('#bouquet_div input').length;
        console.log('len :: ' + len);
        if (len >= 2) {
            document.getElementById("bouquet_div").removeChild(last_input);

        }

    }

    function add_row2() {

        var frist_input = document.getElementById("bouquet_div2").firstElementChild.outerHTML;



        $('#bouquet_div2').append(frist_input);

    }

    function remove_row2() {
        var last_input = document.getElementById("bouquet_div2").lastChild;

        var len = $('#bouquet_div2 input').length;
        console.log('len :: ' + len);
        if (len >= 2) {
            document.getElementById("bouquet_div2").removeChild(last_input);

        }

    }


    function add_row22() {

        var frist_input = document.getElementById("bouquet_div22").firstElementChild.outerHTML;



        $('#bouquet_div22').append(frist_input);

    }

    function remove_row22() {
        var last_input = document.getElementById("bouquet_div22").lastChild;

        var len = $('#bouquet_div22 input').length;
        console.log('len :: ' + len);
        if (len >= 2) {
            document.getElementById("bouquet_div22").removeChild(last_input);

        }

    }




    function imagesappear() {
        $('#images').val(1);
        $('#videos').val(0);
        $('#imagesa').show();
        // $('#videoa').hide();
        $('#slideimage').hide();

    }

    function viedioappear() {
        $('#videos').val(1);
        $('#images').val(0);
        $('#videoa').show();
        //$('#imagesa').hide();
        $('#slideimage').hide();
    }

    function slideshows() {
        var rowcollection = $(".slideshow:checked");
        if (rowcollection) {
            $('#slideshow').val(1);
        }


    }
</script>
@endsection