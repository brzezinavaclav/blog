@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Create {{$type}}</h1>
        </div>
    </div>
    <div class="row">
        <form method="post">
            <div class="col-md-10">
                    <div class="form-group">
                        <input name="title" type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="10" placeholder="Content"></textarea>
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
                                    <input type="checkbox" name="comments" value="1" checked> Allow comments
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
                                        <input type="checkbox" name="category[]" value="{{$category->id}}"> {{$category->title}}
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
