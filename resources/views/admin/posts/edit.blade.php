@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Edit {{$type}}</h1>
            @if(isset($message))
                <div class="alert alert-{{$message['type']}} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{$message['content']}}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <form method="post">
            <div class="col-md-10">
                <div class="form-group">
                    <input name="title" type="text" class="form-control" placeholder="Name" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="10" placeholder="Content">{{$post->content}}</textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
            <div class="col-md-2">
                @if($type == 'post')
                    <fieldset>
                        <legend>Comments</legend>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="comments" value="{{$post->comments}}" checked> Allow comments
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Categories</legend>
                        @foreach($categories as $category)
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="category[]" value="{{$category->id}}"
                                               @foreach($post->categories as $post_category)
                                               @if($post_category->id == $category->id)
                                               checked
                                                @endif
                                                @endforeach
                                        > {{$category->title}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>
                @endif
            </div>
        </form>
    </div>
@endsection
