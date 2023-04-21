@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>My profile</h1>
        </div>
        <hr>
        <div class="col-md-4">
            <img src="" alt="">
        </div>
        <div class="col-md-8">
            <div class="row">
                <h2>Name: {{$user->name}}</h2>
                <h3>Role: {{$user->role}}</h3>
                <h4>Email: {{$user->email}}</h4>
            </div>
            @if (Auth::user()->role == 'admin')
            <div class="row">
                <div class="col-md-4">
                    <a href="{{route('admin.edit', $user->id)}}" type="button" class="btn btn-primary d-block">Edit</a>
                </div>
                @if ($user->role !== 'admin')
                <div class="col-md-4">
                    <a href="{{route('admin.role', $user->id)}}" type="button" class="btn btn-secondary d-block">Make admin</a>
                </div>
                @endif
                <div class="col-md-4">
                    <a href="{{route('admin.delete', $user->id)}}" type="button" class="btn btn-danger d-block">Delete</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection