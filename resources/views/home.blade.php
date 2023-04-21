@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @isset($users)
            @foreach ($users as $user)
            <a href="{{route("admin.user", $user->id)}}" class="d-block p-3" style="width: 33.333%; text-decoration:none;">
                <div class="card" style="width: 100%;">
                    <img src="..." class="card-img-top" alt="..." style="min-width: 100%; min-height: 10rem;">
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
