@extends('layouts.dashboard.app')
@section('content')
<h2>Edit Movie</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.movies.index')}}">movies</a></li>
  <li class="breadcrumb-item active">Edit Movie</li>
  
  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">      
        <div class="tile">
          <div class="tile-body">
            <form id="movie_properties" action="{{route('dashboard.movies.update',['movie'=>$movie->id,'type'=>'update'])}}" method="post"
               enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  @include('dashboard.partials._errors')
                 
                  {{-- name --}}
                  <div class="form-group">
                          <label for="Name">Movie Name</label>
                  <input type="text" id="movie_name" name="name" value="{{old('name',$movie->name)}}" class="form-control">
                  </div>
                  {{-- description --}}
                  <div class="form-group">
                    <label for="description">Movie Description</label>
                    <input type="text" name="description"  value="{{old('description',$movie->description)}}" class="form-control">
                 </div>
                  {{-- poster --}}
                  <div class="form-group">
                    <label for="poster">Poster</label>
                    <input type="file" name="poster" class="form-control" style="padding: 0%">
                     <img src="{{$movie->poster_path}}" alt="" style="margin-top:10px;width:255px;height:378px">
                 </div>
                  {{-- Image --}}
                  <div class="form-group">
                    <label for="image"> Image</label>
                    <input type="file" name="image" class="form-control" style="padding: 0%">
                    <img src="{{$movie->image_path}}" alt="" style="margin-top:10px;width:300px;height:300px">
                 </div>
                 {{-- Categories --}}
                 <div class="form-group">
                   <td>
                  <label for="Roles">Categories</label>
                  <select name="categories[]" class="form-control select2" multiple="multiple" style="width:100%">
                    @foreach ($categories as $category)
                  <option value="{{$category->id}}" {{in_array($category->id,$movie->categories->pluck('id')->toArray())?'selected':''}}>{{$category->name}}</option> 
                    @endforeach
                  </select>
                </td>
                </div>
                  {{-- Year --}}
                  <div class="form-group">
                    <label for="year">Year </label>
                    <input type="text" name="year"  value="{{old('year',$movie->year)}}" class="form-control">
                 </div>
                  {{-- Rating --}}
                  <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" min="1"  value="{{old('rating',$movie->rating)}}" class="form-control">
                 </div>
              
              
                     <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection