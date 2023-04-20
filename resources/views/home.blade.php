@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @isset($users)
            @foreach ($users as $user)
            <a href="" class="card d-block" style="width: 33.333%; text-decoration:none;">
                <img src="..." class="card-img-top" alt="..." style="min-width: 100%; min-height: 5rem;">
                <div class="card-body row gap-1">
                  <h4 class="card-title">{{$user->name}}</h4>
                  <h5 class="card-title">{{$user->role}}</h5>
                </div>
            </a>
            @endforeach
        @endisset
    </div>
</div>
@endsection
