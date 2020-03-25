@extends('layouts.dashboard.app')
@section('content')
@push('movie_styles')
   <style>
     #movie_upload_wrapper{
       display: flex;
       justify-content: center;
       align-items: center;
       height: 25vh;
       border: 1px solid black;   
     }
     
     </style> 
@endpush
<h2>Create Movie</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
  <li class="breadcrumb-item active">Add Movie</li>

  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <div class="" 
         id="movie_upload_wrapper"
          onclick="document.getElementById('movie_file_input').click()"
          style="display:{{$errors->any()?'none':'flex'}}">

       <i class="fa fa-video-camera fa-2x"></i>
       <p>Click to Upload</p>
    </div>
    <input type="file" data-movie_id="{{$movie->id}}"
     id="movie_file_input" name="" 
       data-url="{{route('dashboard.movies.store')}}"
     style="display:none">
    <form id="movie_properties" action="{{route('dashboard.movies.update',['movie'=>$movie->id,'type'=>'publish'])}}" method="post"
    style="display:{{$errors->any()?'block':'none'}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashboard.partials._errors')
        <div class="form-group" style="display:{{$errors->any()?'none':'block'}}">
          <label for="" id="movie_upload_status">Uploading</label>
          <div class="progress">
            <div class="progress-bar" id="movie_upload_progess" role="progressbar" aria-valuemin="0"  aria-valuemax="100"></div>
          </div>
        </div>
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
       </div>
        {{-- Image --}}
        <div class="form-group">
          <label for="image"> Image</label>
          <input type="file" name="image" class="form-control" style="padding: 0%">
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
            <button id="movie_submit_bt" style="display:{{$errors->any()?'block':'none'}}" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Publish</button>&nbsp;&nbsp;&nbsp;
          </div>
      </form>
    </div>
  </div>
@endsection