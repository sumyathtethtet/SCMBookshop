@extends('layouts.app')

@section('content')
<div class="container">
<h2>Book List</h2>
  <div class="row">
    <div class="col-md-2">
      <p>Name</p>
    </div>
    <div class="col-md-8">
      <form action="/list-book" method="POST" role="search">
          {{ csrf_field() }}             
          
          <div class="row">
            <div class="col-md-3">
              <select name="author" >
                <option value="">Author</option>
                  @foreach($authors as $author)
                    <option value="{{ $author->id }}">
                      {{ $author->name }}
                    </option>
                  @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <select name="genre">
                <option value ="">Genre</option>
                  @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">
                      {{ $genre->name }}
                    </option>
                  @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <input type="text" class="form-control" name="search" placeholder="Search users">
            </div>

            <div class="col-md-3">
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search">Search</span>
              </button>
            </div>
          </div>
          
      </form>
    </div>

    <div class="col-md-2">
      <div class="text-right">
        <a class="btn btn-info" href="/add-book"> Add</a>
      </div>
    </div>
  </div>
  
  <table id="table" class="table" width="100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Book Name</th>
        <th>Author Name</th>
        <th>Genre Name</th>
        <th>Price</th>
        <th>Sample PDF</th>
        <th>Add To Cart</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php $i=1; ?>
      @if(isset($results))
        @foreach($results as $book)
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->genre->name }}</td>
            <td>{{ $book->price }}</td>
            <td><a href="#">{{ $book->sample_pdf }}</a></td>
            <td><a href="#">Add To cart</a></td>
            <td><a href="/edit-book/{{ $book->id }}">Edit</a></td>
            <td><a href="/delete-book/{{ $book->id }}">Delete</a></td>
          </tr>
        <?php $i++; ?>
        @endforeach
        <?php $i=1; ?>
      @elseif(isset($results)==null)
        @foreach($books as $book)
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->genre->name }}</td>
            <td>{{ $book->price }}</td>
            <td><a href="#">{{ $book->sample_pdf }}</a></td>
            <td><a href="#">Add To cart</a></td>
            <td><a href="/edit-book/{{ $book->id }}">Edit</a></td>
            <td><a href="/delete-book/{{ $book->id }}">Delete</a></td>
          </tr>
        <?php $i++; ?>
        @endforeach
       
        @endif
      
    </tbody>
    <tfoot>
      
    </tfoot>
  </table>
  
  @if(isset($results))
  {{ $results->appends($_GET)->links() }}
  
  @elseif(isset($results)==null)
  {{ $books->links() }}

  @endif


  
@endsection