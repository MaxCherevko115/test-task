@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>User: {{$user->name}}</h1>
        </div>
        <hr>
        @if (session('message'))
            <div class="alert alert-success my-3" role="alert">
                <h4 class="alert-heading">{{session('message')}}</h4>
            </div>
        @endisset
        <img class="col-md-4" src="{{asset("storage/images/{$user->img}")}}" alt="" height="340">
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