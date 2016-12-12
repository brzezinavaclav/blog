@extends('admin.layout')

@section('content')
    <h1>Create category</h1>
    <form method="post">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Name" name="title">
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="10" placeholder="Description" name="description"></textarea>
    </div>
    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-primary" value="Save">
    </div>
    </form>
@endsection
