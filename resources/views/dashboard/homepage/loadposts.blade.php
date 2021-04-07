<div class="box-body">

    @if ($products->count() > 0)

    <table class="table table-hover">

        <thead>
            <tr>

                <th>@lang('site.title')</th>
                <th>@lang('site.image')</th>
                <th>@lang('site.action')</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $index=>$product)
            @if($product->vedios ==null)
            <tr>
                @if($product->default_image)
                <td>{{ $product->title }}</td>

                <td>

                    <img src="{{ asset('uploads/product_images/'.$product->default_image) }}" style="width: 100px" class="img-thumbnail" alt="">


                </td>

                <td>


                    <div class="box-body">






                        <label class="container2">

                            <input onclick="slideshow()" {{$product->checked}} type="checkbox" class="messageCheckbox10" value="{{ $product->id }}">

                            <span style="background-color: #868383;" class="checkmark"></span>

                        </label>




                    </div><!-- end of box body -->

                </td>


                @endif
                @else
                @lang('site.imagepost')
                @endif
            </tr>

            @endforeach
        </tbody>

    </table><!-- end of table -->

    {{ $products->appends(request()->query())->links() }}

    @else

    <h2>@lang('site.no_data_found')</h2>

    @endif

</div><!-- end of box body -->
<script>
    function slideshow() {


        var ids = [];
        var unchecked = [];
        var rowcollection = $(".messageCheckbox10:checked");

        rowcollection.each(function(index, elem) {
            ids.push($(elem).val());
        });


        var rowcollection2 = $(".messageCheckbox10:not(:checked)")
        rowcollection2.each(function(index, elem) {
            unchecked.push($(elem).val());
        });



        data = {
            ids: ids,
            unchecked: unchecked,
            _token: "{{csrf_token()}}",
        };
        $.ajax({
            url: '{{URL::to("dashboard/slideshow") }}',
            type: 'get',
            dataType: 'html',
            data: data,
            success: function(response) {
                if (response == 'error') {


                    swal({
                        title: 'you reach to maximum post in slide show  if you want to add new post please remove any other post',
                            text: "",
                            type: "warning",
                            timer: 2000
                        },
                        function() {
                            location.reload();
                        });
                } else {
                    location.reload();
                }
            },
            error: function(response) {
                if (response == 'error') {


                    swal({
                            title: 'you reach to maximum post in slide show  if you want to add new post please remove any other post',
                            text: "",
                            type: "warning",
                            timer: 2000
                        },
                        function() {
                            location.reload();
                        });
                } else {
                    location.reload();
                }
            }


        });

    }
</script>