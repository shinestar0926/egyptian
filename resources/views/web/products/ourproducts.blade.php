@extends('layouts.web.app')

@section('content')


<main id="aa" class="has-sidebar">
    <div class="background-title">
        <figure>
            <img tyle="width: 100%;" src="{{ asset('web_files/images/our-products.png') }} " alt="">
        </figure>
        <div class="title">
            <h2>
                @lang('site.OurProducts')
            </h2>
        </div>
    </div>
    <div class="container">

        <div class="has-sidebarcontent">
            <div class="sidebar" style="width: 325px;">
                <h4>
                    @lang('site.Productsearch')
                </h4>
                <div class="row col-md-12" style="padding: 0;">
                    <div class="search col-md-8 ">
                        <form action="{{ route('fakka.products.index') }}" method="get">
                            <input style="  background-color : #F2F8FD; width:325px" type="text" name="search" class="input " placeholder="@lang('site.search')" value="{{ request()->search }}">

                    </div>
                    <div class="search col-md-2 " style="margin-left:auto">
                        <figure class="">
                            <!-- <img src=" {{ asset('web_files/images/search.svg') }}" alt="">-->
                            <button type="submit" class="btn btn-primary"><img width="50px" src=" {{ asset('web_files/images/search.svg') }}" alt=""></button>
                        </figure>
                        </form>
                    </div>
                </div>
                <div class="checkbox">
                    <h4>
                        @lang('site.categories')
                    </h4>
                    <form action="">
                        @if ($categories->count() > 0)
                        @foreach ($categories as $index=>$cat)
                        <label>{{$cat->name}}
                            <input class="cat" name="cat[]" onclick="postdata()" value="{{$cat->id}}" type="checkbox">
                            <span class="checkmark"></span>
                        </label>

                        @endforeach
                        @else

                        <h2>@lang('site.no_data_found')</h2>

                        @endif
                    </form>
                </div>
                <div class="features">
                    <h4>
                        @lang('site.Featuredproducts')
                    </h4>

                    @if ($products->count() > 0)
                    @foreach ($products as $index=>$product)
                    <div class="options">
                        <a class="feature-img" target="_blank" href="{{ route('mediacare.productdetails',$product->id) }}">
                            <figure>
                                <img src=" {{ $product->image_path }}" alt="">
                            </figure>
                        </a>
                        <div class="details">
                            <h5>
                                {{ $product->name }}
                            </h5>
                            <span>
                                {{ $product->number_grams }}(Gram)
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @else

                    <h2>@lang('site.no_data_found')</h2>

                    @endif
                </div>
            </div>
            <div class="products" id="products">
                <div class="grid-container">


                    @if ($products->count() > 0)
                    @foreach ($products as $index=>$product)
                    <div class="grid-item">

                        <a class="products-img " target="_blank" href="{{ route('fakka.productdetails',$product->id) }}">
                            <figure>

                                <img src="{{ $product->image_path }}" alt="">
                            </figure>
                        </a>


                        <div class="details">

                            <div class="gold-name">
                                <h4>
                                    {{ $product->name }}
                                </h4>
                                <span>
                                    {{ $product->number_grams }}(Gram)
                                </span>
                            </div>
                            <button onclick="add_tocart('{{$product->id}}')" class="  light-background ">
                                <figure>
                                    <img src="{{ asset('web_files/images/add-to-cart (arrow).svg') }} " alt="">
                                </figure>
                            </button>
                        </div>

                    </div>
                    @endforeach
                    @else

                    <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <div class="title">
                <h2>
                    @lang('site.contacth')
                </h2>
            </div>
            <p>
                @lang('site.contactp')
            </p>
            <a href="{{ route('fakka.contactus.index') }}">
                @lang('site.Contactus')
            </a>
        </div>
    </div>
</main>



<script>
    function postdata() {

        var id = [];
        var rowcollection = $(".cat:checked");
        rowcollection.each(function(index, elem) {
            id.push($(elem).val());
        });
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: '{{URL::to("/postdate") }}',
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
    }

    function add_tocart(id) {


        var url = '{{URL::to("/home-to-cart")}}' + "/" + id;
        var menu = $('#menu').val();
        data = {
            id: id,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: data,
            success: function(response) {
                let text = "@lang('site.cartalert')";
                swal({

                        title: text,
                        text: "  ",
                        buttons: false,
                        icon: "warning",
                        timer: 1000
                    })
                    .then((willDelete) => {
                        $('body').load(menu)
                    });


            },
            error: function(response) {
                swal(response);
            }
        });
    }
</script>

@endsection

@push('scripts')