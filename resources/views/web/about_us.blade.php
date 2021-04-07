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
                        عن الجريدة
                    </span>
                </div>
                <div class="has-sides">
                    <div class="right-side col-md-8">
                        <div class="about-us">
                            <figure>
                                <img src="{{ asset('web_files/images/20201213220929_big_730x400_43.webp' ) }} " style="width: 937px" alt="">
                            </figure>
                            <div class="about-content">
                                <h2>
                                    عن الجريدة
                                </h2>
                                <div class="paragraph">
                                    <p>
                                        <span>
                                            دشنت شركة الوعلان للتجارة، وكلاء سيارات جيلي بالمملكة العربية السعودية،
                                            مركز
                                            الوعلان جيلي للصيانة المتطور. ويقع المركز الجديد والذي صمم وفقاً للهوية
                                            العالمية
                                            لعلامة جيلي على طريق عسفان بجدة، في المدينة الذكية للصناعات الخفيفة
                                            وصيانة
                                            السيارات، وتبلغ مساحته 3700 متر مربع، كما أنه مزود بأحدث الأجهزة
                                            والوسائل
                                            العصرية، لتقديم خدمات ذات معايير رفيعة المستوى لعملاء جيلي. وحضر حفل
                                            الافتتاح
                                            جمع من مسؤولي شركة الوعلان للتجارة على رأسهم الرئيس التنفيذي للشركة
                                        </span>

                                        <span>
                                            ، دشنت شركة الوعلان للتجارة، وكلاء سيارات جيلي بالمملكة العربية
                                            السعودية،
                                            مركز
                                            الوعلان جيلي للصيانة المتطور. ويقع المركز الجديد والذي صمم وفقاً للهوية
                                            العالمية
                                            لعلامة جيلي على طريق عسفان بجدة، في المدينة الذكية للصناعات الخفيفة
                                            وصيانة
                                            السيارات، وتبلغ مساحته 3700 متر مربع، كما أنه مزود بأحدث الأجهزة
                                            والوسائل
                                            العصرية، لتقديم خدمات ذات معايير رفيعة المستوى لعملاء جيلي. وحضر حفل
                                            الافتتاح
                                            جمع من مسؤولي شركة الوعلان للتجارة على رأسهم الرئيس التنفيذي للشركة،
                                            دشنت
                                            شركة
                                            الوعلان للتجارة، وكلاء سيارات جيلي بالمملكة العربية السعودية، مركز
                                            الوعلان
                                            جيلي
                                            للصيانة المتطور. ويقع المركز الجديد والذي صمم وفقاً للهوية العالمية
                                            لعلامة
                                            جيلي
                                            على طريق عسفان بجدة، في المدينة الذكية للصناعات الخفيفة
                                        </span>
                                        <span>
                                            وصيانة السيارات، وتبلغ مساحته 3700 متر مربع، كما أنه مزود بأحدث الأجهزة
                                            والوسائل العصرية، لتقديم خدمات ذات معايير رفيعة المستوى لعملاء جيلي.
                                            وحضر
                                            حفل الافتتاح جمع من مسؤولي شركة الوعلان للتجارة على رأسهم الرئيس
                                            التنفيذي
                                            للشركة،
                                        </span>
                                    </p>
                                </div>
                                <div class="social">
                                    <h5>
                                        تواصل معنا
                                    </h5>
                                    <div>
                                        <a href="# ">
                                            <figure>
                                                <img src="{{ asset('web_files/images/insta.svg' ) }}   " class="img-fluid " alt="Responsive image ">
                                            </figure>
                                        </a>

                                        <a href="# ">
                                            <figure>
                                                <img src="{{ asset('web_files/images/linked.svg' ) }}  " class="img-fluid " alt="Responsive image ">
                                            </figure>
                                        </a>
                                        <a href="# ">
                                            <figure>
                                                <img src="{{ asset('web_files/images/yt.svg' ) }}  " class="img-fluid " alt="Responsive image ">

                                            </figure>
                                        </a>
                                        <a href="# ">
                                            <figure>
                                                <img src="{{ asset('web_files/images/fb.svg' ) }}  " class="img-fluid " alt="Responsive image ">
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left-side col-md-4">
                        <div class="subscribe" style="margin-top: 0;">
                            <figure>
                                <img src="{{ asset('web_files/images/logo.png' ) }} " class="img-fluid" alt="Responsive image" style="width: 240px;">
                            </figure>
                            <figure>
                                <img src="{{ asset('web_files/images/email.svg' ) }} " class="img-fluid" alt="Responsive image">
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
                                    <input type="email" class="form-control input" id="dd" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">
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


<script src="{{ asset('web_files/js/customScript.js') }} "></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>




<script>
    function Alerts() {

        var url = '{{URL::to("/Alerts")}}';

        var email = $('#dd').val();

        var menu = $('.subscribe').val();
        var emailid = document.getElementById("dd");
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