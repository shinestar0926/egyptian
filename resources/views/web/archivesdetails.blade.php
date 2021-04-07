@extends('layouts.web.app')

@section('content')
<style>
    .inside-paper .social .changeable {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-left: auto;
    }

    .inside-paper .social .changeable .fileUpload {
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }

    .inside-paper .social .changeable .fileUpload .upload {
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

    .inside-paper .social .changeable iframe {
        position: fixed;
        right: 100%;
        bottom: 100%;
    }

    main .block .inside-paper .social i {
        color: white;
        background: #A1A1A1;
        width: 24px;
        height: 24px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }
</style>
<main>
    <div class="block ">
        <div class="inside-paper">
            <div class="container ">
                <div class="page-heading">
                    <a href="{{ route('mediacare.client.index') }}">
                        الرئيسية
                    </a>
                    <i class="fa fa-chevron-left"></i>
                    <a href="{{ route('mediacare.archives') }}">
                        الارشيف

                    </a>
                    <i class="fa fa-chevron-left"></i>

                    <span>
                        {{$archives_details->title}}
                    </span>
                </div>
                <div class="has-sides">
                    <div class="right ">
                        <a href="{{ route('mediacare.archivesdetails',$archives_details->id) }}" class="paper">
                            <figure>
                                <embed src="{{ asset('uploads/archives/'.$archives_details->pdf) }}" width="200px" height="300px" class="img-fluid" alt="Responsive image" />
                            </figure>
                            <div class="news-details">
                                <h4>
                                    {{$archives_details->title}}
                                </h4>
                                <p>
                                    {!! $archives_details->description !!}

                                </p>

                            </div>
                        </a>
                    </div>
                    <div class="left ">
                        <div class="buttons">
                            <a target="_blank" href="{{ asset('uploads/archives/'.$archives_details->pdf) }}" class="btn black-btn ">
                                <figure>
                                    <img src="{{ asset('web_files/images/iconfinder-icon.svg') }}  " class="img-fluid " alt="Responsive image " style="width: 22px; height: 16px; ">
                                </figure>
                                تحميل العدد
                            </a>
                            <a href="{{ route('mediacare.archives') }} " class="white-btn ">
                                الأرشيف
                            </a>
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
                                <a >
                                <div class="changeable ">
                                                <div class="fileUpload">
                                    <figure >
                                   <img src=" {{ asset('web_files/images/fb.svg' ) }}  " class="img-fluid " alt="Responsive image ">

                                    </figure>
                                    <iframe class="upload" style="display: flex;width: 25px;" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fmediacar.sa%2Far%2Fdetails%2F{{$Archives->id}}&layout=button_count&size=small&appId=2807596715997137&width=77&height=26" width="77" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>

                   
                               </div>
                               </div>

                               </a>

                                <button onclick="myFunction()" class="btn" style="padding: 0; margin-left:15px" >
                                    <figure>
                                        <img src="{{ asset('web_files/images/copy-icon.svg' ) }}  " class="img-fluid " alt="Responsive image ">
                                    </figure>
                                    
                                </button>
                               
                                
                                <a target="_blank" href="http://twitter.com/intent/tweet?&url=https://mediacar.sa/ar/details/{{$Archives->id}}">
                                    <i class="fa fa-twitter"></i>
                                </a>

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="block">
        <div class="lastest">
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
        </div>
    </div>
</main>


<script>
function myFunction() {
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