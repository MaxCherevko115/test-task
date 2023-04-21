@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="" alt="">
        </div>
        <div class="col-md-8">
            <h2>Name: {{$user->name}}</h2>
            <h3>Role: {{$user->role}}</h3>
            <h4>Email: {{$user->email}}</h4>
            @if (Auth::user()->role == 'admin')
            <div class="buttons">
                <a href="" type="button" class="btn btn-primary">Edit</a>
                <a href="" type="button" class="btn btn-secondary">Make admin</a>
                <a href="{{route('admin.delete', $user->id)}}" type="button" class="btn btn-danger">Delete</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection