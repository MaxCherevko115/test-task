@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>My profile</h1>
        </div>
        <hr>
        <img class="col-md-4" src="{{$user->img}}" alt="" height="340">
        <div class="col-md-8">
            <div class="row">
                <h2>Name: {{$user->name}}</h2>
                <h3>Role: {{$user->role}}</h3>
                <h4>Email: {{$user->email}}</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="{{route('admin.edit', $user->id)}}" type="button" class="btn btn-primary d-block">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection