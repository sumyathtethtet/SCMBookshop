@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 my-4">
        <h3 class="mb-5">Add Book</h3>

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
                <form class="form-horizontal" method="POST" action="/add-book" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Enter Book Name" >
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-8">
                                <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" placeholder="Enter book price" >
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="author" class="col-md-4 control-label">Author</label>
                            <label class="col-md-8">
                              <select name="author" >
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}" selected>
                                    {{ $author->name }}
                                </option>
                                @endforeach
                              </select>
                            </label>
                        </div>

                        <div class="form-group row">
                          <label for="genre" class="col-md-4 control-label">Genre</label>
                            <label class="col-md-8">
                              <select name="genre" >
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" selected>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                              </select>
                            </label>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 control-label">Image</label>
                                <div class="col-md-8">
                                <input id="image" type="file" class="form-control" name="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sample_pdf" class="col-md-4 control-label">Sample PDF</label>
                                <div class="col-md-8">
                                <input id="sample_pdf" type="file" class="form-control{{ $errors->has('sample_pdf') ? ' is-invalid' : '' }}" name="sample_pdf">
                                @if ($errors->has('sample_pdf'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sample_pdf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="published_date" class="col-md-4 control-label">Published Date</label>
                                <div class="col-md-8">
                                <input id="published_date" type="date" class="form-control{{ $errors->has('published_date') ? ' is-invalid' : '' }}" name="published_date" value="published_date">
                                @if ($errors->has('published_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('published_date') }}</strong>
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
                                <a class="btn btn-info" href="/add-author">Clear</a>
                            </div>
                        </div>
                </form>
    </div>
</div>
@endsection
