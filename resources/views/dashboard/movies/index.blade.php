@extends('layouts.dashboard.app')

@section('content')
<h2>Movies</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Movies</li>
  </ol>
</nav> 
<div class="tile mb-4">
  <div class="row">
    <div class="col-md-12">
      <form action="">
         <div class="row">
            <div class="col-md-4">
              <div class="form-group">
              <input type="text"class="form-control" name="search" autofocus placeholder="Name,Description,Year,Rating" value="{{request()->search}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <select name="category" class="form-control">
                  <option value="">All Categories</option>
                  @foreach ($categories as $category)
                <option value="{{$category->id}}" {{request()->category == $category->id ? 'selected':''}}>{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"> Search</i></button>
                @if (auth()->user()->hasPermission('create_movies'))
                <a href="{{route('dashboard.movies.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"> Add</i></a>
                @else
                <a href="" disabled="" class="btn btn-primary btn-sm"><i class="fa fa-plus"> Add</i></a>
                @endif
              </div>
            </div>
       </div><!-- end of row -->
       


      </form><!--end of form -->
    </div> <!-- end of col-12 -->
  </div> <!-- end or row -->

  <div class="row">
    <div class="col-md-12">
      @if ($movies->count() >0)
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Year</th>
                  <th>Rating</th>
                  <th>Categories</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($movies as $index=>$movie)
                    <tr>
                       <td>{{$index+1}}</td>
                       <td>{{$movie->name}}</td>
                       <td>{{Str::limit($movie->description,50)}}</td>
                       <td>{{$movie->year}}</td>
                       <td>{{$movie->rating}}</td>
                       <td>
                        @foreach ($movie->categories as $category)
                        <h5 style="display:inline-block"><span class="badge badge-primary">{{$category->name}}</span></h5>
                          @endforeach
                       </td>
                      
                       <td>
                          @if (auth()->user()->hasPermission('update_movies'))
                          <a href="{{route('dashboard.movies.edit',$movie->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                     @else 
                     <a href="" disabled="" class="btn btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                      @endif
                       
                       <form action="{{route('dashboard.movies.destroy',$movie->id)}}" style="display:inline-block" method="post">
                      @csrf
                      @method('delete')
                      @if (auth()->user()->hasPermission('delete_movies'))
                      <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"> Delete</i></button>
                      @else 
                      <button type="submit" disabled class="btn btn-danger btn-sm delete"><i class="fa fa-trash"> Delete</i></button>
                      @endif
                      </form>
                    
                       </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
                   {{$movies->appends(request()->query())->links()}}
          </div>
        </div>
      </div>
      @else 
      <h3 style="font-weight:400">Sorry No Data Found</h3>
          
      @endif
    </div>
  </div>
</div> <!--end of tile -->
@endsection