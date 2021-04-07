<footer>
    <div class="container">
        <div class="columns row">
            <div class="col-xs-12">
                <h4>التنبيهات</h4>
                <ul>
                    <li>
                        <p>
                            إشترك ليصلك أخر التحديثات
                        </p>
                    </li>
                    <li>
                        <div class="form">
                            <div class="form-group">
                                <input type="email" class="form-control input" id="f1" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">
                            </div>
                            <button onclick="Alertss()" class="btn black-btn">
                                اشتراك
                            </button>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="col-xs-12  ">
                <h4>تصفح</h4>
                <ul>
                    <li>
                        <a href="{{ route('mediacare.contactus.index') }}">تواصل معنا </a>
                    </li>
                    <li>
                        <a href="{{ route('mediacare.about_us') }}">عن الجريدة</a>
                    </li>
                    <li>
                        <a href="{{ route('mediacare.archives') }}">الأرشيف</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12">
                <h4>تواصل معنا</h4>
                <div class="social">
                    <a href="#">
                        <figure>
                            <img src="{{ asset('web_files/images/insta.svg') }} " class="img-fluid" alt="Responsive image">
                        </figure>
                    </a>

                    <a href="#">
                        <figure>
                            <img src="{{ asset('web_files/images/linked.svg') }} " class="img-fluid" alt="Responsive image">
                        </figure>
                    </a>
                    <a href="#">
                        <figure>
                            <img src="{{ asset('web_files/images/yt.svg') }} " class="img-fluid" alt="Responsive image">

                        </figure>
                    </a>
                    <a href="#">
                        <figure>
                            <img src="{{ asset('web_files/images/fb.svg') }} " class="img-fluid" alt="Responsive image">
                        </figure>
                    </a>
                </div>
            </div>
        </div>

    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="{{ asset('web_files/js/slick.min.js') }} "></script>
<script src="{{ asset('web_files/js/customScript.js') }} "></script>

<script>
    $('.slider').slick({
        slidesToShow: 1,
        dots: true,
        arrows: false,
        slidesToScroll: 1,
        rtl: true,

    });

    function Alertss() {

        var url = '{{URL::to("/Alerts")}}';

        var email = $('#f1').val();

        var menu = $('.subscribe').val();
        var emailid = document.getElementById("f1");
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



</body>

</html>