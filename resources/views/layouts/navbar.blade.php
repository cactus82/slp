<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i><span>&nbsp;{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{url('img/logo_jhl.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-sm">@if (Auth::user()->role == 'admin')
                            <small>Admin</small>
                            @elseif (Auth::user()->role == 'normal')
                            <small>Normal</small>
                            @elseif (Auth::user()->role == 'super admin')
                            <small>Super Admin</small>
                            @elseif (Auth::user()->role == 'client')
                            <small>Client</small>
                            @else
                            <small>Guest</small>
                            @endif</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>                                
                @if (Auth::user()->role == 'admin' || Auth::user()->role_id == 'super admin')
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Register</a>
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{route('myLogout')}}" class="dropdown-item dropdown-footer">Log Out</a>
            </div>
        </li>        
    </ul>

    
</nav>
<!-- /.navbar -->