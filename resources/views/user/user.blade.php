@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>User List</h2>
                     @if(isset($userList))
                     @if(sizeof($userList) > 0)
                      @foreach($userList as $user)
                      <ul>
                          <li> {{ $user->name }}</li>
                          <li> {{ $user->email }} </li>
                      </ul>
                       @endforeach
                     @endif
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
