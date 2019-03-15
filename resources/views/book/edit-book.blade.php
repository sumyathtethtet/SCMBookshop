@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 my-4">
        <h3 class="mb-5">Edit Book</h3>
                
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
                <form class="form-horizontal" method="POST" action="/update-book" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="postid" value="{{$bookedit_id->id}}">
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $bookedit_id->name }}" placeholder="Enter Book Name" >
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
                                <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $bookedit_id->price }}" placeholder="Enter book price" >
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
                                <option value="{{ $author->id }}" @if($author->id==$bookedit_id->author_id){{ 'selected' }} @endif>
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
                                    <option value="{{ $genre->id }}" @if($genre->id==$bookedit_id->genre_id){{ 'selected' }} @endif>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                              </select>
                            </label>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 control-label">Image</label>
                            
                            <div class="col-md-8">
                            
                                
                                    <img src="{{  $bookedit_id->image }}" width="50px" height="50px">
                                    <input type="hidden" name="oldImage" value="{{  $bookedit_id->image }}">
                        
                                    <input type="file" name="image" id="name" class="form-control-file" >
                                
                            </div>          
                        </div>

                        <div class="form-group row">
                            <label for="sample_pdf" class="col-md-4 control-label">Sample PDF</label>
                                <div class="col-md-8">
                                <input type="hidden" name="oldPDF" value="{{  $bookedit_id->sample_pdf }}">{{ $bookedit_id->sample_pdf }}
                                <input id="sample_pdf" type="file" class="form-control" name="sample_pdf" value="{{ $bookedit_id->sample_pdf }}">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="published_date" class="col-md-4 control-label">Published Date</label>
                                <div class="col-md-8">
                                <input id="published_date" type="date" class="form-control{{ $errors->has('published_date') ? ' is-invalid' : '' }}" name="published_date" value="{{ $bookedit_id->published_date }}">
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
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $bookedit_id->description }}</textarea>
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
