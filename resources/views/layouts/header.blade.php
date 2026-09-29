<!-- Topbar Start -->
<div class="container-fluid bg-dark text-light px-0 py-2">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <span class="fa fa-phone-alt me-2"></span>
                <span>+012 345 6789</span>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <span class="far fa-envelope me-2"></span>
                <span>info@berkahsari.com</span>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center mx-n2">
                <span>Follow Us:</span>
                <a class="btn btn-link text-light" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-link text-light" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-link text-light" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-link text-light" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0">Berkah Sari</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('service') }}" class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">Services</a>
            <a href="{{ route('project') }}" class="nav-item nav-link {{ request()->routeIs('project') ? 'active' : '' }}">Projects</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('feature','quote','team','testimonial') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="{{ route('feature') }}" class="dropdown-item {{ request()->routeIs('feature') ? 'active' : '' }}">Features</a>
                    <a href="{{ route('quote') }}" class="dropdown-item {{ request()->routeIs('quote') ? 'active' : '' }}">Free Quote</a>
                    <a href="{{ route('team') }}" class="dropdown-item {{ request()->routeIs('team') ? 'active' : '' }}">Our Team</a>
                    <a href="{{ route('testimonial') }}" class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">Testimonial</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>
        <a href="{{ route('quote') }}" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
