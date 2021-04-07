


<br>

@if(!empty($vedios))
@foreach($vedios as $vedio)
 <iframe width="200" height="200" src='https://www.youtube.com/embed/{{ $vedio->vedios }}'
                                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            




                                    
@endforeach
@endif
@if(!empty($images))
@foreach($images as $image)
<img src="{{ asset('uploads/product_images/'.$image->image) }}" style="width: 100px"  class="img-thumbnail" alt="">



@endforeach
@endif
