<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DTMS')</title>

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/vendors/css/extensions/toastr.css') }}">
@yield('vendor-css')
<!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/components.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/plugins/extensions/toastr.min.css') }}">
@yield('page-css')
<!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern light-layout 2-columns navbar-sticky footer-static"
      data-open="click"
      data-menu="vertical-menu-modern"
      data-col="2-columns"
      data-layout="light-layout">

<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name">{{ auth()->user()->full_name }}</span>
                                <span class="user-status text-muted">{{ auth()->user()->type }}</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0 p-0">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bx bx-user mr-50"></i> Edit Profile
                            </a>
                            <div class="dropdown-divider mb-0 mt-0"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="bx bx-power-off mr-50"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed  menu-accordion menu-shadow menu-light" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('profile.edit') }}">
                    <h2 class="brand-text mb-0 p-0">DTMS</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
                    <i class="toggle-icon bx-disc font-medium-4 d-none d-xl-block primary bx" data-ticon="bx-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            @if(auth()->user()->type === UserType::ADMIN)
                <li class="{{ (Route::is('admin.users.index') || Route::is('admin.users.edit')) ? 'active' : null }} nav-item">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="menu-livicon livicon-evo-holder" data-icon="users"></i>
                        <span class="menu-title">Users</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->type === UserType::TEACHER)
                <li class="{{ (Route::is('teacher.topics.index') || Route::is('teacher.topics.create') || Route::is('teacher.topics.edit')) ? 'active' : null }} nav-item">
                    <a href="{{ route('teacher.topics.index') }}">
                        <i class="menu-livicon livicon-evo-holder" data-icon="lab"></i>
                        <span class="menu-title">Topics</span>
                    </a>
                </li>

                <li class="{{ (Route::is('teacher.projectRequests.index')) ? 'active' : null }} nav-item">
                    <a href="{{ route('teacher.projectRequests.index') }}">
                        <i class="menu-livicon livicon-evo-holder" data-icon="info-alt"></i>
                        <span class="menu-title">Project Requests</span>
                    </a>
                </li>

                <li class="{{ (Route::is('teacher.projects.index') || Route::is('teacher.projects.create') || Route::is('teacher.projects.edit')) ? 'active' : null }} nav-item">
                    <a href="{{ route('teacher.projects.index') }}">
                        <i class="menu-livicon livicon-evo-holder" data-icon="notebook"></i>
                        <span class="menu-title">Projects</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->type === UserType::STUDENT)
                @if(auth()->user()->studentProject === null && auth()->user()->studentProjectRequest === null)
                    <li class="{{ (Route::is('student.topics.index') || Route::is('student.topics.show')) ? 'active' : null }} nav-item">
                        <a href="{{ route('student.topics.index') }}">
                            <i class="menu-livicon livicon-evo-holder" data-icon="lab"></i>
                            <span class="menu-title">Topics</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->studentProject !== null || auth()->user()->studentProjectRequest !== null)
                    <li class="{{ (Route::is('student.project.show')) ? 'active' : null }} nav-item">
                        <a href="{{ route('student.project.show') }}">
                            <i class="menu-livicon livicon-evo-holder" data-icon="hourglass"></i>
                            <span class="menu-title">Project</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->


<!-- BEGIN: Content-->
<div class="app-content content">
    @yield('content')
</div>
<!-- END: Content-->


<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-left d-inline-block">{{ now()->year }} &copy; Diploma Thesis Management System</span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script type="text/javascript">
    let APP_URL = '{{ asset('/') }}';
</script>
<script src="{{ asset('frest/app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('frest/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
@yield('page-vendor-js')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('frest/app-assets/js/scripts/configs/vertical-menu-light.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/js/core/app.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/js/scripts/components.min.js') }}"></script>
<script src="{{ asset('frest/app-assets/js/scripts/footer.min.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script type="text/javascript">
    $(document).ready(function () {
        let type = '{{ session('toast-type') }}';
        switch (type) {
            case 'info':
                toastr.info("{{ session('message') }}", 'Info');
                break;
            case 'warning':
                toastr.warning("{{ session('message') }}", 'Warning');
                break;
            case 'success':
                toastr.success("{{ session('message') }}", 'Success');
                break;
            case 'error':
                toastr.error("{{ session('message') }}", 'Error');
                break;
        }
    });
</script>
@yield('page-js')
<!-- END: Page JS-->

<!-- BEGIN: Custom JS-->
<script src="{{ asset('frest/assets/js/scripts.js') }}"></script>
<!-- END: Custom JS-->

</body>
<!-- END: Body-->

</html>
