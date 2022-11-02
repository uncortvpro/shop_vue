@extends('layouts.admin_menu')
@section('content')
    <div class="m-3">
        <h2>{{$title_page}}</h2>
        <a href="/product/action" class="btn btn-primary mb-1"><b>Create</b></a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><a href="/category/show/{{$product->id}}">{{$product->title}}</a></td>
                    <td>{{$product->category['title']??'-'}}</td>
                    <td style="color: {{$product->status==1?"green":'red'}}">{{$product->status==1?"Active":'Not active'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
