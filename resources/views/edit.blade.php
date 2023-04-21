@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1>Edit user</h1>
    </div>
    <form action="{{route('admin.update', $user->id)}}" method="POST" class="col-md-12">
      @csrf
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailError" value="{{$user->email}}">
        <div id="emailError" class="form-text text-danger">@error('email'){{$message}}@enderror</div>
      </div>
      <div class="mb-3">
          <label for="exampleInputName1" class="form-label">Name</label>
          <input type="name" name="name" class="form-control" id="exampleInputName1" aria-describedby="nameError" value="{{$user->name}}">
          <div id="nameError" class="form-text text-danger">@error('name'){{$message}}@enderror</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" aria-describedby="passwordError" value="">
        <div id="passwordError" class="form-text text-danger">@error('password'){{$message}}@enderror</div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if (session('message'))
    <div class="alert alert-success my-3 col-md-12" role="alert">
      <h4 class="alert-heading">{{session('message')}}</h4>
    </div>
    @endif
  </div>
</div>
@endsection