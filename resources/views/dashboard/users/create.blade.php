@extends('layouts.dashboard.app')
@section('content')
<h2>Create User</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
  <li class="breadcrumb-item active">Add User</li>

  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.users.store')}}" method="post">
        @csrf
        @include('dashboard.partials._errors')
        {{-- {{name}} --}}
        <div class="form-group">
          <label class="control-label">Name</label>
          <input class="form-control" type="text" name="name" placeholder="Enter user name">
        </div>

        <div class="form-group">
          <label class="control-label">Email</label>
          <input class="form-control" type="email" name="email" placeholder="Enter User email">
        </div>

        <div class="form-group">
          <label class="control-label">Password</label>
          <input class="form-control" type="password" name="password" placeholder="Enter User Password">
        </div>

        <div class="form-group">
          <label class="control-label">Password Confirmation</label>
          <input class="form-control" type="password" name="password_confirmation" placeholder="Enter User Password Confirmation">
        </div>
        {{-- Roles --}}
       <div class="form-group">
         <label for="Roles">Roles</label>
         <select name="role_id" class="form-control">
           @foreach ($roles as $role)
         <option value="{{$role->id}}">{{$role->name}}</option> 
           @endforeach
       
         </select>
       </div>
       


        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection