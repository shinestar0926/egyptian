@extends('layouts.web.app')

@section('content')

<main>
    <div class="block">
        <div class="container">
            <div class="contact-us">
                <div class="contact-form col-md-8">
                    <h2>
                        تواصل معنا
                    </h2>
                    <p>
                        دشنت شركة الوعلان للتجارة، وكلاء سيارات جيلي بالمملكة العربية السعودية، مركز الوعلان جيلي للصيانة المتطور
                    </p>
                    <div style="font-size: 14px;text-align: center;color: #00ca2f;padding-bottom: 44px;">
                        @include('partials._errors')
                        @if(session()->get('success') !=null)
                        {{ session()->get('success') }}
                        @endif
                    </div>
                    <!--  <form action="{{ route('mediacare.contactus.store') }}" method="post" enctype="multipart/form-data">-->

                    {{--csrf_field() --}}
                    {{-- method_field('post') --}}
                    <div class="fields">
                        <div class="small-fields">
                            <div class="field">
                                <div class="mb-3">
                                    <input style="font-weight: 50px;" type="text" class="form-control input" id="name" name="name" placeholder="الأسم">
                                </div>
                            </div>
                            <div class="field">
                                <div class="mb-3">
                                    <input type="email" class="form-control input" id="email" name="email" placeholder="البريد الإلكترونى">
                                </div>
                            </div>
                        </div>
                        <div class="big-field">
                            <div class="mb-3">
                                <textarea rows="4" cols="50" name="message" id="message" form="usrform" class="form-control input"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button onclick="savecontact()" class="btn black-btn">
                            إرسال
                        </button>
                    </div>
                    <!-- </form>-->
                </div>
                <div class="left col-md-4">
                    <div class="location">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <a href="https://yt2.org"></a><br>

                            </div>
                        </div>
                    </div>
                    <div class="call-us">
                        <p>
                            <i class="fa fa-map-marker"></i> جدة
                        </p>
                        <p>
                            <i class="fa fa-phone"></i> +99523125461515
                        </p>
                        <p>
                            <i class="fa fa-envelope"></i> info@mediacar.sa
                        </p>
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
    function savecontact() {
        var url = '{{URL::to("/savecontact")}}';
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        var menu = $('.comments').val();
        var emailid = document.getElementById("email");
        var namelid = document.getElementById("name");
        var messageid = document.getElementById("message");

        var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (name != '' && email != '' && message != '') {
            if (email.match(mailformat)) {
                emailid.style.backgroundColor = "";
                data = {
                    name: name,
                    email: email,
                    message: message,
                    _token: "{{csrf_token()}}",
                };
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    data: data,
                    success: function(response) {

                        swal({
                                title: 'تم أرسال رسالتك بنجاح',
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
                                title: 'تم أرسال رسالتك بنجاح',
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

            if (name == '') {
                namelid.style.backgroundColor = "#fbe4e8";
            } else {
                namelid.style.backgroundColor = "";
            }
            if (email == '') {
                emailid.style.backgroundColor = "#fbe4e8";
            } else {
                emailid.style.backgroundColor = "";
            }
            if (message == '') {
                messageid.style.backgroundColor = "#fbe4e8";
            } else {
                messageid.style.backgroundColor = "";
            }
        }
    }
</script>
@endsection

@push('scripts')