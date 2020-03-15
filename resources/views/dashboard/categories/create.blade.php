@extends('layouts.dashboard.app')
@section('content')
<h2>Create Category</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
  <li class="breadcrumb-item active">Add Category</li>



  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.categories.store')}}" method="post">
        @csrf
        @include('dashboard.partials._errors')
        <div class="form-group">
          <label class="control-label">Name</label>
          <input class="form-control" type="text" name="name" placeholder="Enter category name">
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection