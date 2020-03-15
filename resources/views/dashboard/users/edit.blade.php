@extends('layouts.dashboard.app')
@section('content')
<h2>Edit Role</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.roles.index')}}">roles</a></li>
  <li class="breadcrumb-item active">Edit Users</li>
  
  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.users.update',$user->id)}}" method="post">
        @csrf
        @method('put')
        @include('dashboard.partials._errors')

              {{-- {{name}} --}}
        <div class="form-group">
          <label class="control-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="Enter user name">
        </div>

        <div class="form-group">
          <label class="control-label">Email</label>
        <input class="form-control" type="email" name="email" value="{{$user->email}}" placeholder="Enter User email">
        </div>

        {{-- Roles --}}
       <div class="form-group">
         <label for="Roles">Roles</label>
         <select name="role_id" class="form-control">
           @foreach ($roles as $role)
         <option value="{{$role->id}}" {{$user->hasRole($role->name)?'selected':''}}>{{$role->name}}</option> 
           @endforeach
       
         </select>
       </div>
       

      
        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection