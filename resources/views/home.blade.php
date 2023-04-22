@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success my-3" role="alert">
                    <h4 class="alert-heading">{{session('message')}}</h4>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h1>All users</h1>
                </div>
            </div>
            <hr>
            <div class="col-md-8 mx-auto">
                <div class="row">
                    @isset($users)
                        @foreach ($users as $user)
                        @if (Auth::user()->role == 'admin')
                            <a href="{{route("admin.user", $user->id)}}" class="d-block p-3" style="width: 33.333%; text-decoration:none;">
                        @else
                            <a href="{{route("user", $user->id)}}" class="d-block p-3" style="width: 33.333%; text-decoration:none;">
                        @endif
                                <div class="card" style="width: 100%;">
                                    <img src="{{asset("storage/images/{$user->img}")}}" class="card-img-top" height="200" alt="{{$user->img}}" style="min-width: 100%; min-height: 10rem;">
                                    <div class="card-body row">
                                        <h4 class="card-title">{{$user->name}}</h4>
                                        <h5 class="card-title">{{$user->role}}</h5>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="row">{{$users->links()}}</div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
