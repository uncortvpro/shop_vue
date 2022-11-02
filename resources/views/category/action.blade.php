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
                <input type="text" placeholder="Enter title" name="title" class="form-control"
                       value="{{$edit_category->title??''}}">
            </div>
            <div class="form-group">
                <label>Choose parent category</label>
                <select class="form-control select2" style="width: 100%;" name="parent_category_id">
                    <option selected="selected" value="0">No parent category</option>
                    @foreach($categories as $category)
                        <option
                            {{$edit_category->parent_category_id??''==$category->id?'selected':''}}  value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_product_create"
                       {{$edit_category->product_create??''==1?'checked':''}} name="product_create">
                <label class="form-check-label">Add products</label>
            </div>
            <div style="display: {{$edit_category->product_create??''==1?'block':'none'}}" id="div_charact_brands">
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <h2>Brands</h2>
                        <div class="form-group">
                            <div id="div_brands">
                                @if(isset($edit_category) && $edit_category->product_create==1)
                                    @foreach($edit_category->categoryBrands as $brand)
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input class="form-control mt-1 mb-1" name="brands[]"
                                                       placeholder="Enter brand" value="{{$brand->title}}">
                                            </div>
                                            <div class="col-sm-2" style="font-size: 30px; color:red" id="delete_button">
                                                <b class="delete_block">X</b>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="btn btn-warning" id="btn_add_brand" type="button">Add brands</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>Characteristics</h2>
                        <div class="form-group">
                            <div id="div_charact">
                                @if(isset($edit_category) && $edit_category->product_create==1)
                                    @foreach($edit_category->categoryCharacteristics as $charact)
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <input class="form-control mt-1 mb-1" name="characteristics[]"
                                                       placeholder="Enter characteristic" value="{{$charact->title}}">
                                            </div>
                                            <div class="col-sm-2" style="font-size: 30px; color:red" id="delete_button">
                                                <b class="delete_block">X</b>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button class="btn btn-info" id="btn_add_charact" type="button">Add characteristics</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="status" {{$edit_category->status??'1'==1?'checked':''}} >
                <label class="form-check-label">Status</label>
            </div>

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">{{$button_form}}</button>
            </div>

        </form>
    </div>



    <script>
        $("#checkbox_product_create").on("click", function () {
            if ($(this).is(":checked")) {
                document.getElementById('div_charact_brands').style.display = 'block';
            } else {
                document.getElementById('div_charact_brands').style.display = 'none';
            }
        })

        $('#btn_add_charact').on('click', function () {
            $('#div_charact').append(
                '<div class="row">'+
                    '<div class="col-sm-10">' +
                        '<input class="form-control mt-1 mb-1" name="characteristics[]" placeholder="Enter characteristic">' +
                    '</div>' +
                    '<div class="col-sm-2" style="font-size: 30px; color:red" id="delete_button">'+
                        '<b class="delete_block">X</b>'+
                    '</div>' +
                '</div>'

            );
        })
        $('#btn_add_brand').on('click', function () {
            $('#div_brands').append(
                '<div class="row">'+
                    '<div class="col-sm-10">' +
                        '<input class="form-control mt-1 mb-1" name="brands[]" placeholder="Enter brand">' +
                '</div>' +
                '   <div class="col-sm-2" style="font-size: 30px; color:red" id="delete_button">'+
                '       <b class="delete_block">X</b>'+
                    '</div>' +
                '</div>'
            );
        })

        $(document).on('click', '.delete_block', function (){
            $(this).parent().parent().remove();
        });

    </script>
@endsection
