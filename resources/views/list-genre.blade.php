@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Genre List</h2>
    <div class="row">
      <div class="col-md-4">
        <p>Name</p>
      </div>

      <div class="col-md-4">
        <form action="/list-genre" method="POST" role="search">
          {{ csrf_field() }}

          <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search genres">
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
          <a class="btn btn-info" href="/add-genre"> Add</a>
        </div>
      </div>
    </div>

    <table id="table" class="table" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Genre Name</th>
          <th>Genre Description</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>

      <tbody>
        <?php $i = 1;?>
        @if(isset($results))
          @foreach($results as $genre)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $genre->name }}</td>
              <td>{{ $genre->description }}</td>
              <td><a href="/edit-genre/{{ $genre->id }}">Edit</a></td>
              <td><a href="/delete-genre/{{ $genre->id }}">Delete</a></td>
            </tr>
          <?php $i++;?>
          @endforeach

          <?php $i = 1;?>
        @elseif(isset($results)==null)
          @foreach($genres as $genre)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $genre->name }}</td>
              <td>{{ $genre->description }}</td>
              <td><a href="/edit-genre/{{ $genre->id }}">Edit</a></td>
              <td><a href="/delete-genre/{{ $genre->id }}"  id="btnDeleteProduct" id="id">Delete</a></td>
            </tr>
          <?php $i++;?>
          @endforeach

        @endif

      </tbody>
      <tfoot>

      </tfoot>
    </table>
    @if(isset($results))
    {{ $results->appends(Request::get('page'))->links()}}

    @elseif(isset($results)==null)
    {{ $genres->links() }}

    @endif
@endsection
