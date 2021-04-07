@extends('layouts.web.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .article .social .changeable {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-left: auto;
    }

    .article .social .changeable .fileUpload {
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .article .social .changeable .fileUpload .upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
        height: 100px;
        width: 100px;
        cursor: pointer;
    }

    .article .social .changeable iframe {
        position: fixed;
        right: 100%;
        bottom: 100%;
    }
</style>
<main>
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@nytimesbits" />
<meta name="twitter:creator" content="@nickbilton" />
<meta property="og:url" content="http://bits.blogs.nytimes.com/2011/12/08/a-twitter-for-my-sister/" />
<meta property="og:title" content="A Twitter for My Sister" />
<meta property="og:description" content="In the early days, Twitter grew so quickly that it was almost impossible to add new features because engineers spent their time trying to keep the rocket ship from stalling." />
<meta property="og:image" content="http://graphics8.nytimes.com/images/2011/12/08/technology/bits-newtwitter/bits-newtwitter-tmagArticle.jpg" />

    <div class="block">
        <div class="container">
            <div class="has-sides">
                <div class="right-side col-md-8">
                    <div class="news-report">
                        <div class="slider-for">
                            @foreach($images as $image)
                            <div class="slick-side">
                                <figure>
                                    <img src="{{ asset('uploads/product_images/'.$image->image) }} " alt="">
                                </figure>
                            </div>

                            @endforeach
                            @foreach($vidioes as $vidioe)
                            <div class="slick-side">
                                <div class="slider-for-videos">
                                    <figure>
                                        <iframe width="420" height="345" src="https://www.youtube.com/embed/{{ $vidioe->vedios }}?autoplay=1&mute=1" class="img-fluid" allowfullscreen>
                                        </iframe>
                                    </figure>
                                </div>
                            </div>

                            @endforeach


                        </div>

                        <div class="slider-nav">
                            @foreach($images as $image)
                            <div class="slick-side">
                                <figure>

                                    <img src="{{ asset('uploads/product_images/'.$image->image) }} " alt="">

                                </figure>


                            </div>



                            @endforeach

                            @foreach($vidioes as $vidioe)
                            <div class="slick-side">
                                <div class="slider-nav-videos">
                                    <figure>

                                        <iframe width="420" height="345" src="https://www.youtube.com/embed/{{ $vidioe->vedios }}?autoplay=1&mute=1" class="img-fluid" allowfullscreen>
                                        </iframe>
                                    </figure>
                                </div>


                            </div>



                            @endforeach

                        </div>
                    </div>
                    <div class="article">
                        <div class="article-heading">
                            <p>
                                <span class="orange-box">
                                    {{$posts->category->CategoryTranslation[0]->name}}

                                </span> <?php $timestamp = strtotime($posts->created_at); ?> {{date("d-m-Y", $timestamp) }}
                            </p>
                            <h2>
                                {{$posts->title}} <input type="hidden" id="post_id" value=" {{$posts->id}} "> <input type="hidden" id="clients_id" value="
                                @if(Auth::guard('website')->check() !=1)
                                @else
                                {{Auth::guard('website')->user()->id}}
                                @endif
                                 ">
                            </h2>
                        </div>
                        <div class="paragraph">


                            <p>
                                <span>
                                    {!! $posts->description !!}
                                </span>
                            </p>

                        </div>
                        <div class="social">
                            <h5>
                                مشاركة هذا المقال
                            </h5>
                            <div>
                                <a href="# " style="display: none;">
                                    <figure>
                                        <img src="{{ asset('web_files/images/insta.svg' ) }} " class="img-fluid " alt="Responsive image ">
                                    </figure>
                                </a>
                                <a>
                                    <div class="changeable ">
                                        <div class="fileUpload">
                                            <figure>
                                                <img src=" {{ asset('web_files/images/fb.svg' ) }}  " class="img-fluid " alt="Responsive image ">

                                            </figure>
                                            <iframe class="upload" style="display: flex;width: 25px;" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fmediacar.sa%2Far%2Fdetails%2F{{$posts->id}}&layout=button_count&size=small&appId=2807596715997137&width=77&height=26" width="77" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen></iframe>


                                        </div>
                                    </div>

                                </a>

                                <button onclick="myFunction2()" class="btn" style="padding: 0; margin-left:15px">
                                    <figure>
                                        <img src="{{ asset('web_files/images/copy-icon.svg' ) }}  " class="img-fluid " alt="Responsive image ">
                                    </figure>

                                </button>


                                <a target="_blank"
                                
                                 href="http://twitter.com/intent/tweet?&url=https://mediacar.sa/ar/details/{{$posts->id}} 
                                 &text={{$posts->title}}
                                 &via=mediacar
                                 "
                                 >

                                 							

                                    <i class="fa fa-twitter"></i>
                                </a>

                                


                            </div>
                        </div>
                        <div class="comments-section">
                            <div class="comments-heading">
                                <p>
                                    <span>
                                        تعليقات
                                    </span>
                                </p>

                            </div>
                            <div class="comment-field">
                                <figure>
                                    @if(!empty(Auth::guard('website')->user()->image))
                                    <img style="width: 30px;" src=" {{ asset('uploads/clients/'.Auth::guard('website')->user()->image) }} " alt="">

                                    @else
                                    <img style="width: 30px;" src="{{ asset('uploads/clients/default.png') }}" />
                                    @endif
                                </figure>

                                <div class="form-group">
                                   
                                 
                                                        <textarea  id="comment"  class="form-control input" style="height: 60px;" placeholder="...أكتب تعليق"></textarea>


                                </div>
                                @if(Auth::guard('website')->check() !=1)

                                <a href="{{ route('mediacare.client.index') }}" style="margin-right: 20px;height: 45px;width: 106px;font-size: 14px;font-family: bold" class="btn btn-danger">
                                    تسجيل الدخول
                                </a>
                                @else
                                <button onclick="savecomment()" style="margin-right: 20px;height: 50px;width: 80px;" class="btn btn-primary"> تعليق </button>
                                @endif

                            </div>

                            <!-- <div class="email-signup">
                               <h4>
                                            اتعجبك هذه المقالة ؟
                                        </h4>
                                        <p>
                                            اشترك في النشرة الإخبارية MediaCar
                                        </p>
                                        <button class="btn btn-primary">
                                            اشترك الان
                                        </button>

                            </div>-->
                            @foreach($comments as $comment)

                            <div class="comments">
                                <figure>
                                    @if(!empty($comment->Client->image))
                                    <img style="width: 25px;" src=" {{ asset('uploads/clients/'.Auth::guard('website')->user()->image) }} " alt="">

                                    @else
                                    <img style="width: 25px;" src="{{ asset('uploads/clients/default.png') }}" />
                                    @endif
                                </figure>
                                <div class="comment">
                                    <h4>
                                        {{ $comment->Client->first_name .' ' . $comment->Client->last_name }}
                                    </h4>
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                    <div class="buttons">
                                        @if(Auth::guard('website')->check() !=1)

                                        @else
                                        <button onclick="showreplay({{$comment->id}})" class="btn" id="replay">
                                            رد
                                        </button>
                                        @endif
                                        <!--<button class="btn">
                                            <i class="fa fa-thumbs-up"></i>
                                        </button>-->
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="replaytext{{$comment->id}}" class="form-control input" aria-describedby="emailHelp" placeholder="replay" style="display: none;">
                                        <button onclick="replay({{$comment->id}})" style="
                                        
                                        margin-right: 15px;height: 45px;width: 80px;display: none;" class="btn btn-success " id="replayadd{{$comment->id}}"> رد </button>
                                    </div>
                                </div>
                            </div>

                            @foreach($comment->Replaycomments as $row)
                            <div class="comments smaller">

                                <figure>
                                    @if(!empty($row->Client->image))
                                    <img src="{{ asset('uploads/clients/'.$row->Client->image) }}" alt="">
                                    @else
                                    <img style="width: 25px;" src="{{ asset('uploads/clients/default.png') }}" />
                                    @endif
                                </figure>
                                <div class="comment">
                                    <h4>
                                        {{ $row->Client->first_name}}
                                    </h4>
                                    <p>

                                        {{$row->replaytext}}

                                    </p>
                                </div>

                            </div>

                            @endforeach
                            @endforeach

                        </div>
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
                                <input type="email" class="form-control input" aria-describedby="emailHelp" id="emailHelp" placeholder="البريد الإلكترونى">
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
            <div class="grid">
                <div class="grid-title">
                    <span>
                        أخبار مشابهة
                    </span>
                    <a href="#">

                    </a>
                </div>
                <div class="grid-container">

                    @foreach($samecategories as $row)
                    <div class="grid-item">
                        <a href="{{ route('mediacare.details',$row->id) }}">
                            <div class="img-section">
                                <div class="similar-news">
                                    <figure>
                                        @if($row->default_image !=null)
                                        <img src="{{ asset('uploads/product_images/'.$row->default_image) }}  " class="img-fluid" alt="Responsive image">
                                        @else
                                        <iframe width="200" height="200" src='https://www.youtube.com/embed/{{ $row->default_vedios }}' frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                        @endif
                                    </figure>
                                </div>
                                <span class="orange-box">
                                    {{$row->category->CategoryTranslation[0]->name}}
                                </span>
                            </div>
                            <div class="grid-content">
                                <div class="grid-heading">
                                    <p>
                                        <?php $timestamp = strtotime($row->created_at); ?> {{date("d-m-Y", $timestamp) }}
                                    </p>
                                </div>
                                <p>
                                    {{ $row->title}}
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach

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
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        rtl: true,
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        rtl: true,

    });

    /* $(document).ready(function() {

        $("#replays").click(function() {

            $("#replaytext").toggle();
            $('#replayadd').toggle();
        });
    });
*/

    function showreplay(id) {
        $("#replaytext" + id).toggle();
        $('#replayadd' + id).toggle();
    }


    function savecomment() {

        var url = '{{URL::to("/savecomment")}}';
        var comment = $('#comment').val();
        var post_id = $('#post_id').val();
        var clients_id = $('#clients_id').val();

        var menu = $('.comments').val();
        var commentid = document.getElementById("comment");
        if (comment != '') {
            commentid.style.backgroundColor = "";
            data = {
                comment: comment,
                post_id: post_id,
                clients_id: clients_id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: data,
                success: function(response) {

                    swal({
                            title: 'في نتظار الموافقه علي التعليق',
                            text: "",
                            type: "success",
                            timer: 1000
                        },
                        function() {
                            location.reload();
                        });
                },
                error: function(response) {
                    swal({
                            title: 'في نتظار الموافقه علي التعليق',
                            text: "",
                            type: "success",
                            timer: 1000
                        },
                        function() {
                            location.reload();
                        });
                }
            });

        } else {
            commentid.style.backgroundColor = "#fbe4e8";
        }
    }

    function replay(id) {

        var url = '{{URL::to("/replaycomment")}}';
        var comment_id = id;
        var replaytext = $('#replaytext' + comment_id).val();

        var clients_id = $('#clients_id').val();

        var menu = $('.comments').val();
        var replaytextid = document.getElementById("replaytext" + comment_id);

        if (replaytext != '') {

            replaytextid.style.backgroundColor = "";
            data = {
                replaytext: replaytext,
                comment_id: comment_id,
                clients_id: clients_id,
                _token: "{{csrf_token()}}",
            };
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: data,
                success: function(response) {

                    swal({
                            title: 'في نتظار الموافقه علي التعليق',
                            text: "",
                            type: "success",
                            timer: 1000
                        },
                        function() {
                            location.reload();
                        });
                },
                error: function(response) {
                    swal({
                            title: 'في نتظار الموافقه علي التعليق',
                            text: "",
                            type: "success",
                            timer: 1000
                        },
                        function() {
                            location.reload();
                        });
                }
            });

        } else {
            replaytextid.style.backgroundColor = "#fbe4e8";
        }
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
                                timer: 1000
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
                                timer: 1000
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

    /*
    const span = document.getElementById("copylink");

    span.onclick = function() {
      
      document.execCommand("copy");
    }

    span.addEventListener("copy", function(event) {
      event.preventDefault();
      if (event.clipboardData) {
        event.clipboardData.setData("text/plain", span.textContent);
        console.log(event.clipboardData.getData("text"))
      }
    });
    */

    function myFunction2() {
        copyTextToClipboard(location.href);


    }



    function copyTextToClipboard(text) {
        var textArea = document.createElement("textarea");


        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;


        textArea.style.width = '2em';
        textArea.style.height = '2em';

        textArea.style.padding = 0;

        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';


        textArea.style.background = 'transparent';


        textArea.value = text;

        document.body.appendChild(textArea);

        textArea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
        } catch (err) {
            console.log('Oops, unable to copy');
        }

        document.body.removeChild(textArea);
    }
</script>
@endsection

@push('scripts')