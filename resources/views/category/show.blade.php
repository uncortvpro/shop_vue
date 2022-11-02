@extends('layouts.admin_menu')
@section('content')
    <div class="m-3">
        <h2>{{$title_page}}</h2>
        <div class="row mb-1">
            <a href="/category/action/{{$category->id}}" class="btn btn-warning col-sm-2 mr-2">Edit</a>
            <a href="/category/delete/{{$category->id}}" class="btn btn-danger col-sm-2">Delete</a>
        </div>
        <table class="table">

            <tbody>
            <tr>
                <td>Id</td>
                <td>{{$category->id}}</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>{{$category->title}}</td>
            </tr>
            <tr>
                <td>Parent category</td>
                <td>
                    @if(isset($category->categoryParent['id']))
                        <a href="/category/show/{{$category->categoryParent['id']??''}}">
                            {{$category->categoryParent['title']??'-'}}
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <td>Add products</td>
                <td style="color: {{$category->product_create == 1? "green" : 'red' }}">
                    {{$category->product_create == 1? "Active" : 'Not active' }}
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td style="color: {{$category->status == 1? "green" : 'red' }}">
                    {{$category->status == 1? "Active" : 'Not active' }}
                </td>
            </tr>
            <tr>
                <td>Date of create</td>
                <td>
                    {{$category->created_at}}
                </td>
            </tr>
            <tr>
                <td>Date of update</td>
                <td>
                    {{$category->updated_at}}
                </td>
            </tr>

            </tbody>
        </table>
        @if($category->product_create > 0)
            <h2>Variations</h2>

            <div class="col-sm-12">
                <div class="row">
                    @foreach($category->categoryBrands as $brand)
                    @endforeach
                    <form action="/category/variation/add/{{$category->id}}/0" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-sm-5">
                                <input type="text" class="form-control " placeholder="Title variation" name="title">
                            </div>
                            <div class="col-sm-3 pl-2">
                                <input type="text" class="form-control " placeholder="Template" name="template">
                            </div>
                            <div class="col-sm-4 pl-2">
                                <input type="submit" class="btn btn-primary " value="Add">
                            </div>
                        </div>
                    </form>
                    @include('category.templates.variation_list')
                </div>
            </div>
        @endif
        @if($category->product_create == 1)
            <div class="row">
                <div class="col-sm-6">
                    <h2>Brands</h2>
                    <form action="/category/brand/add/{{$category->id}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Title of brand" name="title">
                            </div>
                            <div class="col-sm-3">
                                <button class="btn-primary btn">Add</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        @foreach($category->categoryBrands as $brand)
                            <span style="">{{$brand->title}}
                                <a href="" data-bs-toggle="modal" data-bs-target="#updateBrandModal">Update</a> |
                                <a href="/category/brand/delete/{{$category->id}}/{{$brand->id}}">Delete</a></span>
                            <br>
                            <div class="modal" id="updateBrandModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/category/brand/update/{{$category->id}}/{{$brand->id}}"
                                              method="post">
                                        @csrf
                                        <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update brand</h4>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <input type="text" class="form-control" name="title"
                                                       value="{{$brand->title}}" placeholder="Title of brand" required>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button class="btn btn-success" type="submit">Update</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <h2>Characteristics</h2>
                    <form action="/category/characteristic/add/{{$category->id}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Title of characteristic" name="title">
                            </div>
                            <div class="col-sm-3">
                                <button class="btn-primary btn">Add</button>
                            </div>
                        </div>
                    </form>
                    @foreach($category->categoryCharacteristics as $charact)
                        <span style="line-height: 7px">{{$charact->title}}
                            <a href="" data-bs-toggle="modal" data-bs-target="#updateCharacteristicModal">Update</a> |
                            <a href="/category/characteristic/delete/{{$category->id}}/{{$charact->id}}">Delete</a></span>
                        <br>
                        <!-- The Modal -->
                        <div class="modal" id="updateCharacteristicModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/category/characteristic/update/{{$category->id}}/{{$charact->id}}"
                                          method="post">
                                    @csrf
                                    <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update characteristic</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <input type="text" class="form-control" name="title"
                                                   value="{{$charact->title}}" placeholder="Title of characteristic"
                                                   required>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit">Update</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        @endif
    </div>
    <!-- The Modal -->
    <div class="modal" id="updateVariationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/category/variation/update/" id="form_action_update" method="post">
                @csrf
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update variation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text" id="title_modal_input_update" class="form-control" name="title"  placeholder="Title of variation">
                        <input type="text" id="template_modal_input_update"  class="form-control mt-2" name="template"  placeholder="Template">

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="addVariationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/category/variation/add/" id="form_action_create" method="post">
                @csrf
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create subvariation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text"  class="form-control" name="title" placeholder="Title of variation">
                        <input type="text" class="form-control mt-2" name="template" placeholder="Template">

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Create</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click','#link_to_modal_create', function (e) {
                e.preventDefault()
                $('#form_action_create').attr('action', '/category/variation/add/'+$(this).data('category-id')+'/'+$(this).data('variation-id'));
            })
            $(document).on('click','#link_to_modal_update', function (e) {
                e.preventDefault()
                $('#form_action_update').attr('action', '/category/variation/update/'+$(this).data('category-id')+'/'+$(this).data('variation-id'));

                $.ajax({
                    type:"get",
                    url: '/category/variation/first/'+$(this).data('variation-id'),
                    cache: false,
                    contentType:false,
                    processData:false,
                    success: function (result){
                        $('#title_modal_input_update').val(result['title'])
                        $('#template_modal_input_update').val(result['template'])
                    },
                error: function (data){
                    console.log('error');
                    console.log(data);
                }
                })
            })
        })
    </script>
@endsection
