<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('home')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="#" alt="" height="auto" width="100%">
                    </span>
            <span class="logo-lg">
                        <img src="#" alt="" height="auto" width="100%">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('home')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="#" alt="" height="auto" width="100%">
                    </span>
            <span class="logo-lg">
                        <img src="#" alt="" height="auto" width="100%">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->segment(1) == null) active @endif" href="{{route('home')}}">
                        <i class=" ri-dashboard-2-line"></i> <span data-key="t-widgets">Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(request()->segment(1) == "dashboard") active @endif" href="{{route('dashboard')}}">
                        <i class=" ri-user-5-line"></i> <span data-key="t-widgets">Post Management</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
