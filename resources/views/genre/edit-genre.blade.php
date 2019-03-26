@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 my-4">
        <h3 class="mb-5">Genre Detail</h3>
            <form class="form-horizontal" method="POST" action="/update-genre" enctype="multipart/form-data">
                {{ csrf_field() }}

            <input type="hidden" name="postid" value="{{$genreedit_id->id}}">
                <div class="form-group row">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" placeholder="Enter Genre Name" name="name" value="{{$genreedit_id->name}}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 control-label">Description</label>
                    <div class="col-md-8">
                        <textarea class="form-control" id="description" name="description" rows="3">{{$genreedit_id->description}}</textarea>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" value="update">
                            Update
                        </button>
                        <a class="btn btn-info" href="">Clear</a>
                    </div>
                </div>

            </form>
    </div>
</div>
  @endsection
