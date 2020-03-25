<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph Meta-->
    {{-- <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular."> --}}
    <title>Netflixfy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('dashboard_files/css/main.css')}}">
  <link rel="stylesheet" href="{{asset('css/font-awesome5.11.2.min.css')}}">

  <link rel="stylesheet" href="{{asset('dashboard_files/plugins/noty.css')}}">
  <script src="{{asset('dashboard_files/plugins/noty.min.js')}}"></script>

  {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @stack('movie_styles');
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
  
   @include('layouts.dashboard._header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <!-- Aside-->
    @include('layouts.dashboard._aside')
     <!-- Aside-->
    <main class="app-content">
      {{-- <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div> --}}
      @include('dashboard.partials._session')
      @yield('content')
     

    </main>
    <!-- Essential javascripts for application to work-->
  <script src="{{asset('dashboard_files/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('dashboard_files/js/plugins/select2.min.js')}}"></script>
  <script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
  <script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('dashboard_files/js/main.js')}}"></script>
     {{-- Movie --}}
     <script src="{{asset('dashboard_files/js/custom/movie.js')}}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}  
  <script>
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
    });
  $(document).ready(function(){
   $(document).on('click','.delete',function(e){
     e.preventDefault();
     var that=$(this);
        var n=new Noty({
      text:"Confirm deleting record",
      killer:true,
      buttons:[
        Noty.button('Yes','btn btn-danger mr-2',function(){
         that.closest('form').submit();
        }),
        Noty.button('No','btn btn-success',function(){
              n.close();
       }),

      ],
        });
        n.show();
   });

 //.select2
 $('.select2').select2();

  });
  </script>
 
  </body>
</html>