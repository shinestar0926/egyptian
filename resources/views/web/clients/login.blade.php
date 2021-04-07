@extends('layouts.web.app')

@section('content')

<main>
    <div class="block">
        <div class="sign-in">
            <div class="container">
                <div class="sign-body">
                    <div class="title">
                        <h2>
                            تسجيل الدخول
                        </h2>
                    </div>
                    <div style="font-size: 14px;margin-top: 5px;text-align: center;color: red;">
                    @if(session()->get('error') !=null)
                    {{ session()->get('error') }}

                    @endif

                    @if(session()->get('success') !=null)
                    {{ session()->get('success') }}

                    @endif
                    </div>
                    <form action="{{ route('mediacare.postlogin') }}" method="post" enctype="multipart/form-data">

                        {{csrf_field() }}
                        {{ method_field('post') }}

                        <div class="sign-forms">
                            <div class="form-group">
                                <input class="form-control input" type="email" name="email" placeholder="البريد الإلكترونى">
                            </div>
                            <div class="form-group">
                                <input class="form-control  input" type="password" name="password" placeholder="الرقم السرى">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    تذكرنى
                                </label>
                            </div>
                            <div class="login">
                                <button type="submit" class="black-btn">
                                    تسجيل الدخول
                                </button>
                            </div>
                            <div class="buttons">
                                <a href="{{ route('mediacare.client.index') }}" class="register-btn">
                                    إنشاء حساب
                                </a>
                                <a href="{{ route('mediacare.resetpassword') }}">
                                    هل نسيت كلمة المرور؟
                                </a>
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

@endsection

@push('scripts')