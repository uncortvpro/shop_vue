@extends('layouts.admin_menu')
@section('content')


    <div class="m-3">
        <h2>{{$title_page}}</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form action="{{$form_href}}" method="POST" class="m-2">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" placeholder="Enter title" required name="title" class="form-control"
                       value="{{$edit_product->title??''}}">
            </div>
            <div class="form-group">
                <label>Choose category</label>
                <select class="js-selectize" id="parent_category_id" required style="width: 100%;" name="category_id" required>
                    <option selected="selected" disabled>Choose category</option>
                    @foreach($categories as $category)
                        <option
                            {{$product->category_id??''==$category->id?'selected':''}} id="option_category" value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check ml-1" id="variation_div_checkbox" style="@if($id??0==0) display:none @endif">
                <input class="form-check-input" type="checkbox"
                       name="status" id="variation_checkbox">

                <label class="form-check-label" >Variations</label>
            </div>

            <div id="variations_buttons_div" class="mt-2 variation_group" style="display: none">

            </div>
            <div id="variations_inputs_div" class="variation_group" style="display: none">

            </div>
            <input type="text" id="variation_input" name="variation_id" style="display: none">
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" placeholder="Enter description" name="description" class="form-control"
                          required>{{$edit_product->title??''}}</textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" placeholder="Enter price" name="price" class="form-control"
                       value="{{$edit_product->price??''}}" required>
            </div>
            <div class="form-group">
                <label>Count</label>
                <input type="number" placeholder="Enter count" name="count" class="form-control"
                       value="{{$edit_product->count??''}}" required>
            </div>


            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="status" {{$edit_product->status??'1'==1?'checked':''}} >
                <label class="form-check-label">Status</label>
            </div>

            <div class="form-group mt-2">
                <button type="submit" id="btn1" class="btn btn-primary">{{$button_form}}</button>
            </div>

        </form>
    </div>

    <script>
        $("#variation_checkbox").on("click", function () {
            if ($(this).is(":checked")) {
                $('.variation_group').attr('style','display:block');
            } else {
                $('.variation_group').attr('style','display:none');            }
        })
        $(document).on('click', '.delete_variation', function (){
            $(this).parent().remove();
            var count = $('.block_variation_div').length

            if(count == 0){
                $( ".variation_btn" ).each(function( index ) {
                    $(this).attr("disabled", false );
                });
            }


        });
        $(document).on('click','.variation_btn', function(){
            $( ".variation_btn" ).each(function( index ) {
                $(this).attr("disabled", true );

            });
            $('#variation_input').val($(this).attr('data-id'));
            $(this).attr("disabled", false );

            $('#variations_inputs_div').append(
                '<div class="form-inline block_variation_div">' +
                '<div class="form-group mx-sm-8 mb-2 mt-2">' +
                '<input class="form-control    " name="variation[]" placeholder="Enter '+$(this).attr("value")+'" required></div>' +
                '<button style=" font-size: 16px;" class="btn delete_variation btn-danger ml-2" ><b>X</b></button>' +
                '</div>' )
        })
        $(document).on('change', '#parent_category_id', function () {
            var val = $(this).val();
            $.ajax({
                type:"get",
                url: '/category/variation/get/'+val+'/0',
                cache: false,
                contentType:false,
                processData:false,
                success: function (result){
                    document.getElementById('variations_buttons_div').innerHTML = result;

                    document.getElementById('variation_div_checkbox').style.display = 'block';

                },
                error: function (data){
                    console.log('error');
                    console.log(data);
                }
            });

        });


    </script>

@endsection
