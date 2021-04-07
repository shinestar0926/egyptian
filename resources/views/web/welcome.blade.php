@extends('layouts.web.app')

@section('content')

<main>

    <div class="block">
        <div class="container">
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
                                 <div class="home-videos">
                                 <figure>
                                        @if($latestpost->default_image !=null)
                                        <img style="width:454px;height:281px " src="{{ asset('uploads/product_images/'.$latestpost->default_image) }}  " class="img-fluid" alt="Responsive image">
                                        @else
                                        <iframe width="420" height="345" src="https://www.youtube.com/embed/{{ $latestpost->default_vedios }}?autoplay=1&mute=1" class="img-fluid" allowfullscreen>
                                        </iframe>
                                        @endif
                                    </figure>
                                 </div>
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

                        {{ $latestposts->appends(request()->query())->links() }}

                    </div>
                </div>
                <div class="left-side col-md-4">
                    <div>
                        <div class="heading">
                            <h3>
                                أخبار هامه
                            </h3>
                            <a href="" style="visibility: hidden;">
                                رؤية المزيد
                            </a>
                        </div>
                        @foreach($importantposts as $importantpost)
                        <div class="cards">
                            <div class="card">
                                <a target="_blank" href="{{ route('mediacare.details',$importantpost->posts->id) }}">
                                    <figure>
                                        <img style="width:184px;height:110px" src="{{ asset('uploads/product_images/'.$importantpost->posts->default_image) }}  " class="img-fluid" alt="Responsive image">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-heading">
                                            <p>
                                                <span>
                                                    {{$importantpost->posts->category->CategoryTranslation[0]->name}}
                                                </span> <?php $timestamp = strtotime($importantpost->created_at); ?>
                                                {{date("d-m-Y", $timestamp) }}
                                            </p>
                                        </div>
                                        <p>
                                            {{$importantpost->posts->title}}
                                        </p>
                                    </div>
                                </a>
                            </div>

                        </div>
                        @endforeach

                    </div>
                    @if(!empty($Advertises))
                    <div class="advertise">
                        <figure>
                            <img style="" src="{{ asset('uploads/advertise_images/'.$Advertises->image) }} " class="img-fluid" alt="Responsive image">
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
                                

                                <input type="email" class="inputtext _55r1 inputtext inputtext form-control input emailHelp" name="email" id="emailHelp" tabindex="0" value="" autofocus="1" autocomplete="username" placeholder="البريد الإلكترونى">


                            </div>
                            <button onclick="Alerts()" class="btn black-btn">
                                اشتراك
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">

            <div class="carousel">
                @if(!empty($vedioSlider ))
                <div class="progress-bar progress-bar--primary hide-on-desktop">
                    <div class="progress-bar__fill"></div>
                </div>
                <div class="main-post-wrapper">

                    <div class="slides">
                        @foreach($vedioSlider as $vedio)
                        <article class="main-post main-post--active">

                            <iframe width="420" height="345" src="https://www.youtube.com/embed/{{ $vedio->posts->default_vedios }}?autoplay=1&mute=1" class="main-post__image" allowfullscreen>
                            </iframe>

                            <div class="main-post__content">

                                <h2 class="main-post__title">
                                    {{$vedio->posts->title}}
                                </h2>

                            </div>

                        </article>
                        @endforeach
                        @foreach($vedioSlider as $vedio)
                        <article class="main-post main-post--not-active ">

                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $vedio->posts->default_vedios }}?start=60&autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="main-post__image" allowfullscreen></iframe>


                            <div class="main-post__content">
                                <h2 class="main-post__title">
                                    {{$vedio->posts->title}}
                                </h2>
                            </div>

                        </article>

                        @endforeach








                    </div>

                </div>

                <div class="posts-wrapper hide-on-mobile">

                    @foreach($vedioSlider as $vedio)
                    <article class="post post--active">

                        <div class="progress-bar">
                            <div class="progress-bar__fill"></div>
                        </div>

                    </article> @endforeach
                    @foreach($vedioSlider as $vedio)
                    <article class="post">

                        <div class="progress-bar">
                            <div class="progress-bar__fill"></div>
                        </div>

                    </article>
                    @endforeach

                </div>
                @else

                @endif
            </div>


        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="two-columns">
                @foreach($importantselectcategory as $important)
                <div class="column">
                    <div class="heading">
                        <h3>
                            {{$important->category->CategoryTranslation[0]->name}}
                        </h3>
                        <a href="{{ route('mediacare.categoriesflater',$important->category->id) }}">
                            رؤية المزيد
                        </a>
                    </div>

                    @foreach($important->category->posts as $post)
                    <div class="cards">


                        <div class="card ">
                            <a target="_blank" href="{{ route('mediacare.details',$post->id) }}">

                                @if($post->default_image)
                                <figure>
                                    <img src="{{ asset('uploads/product_images/'.$post->default_image) }}" class="img-fluid" alt="Responsive image">
                                </figure>
                                @else
                                <figure>
                                    <iframe width="200" height="200" src='https://www.youtube.com/embed/{{ $post->default_vedios }}' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </figure>
                                @endif
                                <div class="card-content">
                                    <div class="card-heading">
                                        <p>
                                            <span>
                                                {{$important->category->CategoryTranslation[0]->name}}
                                                <?php $timestamp = strtotime($post->created_at); ?>
                                            </span> {{--date("d-m-Y", $timestamp) --}}





                                        </p>
                                    </div>
                                    <p>
                                        {{$post->title}}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>


                @endforeach
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    let mainPosts = document.querySelectorAll('.main-post');
    let posts = document.querySelectorAll('.post');

    let i = 0;
    let postIndex = 0;
    let currentPost = posts[postIndex];
    let currentMainPost = mainPosts[postIndex];
   
    // 180
    


    var isMobileVersion = document.getElementsByClassName('progress-bar__fill');
              
               if (isMobileVersion.length >1) {

        function progress() {
            if (i === 100) {
                i = -5;
                // reset progress bar
             ///alert(isMobileVersion.length );
               

                currentPost.querySelector('.progress-bar__fill').style.width = 0;
                document.querySelector(
                    '.progress-bar--primary .progress-bar__fill'
                ).style.width = 0;
                currentPost.classList.remove('post--active');

                postIndex++;

                currentMainPost.classList.add('main-post--not-active');
                currentMainPost.classList.remove('main-post--active');

                // reset postIndex to loop over the slides again
                if (postIndex === posts.length) {
                    postIndex = 0;
                }

                currentPost = posts[postIndex];
                currentMainPost = mainPosts[postIndex];
            } else {
                i++;
                currentPost.querySelector('.progress-bar__fill').style.width = `${i}%`;
                document.querySelector(
                    '.progress-bar--primary .progress-bar__fill'
                ).style.width = `${i}%`;
                currentPost.classList.add('post--active');

                currentMainPost.classList.add('main-post--active');
                currentMainPost.classList.remove('main-post--not-active');
            }
        }
        let progressInterval = setInterval(progress, 100);
        }else{
           // alert(isMobileVersion.length );
        }
    

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
            emailid.style.backgroundColor = "#bc00224a";
            
        }

    }
</script>
@endsection

@push('scripts')