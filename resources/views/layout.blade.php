<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>Duralux || Dashboard</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/vendors/css/vendors.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/daterangepicker.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/theme.min.css" />
</head>

<body>
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="#" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo-full.png" alt="" class="logo logo-lg" />
                    <img src="assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboards</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-layers"></i></span>
                            <span class="nxl-mtext">Manage Topics</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-help-circle"></i></span>
                            <span class="nxl-mtext">Manage Questions</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Manage Students</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                            <span class="nxl-mtext">Results & Reports</span>
                        </a>
                    </li>
                    <!-- <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Customers</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="customers.html">Customers</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="customers-view.html">Customers View</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="customers-create.html">Customers Create</a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-settings"></i></span>
                            <span class="nxl-mtext">Settings</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="settings-general.html">Change Password</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="settings-seo.html">Exam Timer</a>
                            </li>
                            <!-- <li class="nxl-item"><a class="nxl-link" href="settings-tags.html">Tags</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="settings-email.html">Email</a></li> -->
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-log-out"></i></span>
                            <span class="nxl-mtext">Logout</span>
                        </a>
                    </li>
                    <!-- <li class="nxl-item nxl-hasmenu">
                        <a href="#" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-power"></i></span>
                            <span class="nxl-mtext">Authentication</span><span class="nxl-arrow"><i
                                    class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Login</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="auth-login-cover.html">Cover</a></li>
                                    <li class="nxl-item"><a class="nxl-link" href="auth-login-minimal.html">Minimal</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-login-creative.html">Creative</a></li>
                                </ul>
                            </li>
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Register</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="auth-register-cover.html">Cover</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-register-minimal.html">Minimal</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-register-creative.html">Creative</a></li>
                                </ul>
                            </li>
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Error-404</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="auth-404-cover.html">Cover</a></li>
                                    <li class="nxl-item"><a class="nxl-link" href="auth-404-minimal.html">Minimal</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link" href="auth-404-creative.html">Creative</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Reset Pass</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="auth-reset-cover.html">Cover</a></li>
                                    <li class="nxl-item"><a class="nxl-link" href="auth-reset-minimal.html">Minimal</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-reset-creative.html">Creative</a></li>
                                </ul>
                            </li>
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Verify OTP</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="auth-verify-cover.html">Cover</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link" href="auth-verify-minimal.html">Minimal</a>
                                    </li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-verify-creative.html">Creative</a></li>
                                </ul>
                            </li>
                            <li class="nxl-item nxl-hasmenu">
                                <a href="#" class="nxl-link">
                                    <span class="nxl-mtext">Maintenance</span><span class="nxl-arrow"><i
                                            class="feather-chevron-right"></i></span>
                                </a>
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-maintenance-cover.html">Cover</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-maintenance-minimal.html">Minimal</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="auth-maintenance-creative.html">Creative</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!--! ================================================================ !-->
    <!--! [End]  Navigation Manu !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="#" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="#" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="#" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="#" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu !-->
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="#" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <!--! [End] nxl-lavel-mega-menu !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item nxl-header-search">
                        <a href="#" class="nxl-head-link me-0" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="feather-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                            <div class="input-group search-form">
                                <span class="input-group-text">
                                    <i class="feather-search fs-6 text-muted"></i>
                                </span>
                                <input type="text" class="form-control search-input-field" placeholder="Search...." />
                                <span class="input-group-text">
                                    <button type="button" class="btn-close"></button>
                                </span>
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="#" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="#" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="#" data-bs-toggle="dropdown" role="button" data-bs-auto-close="outside">
                            <img src="assets/images/avatar/1.png" alt="user-image" class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="assets/images/avatar/1.png" alt="user-image"
                                        class="img-fluid user-avtar" />
                                    <div>
                                        <h6 class="text-dark mb-0">Alexandra Della</h6>
                                        <span class="fs-12 fw-medium text-muted">alex@example.com</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            @yield('content')
        </div>
        <!--! ================================================================ !-->
        <!--! [End] Main Content !-->
        <!--! ================================================================ !-->
        <!--! Footer Script !-->
        <!--! ================================================================ !-->
        <!-- [ Footer ] start -->
        <footer class="footer">
            <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                <span>Copyright ©</span>
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean"
                        target="_blank">theme_ocean</a></span> • <span>Distributed by: <a target="_blank"
                        href="https://themewagon.com/" target="_blank">ThemeWagon</a></span></p>
            <div class="d-flex align-items-center gap-4">
                <a href="#" class="fs-11 fw-semibold text-uppercase">Help</a>
                <a href="#" class="fs-11 fw-semibold text-uppercase">Terms</a>
                <a href="#" class="fs-11 fw-semibold text-uppercase">Privacy</a>
            </div>
        </footer>
        <!-- [ Footer ] end -->
    </main>
    <!--! BEGIN: Vendors JS !-->
    <script src="assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="assets/vendors/js/daterangepicker.min.js"></script>
    <script src="assets/vendors/js/apexcharts.min.js"></script>
    <script src="assets/vendors/js/circle-progress.min.js"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="assets/js/common-init.min.js"></script>
    <script src="assets/js/dashboard-init.min.js"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="assets/js/theme-customizer-init.min.js"></script>
    <!--! END: Theme Customizer !-->
</body>

</html>