<!-- Navbar start -->
<nav class="navbar">
    <!-- Navbar content (with toggle sidebar button) -->
    <div class="navbar-content">
        <!-- Toggle sidebar -->
        <button class="btn" type="button" onclick="halfmoon.toggleSidebar()">
        |||
        </button>
    </div>
    <!-- Navbar brand -->
    <a href="#" class="navbar-brand">
        <img src="..." alt="...">
        Brand
    </a>
    <!-- Navbar text -->
    <span class="navbar-text text-monospace">v3.0</span> <!-- text-monospace = font-family shifted to monospace -->
    <!-- Navbar nav -->
    <ul class="navbar-nav d-none d-md-flex">
        <!-- d-none = display: none, d-md-flex = display: flex on medium screens and up (width > 768px) -->
        <li class="nav-item active">
            <a href="{{ route('dashboard')}}" class="nav-link">DASHBOARD</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('calendar')}}" class="nav-link">CALENDAR</a>
        </li>
    </ul>
    <!-- Navbar form (inline form) -->
    <form class="ml-auto form-inline d-none d-md-flex" action="..." method="...">
        <!-- d-none = display: none, d-md-flex = display: flex on medium screens and up (width > 768px), ml-auto = margin-left: auto -->
        <input type="text" class="form-control" placeholder="Email address" required="required">
        <button class="btn btn-primary" type="submit">Sign up</button>
    </form>
    <!-- Navbar content (with the dropdown menu) -->
    <div class="ml-auto navbar-content d-md-none">
        <!-- d-md-none = display: none on medium screens and up (width > 768px), ml-auto = margin-left: auto -->
        <div class="dropdown with-arrow">
            <button class="btn" data-toggle="dropdown" type="button" id="navbar-dropdown-toggle-btn-1">
                Menu
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="navbar-dropdown-toggle-btn-1">
                <!-- w-200 = width: 20rem (200px) -->
                <a href="#" class="dropdown-item">Docs</a>
                <a href="#" class="dropdown-item">Products</a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-content">
                    <form action="..." method="...">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email address" required="required">
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar end -->
