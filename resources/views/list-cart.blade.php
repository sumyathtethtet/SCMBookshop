@extends('layouts.app')

@section('content')
<div class="container">

<h2>Cart List</h2>          
<form method="post" action="/confirm-cart">
    {{csrf_field()}}
                
    <table class="table">
            <tr>
                <th>Image</th>
                <th>Book Name</th>
                <th>Price</th>
                <th>SamplePDF</th>
                <th>Quantity</th>
                <th>Remove</th>
                <th><a href="/clear-cart">Clear Cart</a></th>
            </tr>
            @if(count($book) > 0)
            @foreach($book as $b)
               {{ count($b)}}
                @if(count($b) > 0)
                <tr>
                    <td>{{isset($b->image) ? $b->image : ''}}</td>
                    <td>{{isset($b->name) ? $b->name: '' }}</td>
                    <td>{{isset($b->price) ? $b->price: ''}}</td>
                    <td>{{isset($b->sample_pdf) ? $b->sample_pdf: '' }}</td>
                    <td><div class="form-group"><input type="text" name="quantity[{{ $b->id }}]" id="quantity"></div</td>
                    <td><a href="/remove-cart/{{ isset($b->id) ? $b->id: ''}}" class="btn btn-primary">Remove</a></td>
                </tr>
                @endif
            @endforeach
        @endif
        </table>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
                            
</form>
                       
</div>

@endsection