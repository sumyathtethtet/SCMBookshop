@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-4">
<p>Name</p>
</div>
<div class="col-md-4">
<p>Search</p>
</div>
<div>
<a class="btn btn-info" href="/add-author"> Add</a>
</div>
</div>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
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
</tbody>
<tfoot>
  <tr>
    <th>Name
    </th>
    <th>Position
    </th>
    <th>Office
    </th>
    <th>Age
    </th>
    <th>Start date
    </th>
    <th>Salary
    </th>
  </tr>
</tfoot>
</table>
@endsection