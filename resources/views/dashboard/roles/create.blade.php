@extends('layouts.dashboard.app')
@section('content')
<h2>Create Role</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
  <li class="breadcrumb-item active">Add Role</li>

  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.roles.store')}}" method="post">
        @csrf
        @include('dashboard.partials._errors')
        {{-- {{name}} --}}
        <div class="form-group">
          <label class="control-label">Name</label>
          <input class="form-control" type="text" name="name" placeholder="Enter role name">
        </div>
        {{-- {{selected}} --}}
        <div class="form-group">
          <h4>Permissions</h4>
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th style="width:5%">#</th>
                      <th style="width:25%">Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                      $models=['categories','movies','users','settings'];
                  @endphp
                  @foreach ($models as $index=>$model)
                      <tr>
                      <td>{{$index}}</td>
                      <td class="text-capitalize">{{$model}}</td>
                      <td>
                        @php
                            $permission_maps=['create','read','update','delete'];
                        @endphp
                        @if ($model=='settings')
                                 @php
                                 $permission_maps=['create','read'];
                                 @endphp
                        @endif
                          <select name="permissions[]" class="form-control select2" multiple="multiple">
                        @foreach ($permission_maps as $permission_map)
                          
                          <option  value="{{$permission_map.'_'.$model}}">{{$permission_map}}</option>  
                            
                        @endforeach
                      </select>  
                      </td>
                      </tr>
                  @endforeach
                  </tbody>
                </table>
                       
              </div>
            </div>
          </div>
        </div>


        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection