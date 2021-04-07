@extends('layouts.web.app')

@section('content')

<main>
    <div class="block">
        <div class="archives">
            <div class="container">
                <div class="page-heading">
                    <a href="{{ route('mediacare.index') }}">
                        الرئيسية
                    </a>
                    <i class="fa fa-chevron-left"></i>
                    <span>
                        الأرشيف
                    </span>
                </div>
                <div class="grid-container">

                    @foreach($archives as $archive)
                    <div class="grid-item">
                        <figure>
                            <!-- <img src="{{ asset('uploads/archives/'.$archive->pdf) }}" class="img-fluid" alt="Responsive image"> -->
                            <embed src="{{ asset('uploads/archives/'.$archive->pdf) }}" width="200px" height="300px" class="img-fluid" alt="Responsive image" />
                        </figure>
                        <div class="news-details">
                            <a target="_blank" href="{{ route('mediacare.archivesdetails',$archive->id) }}" >
                                <h4>
                                    {{ $archive->title}}
                                </h4>
                            </a>
                            <p>
                                {!! $archive->description!!}
                            </p>
                            
                            <a target="_blank" href="{{ asset('uploads/archives/'.$archive->pdf) }}" class="btn">
                                <figure>
                                    <img src="{{ asset('web_files/images/iconfinder-icon.svg') }} " class="img-fluid" alt="Responsive image" style="width: 22px;
                                        height: 16px;">
                                </figure>
                                تحميل العدد
                            </a>

                        </div>
                    </div>




                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>


@endsection

@push('scripts')