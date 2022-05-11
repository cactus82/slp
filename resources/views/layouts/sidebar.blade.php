<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-blue">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{url('img/logo_jhl.jpg')}}" alt="JHL Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SLP-JHL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

       <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">BAHAGIAN LESEN</li>
                <li class="nav-item">
                    <a href="/lesen/memburu" class="nav-link">
                        <i class="nav-icon fas fa-paw"></i>
                        <p>Lesen Memburu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/lesen/tumbuhan" class="nav-link">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>Lesen Memungut</p>
                    </a>
                </li>
                <li class="nav-header">BAHAGIAN PERMIT</li>
                <li class="nav-item">
                    <a href="/permit/penternakan" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Penternakan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/permit/peniaga" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Peniaga</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/permit/membawakeluar" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Membawa Keluar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/permit/membawamasuk" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Membawa Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/permit/haiwantawanan" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Haiwan Tawanan</p>
                    </a>
                </li>
                @if (Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='super admin'))
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="/pengguna" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
