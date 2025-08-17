<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="<?= ASSETS ?>/index.html" class="logo">
                <img
                    src="<?= ASSETS ?>/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav
        class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                    class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a
                        class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown"
                        href="<?= ASSETS ?>/#"
                        role="button"
                        aria-expanded="false"
                        aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input
                                    type="text"
                                    placeholder="Search ..."
                                    class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>


                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <?php if (!Auth::access('developer')): ?>
                        <a
                            class="nav-link"
                            data-bs-toggle="dropdown"
                            href="<?= ASSETS ?>/#"
                            aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                        </a>
                    <?php endif ?>
                    <div class="dropdown-menu quick-actions animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Reports</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="<?= HOME ?>/sales/profit">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-danger rounded-circle">
                                                <i class="fas fa-table"></i>
                                            </div>
                                            <span class="text">My Profit</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="<?= HOME ?>/sales/daily">
                                        <div class="quick-actions-item">
                                            <div
                                                class="avatar-item bg-warning rounded-circle">
                                                <i class="fas fa-map"></i>
                                            </div>
                                            <span class="text">General Report</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="<?= HOME ?>/sales/purchases">
                                        <div class="quick-actions-item">
                                            <div class="avatar-item bg-info rounded-circle">
                                                <i class="fas fa-file-excel"></i>
                                            </div>
                                            <span class="text">Product Statistics</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="<?= ASSETS ?>/#">
                                        <div class="quick-actions-item">
                                            <div
                                                class="avatar-item bg-success rounded-circle">
                                                <i class="far fa-chart-bar"></i>
                                            </div>
                                            <span class="text">Statistics</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="<?= HOME ?>/sales/invoices">
                                        <div class="quick-actions-item">
                                            <div
                                                class="avatar-item bg-primary rounded-circle">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            </div>
                                            <span class="text">Invoice</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="<?= HOME ?>/products/expires">
                                        <div class="quick-actions-item">
                                            <div
                                                class="avatar-item bg-secondary rounded-circle">
                                                <i class="fa fa-exclamation-circle"></i>
                                            </div>
                                            <span class="text">Expire</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a
                        class="dropdown-toggle profile-pic"
                        data-bs-toggle="dropdown"
                        href="<?= ASSETS ?>/#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img
                                src="<?= ASSETS ?>/img/profile.jpg"
                                alt="..."
                                class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold"><?= esc(Auth::getFirstname()) ?></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img
                                            src="<?= ASSETS ?>/img/profile.jpg"
                                            alt="image profile"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4><?= esc(Auth::getFirstname()) ?></h4>
                                        <p class="text-muted"><?= esc(Auth::getUsername()) ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= HOME ?>/profile">Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= HOME ?>/logout">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>