@extends('layouts.app')



@section('content')
<div class="container">
<div class="col-md-8 my-4">
    <h3 class="mb-5">Add Author</h3>
                
        @if (session('loginError'))
            <div class="alert alert-danger">
                {{ session('loginError') }}
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
            <form class="form-horizontal" method="POST" action="/add-author" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter Author Name" >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="history" class="col-md-4 control-label">History</label>
                                <div class="col-md-8">
                                <textarea class="form-control{{ $errors->has('history') ? ' is-invalid' : '' }}" id="history" name="history" rows="3">{{ old('history') }}</textarea>
                                @if ($errors->has('history'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('history') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 control-label">Description</label>
                                <div class="col-md-8">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" value="add">
                                    Add
                                </button>
                                <button type="submit" class="btn btn-primary" value="clear">
                                    Clear
                                </button>
                            </div>
                        </div>
                        
                    </form>
                
            </div>
        </div>
    </div>
@endsection
