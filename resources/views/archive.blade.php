@extends('layout')

@section('content')
    <div class="container">
        <h1>Posts from: {{date("Y",strtotime($posts->first()->created_at)) . '/' . date("m",strtotime($posts->first()->created_at))}}</h1>
        <hr>
        @foreach($posts as $post)
            <div class="row">
                <div class="col-md-12">
                    <h3><a href="{{URL::to('/' . $post->slug)}}">{{$post->title}}</a></h3>
                    <h6><i class="glyphicon glyphicon-time"></i> {{$post->created_at}}</h6>
                    {{$post->content}}
                </div>
            </div>
        @endforeach
    </div>
@endsection