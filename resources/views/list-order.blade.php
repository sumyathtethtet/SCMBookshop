@extends('layouts.app')

@section('content')

<div class="container">

<h2>Book List Order</h2>
<div class= "row">
<table class="table mb-5" style="width:70%; margin:0 auto; margin-top:10px; border-bottom: 1px solid #dee2e6;" >
    <thead>
        <th>Book Name</th>
        <th>Price</th>
        <th>Quantity</th>
    <thead>
    <tbody>
    @php($total = 0)
    @if(count($book) > 0)
    @foreach($book as $b)
       {{ count($b)}}
        @if(count($b) > 0)
        <tr>
          <td>{{isset($b->name) ? $b->name: '' }}</td>
          <td>{{isset($b->price) ? $b->price: ''}}</td>
          <td>{{isset($b->quantity) ? $b->quantity: ''}}</td>
          @php($total += ($b->price * $b->quantity))
        </tr>
        @endif
    @endforeach
    @endif
    </tbody>
    <tfoot>
      <tr>
          <td></td>
          <td>Total</td>
          <td>{{ $total }}</td>
      </tr>
    </tfoot>
  </table>
</div>
<div class="row">  
    <div class="col-md-2 offset-md-3">
      <a href="/confirm-book" class="btn btn-primary">Confirm</a>
    </div>
    <div class="col-md-2">
      <a href="/list-cart" class="btn btn-primary">Back</a>
    </div>
  </div>
@endsection