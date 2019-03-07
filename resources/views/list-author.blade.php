@extends('layouts.app')

@section('content')
<div class="container">
<h2>Author List</h2>
  <div class="row">
    <div class="col-md-4">
      <p>Name</p>
    </div>

    <div class="col-md-4">
      <form action="/list-author" method="POST" role="search">
        {{ csrf_field() }}

        <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Search users">
          <span class="input-group-btn"> 
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search">Search</span>
            </button>
          </span>
        </div>
    
      </form>
    </div>

    <div class="col-md-4">
      <div class="text-right">
        <a class="btn btn-info" href="/add-author"> Add</a>
      </div>
    </div>
  </div>
  
  <table id="table" class="table" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Author Name</th>
        <th>Author History</th>
        <th>Author Description</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
      <?php $i=1; ?>
      @if(isset($results))
        @foreach($results as $author)
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->history }}</td>
            <td>{{ $author->description }}</td>
            <td><a href="/edit-author/{{ $author->id }}">Edit</a></td>
            <td><a href="/delete-author/{{ $author->id }}">Delete</a></td>
          </tr>
        <?php $i++; ?>
        @endforeach
        <?php $i=1; ?>
      @elseif(isset($results)==null)
        @foreach($authors as $author)
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->history }}</td>
            <td>{{ $author->description }}</td>
            <td><a href="/edit-author/{{ $author->id }}">Edit</a></td>
            <td><a href="/delete-author/{{ $author->id }}">Delete</a></td>
          </tr>
        <?php $i++; ?>
        @endforeach
        
      @endif
      
    </tbody>
    <tfoot>
      
    </tfoot>
  </table>
  @if(isset($results))
  {{ $results->appends(Request::get('page'))->links()}}
  
  @elseif(isset($results)==null)
  {{ $authors->links() }}

  @endif
@endsection