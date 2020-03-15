@extends('layouts.dashboard.app')
@section('content')
<h2>Edit Role</h2>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{route('dashboard.roles.index')}}">roles</a></li>
  <li class="breadcrumb-item active">Edit Role</li>
  
  </ol>
</nav> 
<div class="tile">
    <div class="tile-body">
    <form action="{{route('dashboard.roles.update',$role->id)}}" method="post">
        @csrf
        @method('put')
        @include('dashboard.partials._errors')
        
        <div class="form-group">
          <label class="control-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{old('name',$role->name)}}">
        </div>

        <div class="tile">
          <div class="tile-body">
          <form action="{{route('dashboard.roles.store')}}" method="post">
              @csrf
              @include('dashboard.partials._errors')
              
              
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
                            $models=['categories','users'];
                        @endphp
                        @foreach ($models as $index=>$model)
                            <tr>
                            <td>{{$index}}</td>
                            <td>{{$model}}</td>
                            <td>
                              @php
                                  $permission_maps=['create','read','update','delete'];
      
                              @endphp
                                <select name="permissions[]" class="form-control select2" multiple>
                              @foreach ($permission_maps as $permission_map)
                                
                                <option value="{{$permission_map.'_'.$model}}"
                                {{$role->hasPermission($permission_map.'_'.$model)?'selected':''}}
                                >{{$permission_map}}</option>  
                                  
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
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Update</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>
      </form>
    </div>
  </div>
@endsection