@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>My profile</h1>
        </div>
        <hr>
        <img class="col-md-4" src="{{asset("storage/images/{$user->img}")}}" alt="" height="340">
        <div class="col-md-8">
            <div class="row">
                <h2>Name: {{$user->name}}</h2>
                <h3>Role: {{$user->role}}</h3>
                <h4>Email: {{$user->email}}</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{route('admin.profile.edit')}}" type="button" class="btn btn-primary d-block">Edit</a>
                    @else
                        <a href="{{route('profile.edit')}}" type="button" class="btn btn-primary d-block">Edit</a>
                    @endif
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success my-3" role="alert">
                <h4 class="alert-heading">{{session('message')}}</h4>
            </div>
        @endif
    </div>
</div>
@endsection