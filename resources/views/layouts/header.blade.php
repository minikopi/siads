<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex align-items-center">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                href="javascript:void(0);"></a>
            <div class="responsive-logo">
                <a href="{{ url('/') }}" class="header-logo">
                    <img src="{{ asset('images/logo.png') }}" class="mobile-logo logo-1" alt="logo">
                    <img src="{{ asset('images/logo.png') }}" class="mobile-logo dark-logo-1" alt="logo">
                </a>
            </div>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('images/logo.png') }}" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-md-flex profile-1">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                    class="nav-link leading-none d-flex px-1">
                                    <span>
                                        <img src="{{ asset('images/users/8.jpg') }}" alt="profile-user"
                                            class="avatar  profile-user brround cover-image">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                            <small class="text-muted">{{ Auth::user()->role }}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="{{ route('user.profile.index') }}">
                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.password.index') }}">
                                        <i class="dropdown-icon fe fe-lock"></i> Ubah Kata Sandi
                                    </a>
                                    <a class="dropdown-item" href="email.html">
                                        <i class="dropdown-icon fe fe-mail"></i> Notification
                                        <span class="badge bg-secondary float-end">3</span>
                                    </a>
                                    <a class="dropdown-item" href="emailservices.html">
                                        <i class="dropdown-icon fe fe-settings"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /app-Header -->
