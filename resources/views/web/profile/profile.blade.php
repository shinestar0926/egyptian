@extends('layouts.web.app')
@section('content')

<main>
        <div class="block">
            <div class="personal-page">
                <div class="container">
                    <div class="page-heading">

                    </div>
                    <div class="page-content">
                        <div>
                        @lang('site.Profileimage')
                            @include('partials._errors')
                        </span>
                        <form enctype="multipart/form-data" action="{{ route('mediacare.image.ajax.store') }}" method="post" id="">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <input type="hidden" name="id" value="{{Auth::guard('website')->user()->id}}">
                            <div class="changeable">
                                <div class="image-upload">
                                    <div class="fileUpload">
                                        <input type="file" class="upload" />
                                        <figure>
                                        @if(!empty(Auth::guard('website')->user()->image))
                                            <img src=" {{ asset('uploads/clients/'.Auth::guard('website')->user()->image) }}  " alt="">
                                            @else
                                            <img src="{{ asset('uploads/clients/default.png') }}" alt="" class="image--cover" style="pointer-events: none" />

                                            @endif
                                        </figure>
                                        <input name="image" id="file-inputs" type="file" class="upload" />
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            تغير الصورة الشخصية
                                        </button>
                                    </div>
                                </div>
                            </div>

                            </form>
                            <div class="fields">
                                <div class="two-fields">
                                    <div class="mb-3 field">
                                        <input type="email" class="form-control input" id="exampleFormControlInput1" placeholder="{{Auth::guard('website')->user()->first_name}}" disabled>
                                    </div>
                                    <div class="mb-3 field">
                                        <input type="email" class="form-control input" id="exampleFormControlInput1" placeholder="{{Auth::guard('website')->user()->last_name}}"disabled>
                                    </div>
                                </div>
                                <div class="mb-3 field">
                                    <input type="email" class="form-control input" id="exampleFormControlInput1" placeholder="{{Auth::guard('website')->user()->email}}"disabled>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="{{ route('mediacare.newpassword' ,Auth::guard('website')->user()->id ) }}" class="btn black-btn">
                                تغير كلمة السر
                            </a>
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