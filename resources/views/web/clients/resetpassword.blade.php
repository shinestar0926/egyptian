@extends('layouts.web.app')

@section('content')

<main>
    <div class="block">
        <div class="sign-in">
            <div class="container">
                <div class="sign-body">
                    <div class="title">
                        <h2>
                            هل نسيت كلمة المرور
                        </h2>
                    </div>

                    <form action="{{ route('mediacare.resetnewpassword') }}" method="post" enctype="multipart/form-data">

                        {{csrf_field() }}
                        {{ method_field('post') }}
                        <div style="font-size: 14px;margin-top: 5px;text-align: center;color: red;">

                        @if(session()->get('error') !=null)
                        {{ session()->get('error') }}
                        @endif
                        @if(session()->get('status') !=null)
                        {{ session()->get('status') }}

                        @endif
                        </div>
                        <div class="sign-forms">
                            <div class="form-group">
                                <input class="form-control input" type="email" name="email" placeholder="البريد الإلكترونى">
                            </div>


                            <button type="submit" class="btn black-btn">
                                بحث
                            </button>
                            <div class="buttons">
                                <a href="{{ route('mediacare.login') }}" class="register-btn">
                                    تسجيل الدخول
                                </a>

                            </div>
                        </div>

                    </form>
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