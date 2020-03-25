@extends('layouts.dashboard.app')
@section('content')
<h2>Setting</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
  <li class="breadcrumb-item active">Add Category</li>
  
  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.settings.store')}}" method="post">
        @csrf
        @include('dashboard.partials._errors')
      @php
          $social_sites=['facebook','google','youtube'];
      @endphp
      @foreach ($social_sites as $social_site)
            {{-- facebook client id --}}
        <div class="form-group">
          <label class="control-label text-capitalize">{{$social_site}} link</label>
        <input class="form-control" type="text" name="{{$social_site}}_link" value="{{setting($social_site.'_link')}}">
        </div>

      @endforeach

        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection