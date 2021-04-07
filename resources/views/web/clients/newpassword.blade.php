@extends('layouts.web.app')

@section('content')

<main>
    <div class="block">
        <div class="sign-in">
            <div class="container">
                <div class="sign-body">
                    <div class="title">
                        <h2>
                            أنشاء رقم سري جديد
                        </h2>
                    </div>

                    @include('partials._errors')

                    @if(session()->get('error') !=null)
                    {{ session()->get('error') }}
                    @endif

                    <form action="{{ route('mediacare.updatenewpass') }}" method="post" enctype="multipart/form-data">

                        {{csrf_field() }}
                        {{ method_field('post') }}
                        <div class="sign-forms">
                            <div class="form-group">
                                <input class="input input-custom " type="password" name="password" id="password" placeholder="رقم سري جديد">
                                <input class="input input-custom " type="hidden" name="email" id="email" value=" {{$email}}" placeholder="email">
                            </div>
                            <div class="form-group">
                            <input class="input input-custom " type="password" name="password_confirmation" id="password" placeholder="تأكيد الرقم السري">
                            </div>



                            <button type="submit" class="btn black-btn">
                                تأكيد
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