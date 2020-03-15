@extends('layouts.dashboard.app')

@section('content')
<h2>Roles</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
  </ol>
</nav> 
<div class="tile mb-4">
  <div class="row">
    <div class="col-md-12">
      <form action="">
         <div class="row">
            <div class="col-md-4">
              <div class="form-group">
              <input type="text"class="form-control" name="search" autofocus placeholder="Search" value="{{request()->search}}">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"> Search</i></button>
                @if (auth()->user()->hasPermission('create_roles'))
                <a href="{{route('dashboard.roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"> Add</i></a>
                @else
                <a href="" disabled="" class="btn btn-primary"><i class="fa fa-plus"> Add</i></a>
                @endif
              </div>
            </div>
       </div><!-- end of row -->
       


      </form><!--end of form -->
    </div> <!-- end of col-12 -->
  </div> <!-- end or row -->

  <div class="row">
    <div class="col-md-12">
      @if ($roles->count() >0)
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Permissions</th>
                  <th>Users Count</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $index=>$role)
                    <tr>
                       <td>{{$index}}</td>
                       <td>{{$role->name}}</td>
                       <td>
                        @foreach ($role->permissions as $permission)
                        <h5 style="display:inline-block"><span class="badge badge-primary">{{$permission->name}}</span></h5>
                          @endforeach
                       </td>
                       <td>{{$role->users_count}}</td>
                       <td>
                          @if (auth()->user()->hasPermission('edit_roles'))
                          <a href="{{route('dashboard.roles.edit',$role->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                     @else 
                     <a href="" class="btn btn-warning btn-sm"><i class="fa fa-edit"> Edit</i></a>
                      @endif
                       
                       <form action="{{route('dashboard.roles.destroy',$role->id)}}" style="display:inline-block" method="post">
                      @csrf
                      @method('delete')
                      @if (auth()->user()->hasPermission('delete_roles'))
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
                   {{$roles->appends(request()->query())->links()}}
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