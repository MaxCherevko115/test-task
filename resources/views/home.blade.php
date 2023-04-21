@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">{{session('message')}}</h4>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h1>All users</h1>
        </div>
        <hr>
        @isset($users)
            @foreach ($users as $user)
            <a href="{{route("admin.user", $user->id)}}" class="d-block p-3" style="width: 33.333%; text-decoration:none;">
                <div class="card" style="width: 100%;">
                    <img src="{{$user->img}}" class="card-img-top" height="340" alt="" style="min-width: 100%; min-height: 10rem;">
                    <div class="card-body row">
                        <h4 class="card-title">{{$user->name}}</h4>
                        <h5 class="card-title">{{$user->role}}</h5>
                    </div>
                </div>
            </a>
            @endforeach
        @endisset
    </div>
</div>
@endsection
