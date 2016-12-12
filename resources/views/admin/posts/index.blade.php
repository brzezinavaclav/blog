@extends('admin.layout')
@section('content')
    <h1>{{$type == 'post' ? 'Posts' : 'Pages'}}</h1>
    @if (($type == 'post' && Auth::user()->can('create_posts', App\Post::class)) || $type == 'page' && Auth::user()->can('create_pages', App\Post::class))
        <a href="{{$type}}/create">Create new</a>
    @endif
    <table class="table table-condensed">
        <tr>
            <th>Title</th>
            <th>Created at</th>
            <th>Author</th>
            @if($type == 'post')
                <th>Categories</th><th>Comments</th>
            @endif
            <th>Actions</th>
        </tr>
        @foreach($posts as $post)
        <tr>
            <td><a href="{{URL::to('/admin/post/edit/' . $post->id)}}">{{$post->title}}</a></td>
            <td><i class="glyphicon glyphicon-time"></i> {{$post->created_at}}</td>
            <td>{{$post->author}}</td>
            @if($type == 'post')
                <td>
                    @foreach($post->categories as $category)
                        @if($category != $post->categories()->first()),@endif {{$category->title}}
                    @endforeach
                </td>
                <td>{{$post->comments}}</td>
            @endif
            <td><a href="{{URL::to('/admin/post/delete/' . $post->id)}}"><i class="glyphicon glyphicon-trash"></i></a><a href="{{URL::to('/admin/post/edit/' . $post->id)}}"><i class="glyphicon glyphicon-pencil"></i></a><a href="{{URL::to('/' . $post->slug)}}"><i class="glyphicon glyphicon-eye-open"></i></a></td>
        </tr>
        @endforeach
    </table>
@endsection