@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$post->title}}</h1>
                @if($post->type == 'post')
                    <h6><i class="glyphicon glyphicon-time"></i> <b>{{$post->created_at}}</b></h6>
                @endif
                <hr>
                {{$post->content}}
            </div>
        </div>
    </div>
@endsection