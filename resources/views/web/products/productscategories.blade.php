@extends('layouts.web.app')

@section('content')



<main>
    <div class="block">
        <div class="container">
            <div class="news">
                <div class="page-heading">
                    <a href="{{ route('mediacare.index') }}">
                        الرئيسية
                    </a>
                    <i class="fa fa-chevron-left"></i>
                    <span>
                        {{$cate->CategoryTranslation[0]->name}} </span>
                </div>
                <div class="has-sides">
                    <div class="right-side col-md-8">
                        <div class="slider">
                            @foreach($slideshows as $slider)

                            <div class="slick-side">
                                <div class="bg">
                                    <figure>

                                        <img src="{{ asset('uploads/product_images/'.$slider->posts->default_image) }} " class="img-fluid" alt="Responsive image">
                                    </figure>
                                </div>
                                <div class="slide-content">
                                    <div class="title">
                                        <h2>
                                            {{$slider->posts->title}}


                                        </h2>
                                    </div>
                                    <p>
                                        <span>

                                            {{$slider->posts->category->CategoryTranslation[0]->name}}

                                            <?php $timestamp = strtotime($slider->created_at); ?>
                                        </span>{{date("d-m-Y", $timestamp) }}
                                    </p>

                                </div>
                            </div>

                            @endforeach
                        </div>
                        <div class="grid-container">

                            @foreach($latestposts as $latestpost)

                            <div class="grid-item">
                                <a target="_blank" href="{{ route('mediacare.details',$latestpost->id) }}">
                                    <div class="img-section">
                                        @if($latestpost->default_image !=null)
                                        <figure>
                                            <img style="width:454px;height:281px" src="{{ asset('uploads/product_images/'.$latestpost->default_image) }}  " class="img-fluid" alt="Responsive image">
                                        </figure>
                                        @else
                                        <figure>
                                            <iframe width="200" height="200" src='https://www.youtube.com/embed/{{ $latestpost->default_vedios }}' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </figure>
                                        @endif
                                        <span class="orange-box">
                                            {{$latestpost->category->CategoryTranslation[0]->name}}
                                        </span>
                                    </div>
                                    <div class="grid-content">
                                        <div class="grid-heading">
                                            <p>
                                                <?php $timestamp = strtotime($latestpost->created_at); ?> {{date("d-m-Y", $timestamp) }}
                                            </p>
                                        </div>
                                        <p>
                                            {{$latestpost->title}}
                                        </p>
                                    </div>
                                </a>
                            </div>

                            @endforeach

                        </div>
                    </div>
                    <div class="left-side col-md-4">
                        @if(!empty($Advertises))
                        <div class="advertise">
                            <figure>
                                <img style="width: 435px;height: 882px;" src="{{ asset('uploads/advertise_images/'.$Advertises->image) }} " class="img-fluid" alt="Responsive image">
                            </figure>
                            <div class="advertise-content">

                                <h3>
                                    {{$Advertises->title}}
                                </h3>
                                <span>
                                    {!!$Advertises->description !!}
                                </span>
                            </div>
                        </div>@endif
                        <div class="subscribe">
                            <figure>
                                <img src="{{ asset('web_files/images/logo.png') }} " class="img-fluid" alt="Responsive image" style="width: 240px;">
                            </figure>
                            <figure>
                                <img src="{{ asset('web_files/images/email.svg') }} " class="img-fluid" alt="Responsive image">
                            </figure>
                            <div class="subscribe-content">
                                <div>
                                    <h3>
                                        التنبيهات
                                    </h3>
                                    <span>
                                        إشترك ليصلك أخر التحديثات
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control input" id="emailHelp" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">
                                </div>
                                <button onclick="Alerts()" class="btn black-btn">
                                    اشتراك
                                </button>
                            </div>
                        </div>
                        <div class="categories">

                            @foreach($allcategories as $category)
                            <a href="{{ route('mediacare.categoriesflater',$category->id) }}">
                                {{$category->CategoryTranslation[0]->name}}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="block">
        <div class="lastest">
            @if(!empty($Archives))
            <div class="container">
                <div class="right">
                    <a href="{{ route('mediacare.archivesdetails',$Archives->id) }}">
                        <div class="newspaper">
                            <figure>

                                <embed src="{{ asset('uploads/archives/'.$Archives->pdf) }}" width="200px" height="300px" class="img-fluid" alt="Responsive image" />
                            </figure>
                            <div class="news-details">
                                <h4>
                                    قم بتحميل العدد الأخير
                                </h4>
                                <p>
                                    {{$Archives->title}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="left">
                    <div class="buttons">
                        <a target="_blank" href="{{ asset('uploads/archives/'.$Archives->pdf) }}" class="btn black-btn">
                            <figure>
                                <img src="{{ asset('web_files/images/iconfinder-icon.svg') }} " class="img-fluid" alt="Responsive image" style="width: 22px;
                                    height: 16px;">
                            </figure>
                            تحميل العدد
                        </a>
                        <a href="{{ route('mediacare.archives') }}" class="white-btn">
                            الأرشيف
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="{{ asset('web_files/js/slick.min.js') }} "></script>
<script src="{{ asset('web_files/js/customScript.js') }} "></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


<script>
    function Alerts() {

        var url = '{{URL::to("/Alerts")}}';

        var email = $('#emailHelp').val();

        var menu = $('.subscribe').val();
        var emailid = document.getElementById("emailHelp");
        var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (email != '') {
            if (email.match(mailformat)) {
                emailid.style.backgroundColor = "";
                data = {
                    email: email,
                    _token: "{{csrf_token()}}",
                };
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    data: data,
                    success: function(response) {

                        swal({
                                title: 'شكرا لأشتراكك',
                                text: "",
                                type: "success",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    },
                    error: function(response) {
                        swal({
                                title: 'شكرا لأشتراكك',
                                text: "",
                                type: "success",
                                timer: 2000
                            },
                            function() {
                                location.reload();
                            });
                    }
                });
            } else {
                swal({
                    title: 'صيغه الايميل غير صحيحه',
                    text: "",
                    type: "warning",
                });
            }
        } else {
            emailid.style.backgroundColor = "#fbe4e8";
        }

    }
</script>

@endsection

@push('scripts')