// image preview
$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});


$(".image1").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image1-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});



$(".image2").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image2-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});


$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image3-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});

let id=1;
$(".image"+id).change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image'+id+'-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});