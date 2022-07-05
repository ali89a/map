<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Descriptions">
    <title>Location</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


   @include('admin.includes.style.style')

    <!-- Main CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
    <!-- Font-icon css-->
  <!--  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  -->
</head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="{{ route('dashboard') }}">Admin Panel</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li>
        <a class="app-nav__item" href="{{ url('/') }}" target="_blank" ><i class="fa fa-globe fa-lg"></i></a>
        </li>
     
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"> {{ Auth::user()->name }}</i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-fw"></i> 
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <ul class="app-menu">
        <li><a class="app-menu__item {{ (Request::segment(1) == 'dashboard' )?' active':''}}" href="{{ route('dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item {{ (Request::segment(1) == 'locations' )?' active':''}}" href="{{ route('locations.index')}}"><i class="app-menu__icon fa fa-map-marker"></i><span class="app-menu__label">Location</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      @yield('content')
    </main>

    @include('admin.includes.script.dashboardScript')
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script type="text/javascript">
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
      closeButton: true,
      progressBar: true,
    });
    @endforeach
    @endif
  </script>

  </body>
</html>