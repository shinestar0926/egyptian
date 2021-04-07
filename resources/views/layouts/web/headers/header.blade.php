<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .btn {
            font-weight: 700;
            font-size: 20px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
        }

      
        .dropdown .btn::before {
            content: "\f107";
            position: absolute;
            top: 5px;
            left: -8px;
            font-family: FontAwesome;
            display: inline-block;
            padding-right: 6px;
            vertical-align: middle;
        }
        

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            overflow: auto;
            width: 250px;

            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            top: 60px;
            right: 30px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
        
    </style>







    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mediacar.sa</title>
    <link rel="icon" href="{!! asset('web_files/images/Site_Icon.jpeg') !!}" />
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('web_files/css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('web_files/scss/custom.css') }} ">
    <link rel="stylesheet" href="{{ asset('web_files/css/slick.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<!-- <body dir="rtl"> -->
<body dir="ltr">
    <div class="topbar">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    @if(Auth::guard('website')->check() !=1)
                    <a href="{{ route('mediacare.client.index') }}" class=" topbar-item">
                        تسجيل الدخول / انشاء حساب
                    </a>
                    @else
                    <select onchange="location = this.value;" name="" id="" class="dropdown show dropdown-menu prof">

                        <option value="" selected disabled hidden> {{Auth::guard('website')->user()->first_name}}</option>


                        <option value="{{ route('mediacare.profile.index') }}">
                            <a href="{{ route('mediacare.profile.index') }}" class="btn btn-default btn-flat">@lang('site.profile')</a>
                        </option>
                        <option value="{{ route('mediacare.logout2') }}">
                            <a href="{{ route('mediacare.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">@lang('site.logout')</a>
                            <form id="logout-form" action="{{ route('mediacare.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </option>
                    </select>
                    @endif
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex">
                        <a href="{{ route('mediacare.contactus.index') }}" class=" topbar-item">
                            تواصل معنا
                        </a>
                        <a href="{{ route('mediacare.about_us') }}" class=" topbar-item">
                            عن الجريدة
                        </a>
                    </div>
                    <div class="social d-flex align-items-center">
                       <!-- <a href="">
                            <figure>
                                <img src="{{ asset('web_files/images/youtube.svg') }} " class="img-fluid" alt="Responsive image">
                            </figure>
                        </a>-->
                        <a href="https://www.instagram.com/mediacarsa/"  target="_blank">
                            <figure>
                                <img src="{{ asset('web_files/images/instagram.svg') }} " class="img-fluid" alt="Responsive image">
                            </figure>
                        </a>
                        <a href="https://twitter.com/infomediacarsa1"  target="_blank">
                            <figure>
                            <img  style="width: 25px;height: 25px;"src=" {{ asset('web_files/images/twitter.svg') }} " class="img-fluid" alt="Responsive image">
                                
                            </figure>
                        </a>
                        <a href="https://www.facebook.com/mediacarsa/"  target="_blank">
                            <figure>
                                <img src=" {{ asset('web_files/images/facebook.svg') }} " class="img-fluid" alt="Responsive image">
                            </figure>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <nav class="navbar-expand-lg navbar-light d-flex align-items-center">
                <div class="container-fluid d-flex">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="logo">
                        <a class="navbar-brand" href="{{ route('mediacare.index') }}">
                            <figure>
                                <img src=" {{ asset('web_files/images/logo.png') }} " class="img-fluid" alt="Responsive image">
                            </figure>
                        </a>
                    </div>
                    <form class="d-flex search-input" action="{{ route('mediacare.products.index') }}" method="get">


                        <input class="form-control me-2" type="text" name="search" class="input " placeholder="بحث في الموقع" value="{{ request()->search }}" aria-label="Search">


                        <button style="" type="submit" class="btn"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mb-2 mb-lg-0">
                            @foreach( $allmunes as $row)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('mediacare.categoriesflater',$row->category->id) }}">
                                    {{$row->CategoryTranslation->name}}
                                </a>

                            </li>
                            @endforeach




                            <li class="nav-item dropdown">
                                <button onclick="myFunction()" class="dropbtn btn">
                                    أقسام اخري</button>

                                <div id="myDropdown" class="dropdown-content">
                                    @foreach($categories as $cat)
                                    @foreach($cat->CategoryTranslation as $cat2)
                                    <a class="dropdown-item" href="{{ route('mediacare.categoriesflater',$cat->id) }}">{{$cat2->name}}</a>
                                    @endforeach
                                    @endforeach
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

        </div>


    </header>




    <script>
        /* When the user clicks on the button, 
                                                                                toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>