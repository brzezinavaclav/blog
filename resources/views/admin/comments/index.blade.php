@extends('admin.layout')

@section('content')
    <h1>Comments</h1>
    <table class="table table-condensed">
        <tr><th>Excerpt</th><th>Post</th><th>Created at</th><th>Actions</th></tr>
    @foreach($comments as $comment)
        <tr>
            <td>{{$comment->content}}</td>
            <td><a href="/{{$comment->post->slug}}">{{$comment->post->title}}</a></td>
            <td><i class="glyphicon glyphicon-time"></i> {{$comment->created_at}}</td>
            <td><a href="#"><i class="glyphicon glyphicon-trash"></i></a><a href="#"><i class="glyphicon glyphicon-pencil"></i></a><a href="#"><i class="glyphicon glyphicon-eye-open"></i></a></td>
        </tr>
    @endforeach
    </table>
@endsection