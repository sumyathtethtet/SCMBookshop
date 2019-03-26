@extends('layouts.app')

@section('content')

	<!-- Page Heading -->
  <div class="row" style="padding-left: 20px;">
    <div class="col-lg-10 col-sm-12">
      <h1 class="my-4"> <small> Book Detail </small>
      </h1>
    </div>

    <div class="col-lg-2 col-sm-12">
      <h1 class="my-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary pull-right">
          <i class="fas fa-backward"></i> Go Back
        </a>
      </h1>
    </div>

    <div class="col-md-12 col-sm-12">
			<div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12"> Book Name</label>
            <div class="col-md-8 col-sm-12">
						  <p>{{ $book_id->name }}</p>
				    </div>
        </div>
		  </div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12"> Price</label>
            <div class="col-md-8 col-sm-12">
						  <p> {{ $book_id->price }}</p>
					  </div>
				</div>
			</div>

      <div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12"> Author</label>

					<div class="col-md-8 col-sm-12">

						<p> {{ $book_id->author->name }}</p>

					</div>
				</div>
			</div>

      <div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12"> Genre </label>

					<div class="col-md-8 col-sm-12">

						<p> {{ $book_id->genre->name }}</p>

					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12">Image</label>

					<div class="col-md-8 col-sm-12">
						<img src="{{ $book_id->image }}" width="120px" height="150px">
					</div>
				</div>
			</div>

      <div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12">Sample PDF</label>

					<div class="col-md-8 col-sm-12">
          <a href="#">{{ $book_id->sample_pdf }}</a>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12"> Published Date </label>

					<div class="col-md-8 col-sm-12">

						<p> {{ $book_id->published_date }}</p>

					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label class="col-md-4 col-sm-12" style="padding-top: 19px;"> Detail Description</label>

					<div class="col-md-8 col-sm-12">
						<p> {!! $book_id->description !!}</p>
					</div>
				</div>
			</div>
  </div>
</div>
@endsection
