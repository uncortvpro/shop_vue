@extends('layouts.admin_menu')
@section('content')
    <div class="m-3">
        <h2>{{$title_page}}</h2>
        <a href="/category/action" class="btn btn-primary mb-1"><b>Create</b></a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Parent category</th>
                <th scope="col">Product create</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="/category/show/{{$category->id}}">{{$category->title}}</a></td>
                    <td>{{$category->categoryParent['title']??'-'}}</td>
                    <td>{{$category->product_create==0?'-':'+'}}</td>
                    <td style="color: {{$category->status==1?"green":'red'}}">{{$category->status==1?"Active":'Not active'}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
