@extends('admin.layout')

@section('content')
    <h1>Categories</h1>
    <a href="category/create">Create new</a>
    <table class="table table-condensed table-hover">
        <tr><th>Title</th><th>Created at</th><th>Posts</th><th>Actions</th></tr>
        @foreach($categories as $category)
            <tr>
                <td><a href="{{URL::to('/admin/category/edit/' . $category->id)}}">{{$category->title}}</a></td>
                <td><i class="glyphicon glyphicon-time"></i> {{$category->created_at}}</td>
                <td>{{$category->posts()->count()}}</td>
                <td><a href="{{URL::to('/admin/category/delete/' . $category->id)}}"><i class="glyphicon glyphicon-trash"></i></a><a href="{{URL::to('/admin/category/edit/' . $category->id)}}"><i class="glyphicon glyphicon-pencil"></i></a><a href="{{URL::to('/category/' . $category->slug)}}"><i class="glyphicon glyphicon-eye-open"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection