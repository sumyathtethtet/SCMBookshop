@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('message'))
  <p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<h2>Book List</h2>
  <div class="row">
    <div class="col-md-6">
      <form action="/search-book" method="POST" role="search">
          {{ csrf_field() }}             
          
          <div class="row">

          <div class="col-md-3">
              <input type="text" class="form-control" name="search" placeholder="Name">
            </div>

            <div class="col-md-3">
              <select class="form-control" name="author" >
                <option value="">Author</option>
                  @foreach($authors as $author)
                    <option value="{{ $author->id }}">
                      {{ $author->name }}
                    </option>
                  @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <select class="form-control" name="genre">
                <option value ="">Genre</option>
                  @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">
                      {{ $genre->name }}
                    </option>
                  @endforeach
              </select>
            </div>

            

            <div class="col-md-2">
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search">Search</span>
              </button>
            </div>
          </div>
          
      </form>
    </div>

    <div class="col-md-1">
      <div class="text-right">
        <a class="btn btn-info" href="/add-book"> Add</a>
      </div>
    </div>
 

  <div class="col-md-4">
  <form action="/import" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="row">
      <div class=" form-control col-lg-7">
          <input id="file" type="file" name="file">
          </div>
      <div class="col-lg-5">
          <button class="btn btn-primary" type="submit">Import</button>
      </div>
    </div>
  </form>
  </div>


  <div class="col-md-1">
      <div class="text-right">
        <a class="btn btn-info" href="/download-excel"> Download</a>
      </div>
    </div>
  </div>
  
  <table class="table" style="width:90%; margin:0 auto; margin-top:10px;" >
    <thead>
        <th>No</th>
        <th>Book Name</th>
        <th>Author Name</th>
        <th>Genre Name</th>
        <th>Price</th>
        <th>Sample PDF</th>

        @if(auth()->user()->type==1)
          <th>Add To Cart</th>

        @else
          <th>Edit</th>
          <th>Delete</th>
        @endif

      </tr>
    </thead>

    <tbody>
      <?php $i=1; ?>
      @if(isset($results))
        @foreach($results as $book)
          <tr id="tr_{{$book->id}}">
            <td>{{ $i }}</td>
            <td><a href="/detail-book/{{ $book->id }}">{{ $book->name }}</a></td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->genre->name }}</td>
            <td>{{ $book->price }}</td>
            <td><a href="#">{{ $book->sample_pdf }}</a></td>

            @if(auth()->user()->type==1)
              <td><a href="#">Add To cart</a></td>

            @else
              <td><a href="/edit-book/{{ $book->id }}">Edit</a></td>
              <td><a href="/delete-book/{{ $book->id }}" class="btn btn-danger btn-sm"data-tr="tr_{{$book->id}}"

                           data-toggle="confirmation"

                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"

                           data-btn-ok-class="btn btn-sm btn-danger"

                           data-btn-cancel-label="Cancel"

                           data-btn-cancel-icon="fa fa-chevron-circle-left"

                           data-btn-cancel-class="btn btn-sm btn-default"

                           data-title="Are you sure you want to delete ?"

                           data-placement="left" data-singleton="true">Delete</a></td>
            @endif

          </tr>
        <?php $i++; ?>
        @endforeach
        <?php $i=1; ?>
      @elseif(isset($results)==null)
        @foreach($books as $book)
          <tr id="tr_{{$book->id}}">
            <td>{{ $i }}</td>
            <td><a href="/detail-book/{{ $book->id }}">{{ $book->name }}</a></td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->genre->name }}</td>
            <td>{{ $book->price }}</td>
            <td><a href="#">{{ $book->sample_pdf }}</a></td>

            @if(auth()->user()->type==1)
              <td><a href="#">Add To cart</a></td> 

            @else
              <td><a href="/edit-book/{{ $book->id }}">Edit</a></td>
              <td><a href="/delete-book/{{$book->id}}" id="btnDeleteProduct" id="id">delete</a></td>
            @endif

          </tr>
        <?php $i++; ?>
        @endforeach
       
        @endif
      
    </tbody>
    <tfoot>
      
    </tfoot>
  </table>
  
  @if(isset($results))
 
  {{ $results->links() }}
  
  @elseif(isset($results)==null)
  {{ $books->links() }}

  @endif


  
@endsection