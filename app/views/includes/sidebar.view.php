<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="<?= HOME ?>/dashboard" class="logo">
                <img
                    src="<?= ASSETS ?>/img/kaiadmin/logo_light.png"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="60" />
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?= $actives == 'dashboard' ? 'active' : '' ?>">
                    <a
                        href="<?= HOME ?>/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if (!Auth::access('developer')): ?>
                    <li class="nav-item <?= $actives == 'sales' ? 'active' : '' ?>">
                        <a
                            href="<?= HOME ?>/sales">
                            <i class="fas fa-desktop"></i>
                            <p>Make Sales</p>
                            <span class="badge badge-warning">
                                <?php $sales = new Sale(); ?>
                                GHC <?= esc(number_format($sales->calculate_Sales(), 2)) ?>
                            </span>
                        </a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <?php if (Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Shops</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= HOME ?>/shops">
                                    <span class="sub-item">Shops List</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOME ?>/shops/expire">
                                    <span class="sub-item">Expire Shops</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?= $actives == 'salesreport' ? 'active' : '' ?>">
                    <?php if (Auth::access('Sales') && !Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#sidebarLayouts">
                            <i class="far fa-chart-bar"></i>
                            <p>Sales Reports</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="<?= $link == 'saleslist' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/sales/list">
                                    <span class="sub-item">Sales History</span>
                                </a>
                            </li>
                            <li class="<?= $link == 'daily' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/sales/daily">
                                    <span class="sub-item">Daily Sales</span>
                                </a>
                            </li>
                            <li class="<?= $link == 'purchases' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/sales/purchases">
                                    <span class="sub-item">Product Purchases</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?= $actives == 'products' ? 'active submenu' : '' ?>">
                    <?php if (Auth::access('Super Admin') && !Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Products</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li class="<?= $link == 'category' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/products/category">
                                    <span class="sub-item">Categories</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?= HOME ?>/products/update">
                                    <span class="sub-item">Update Product</span>
                                </a>
                            </li>
                            <li class="<?= $link == 'list' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/products">
                                    <span class="sub-item">Products</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOME ?>/products/return">
                                    <span class="sub-item">Return Product</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?= $actives == 'users' ? 'active submenu' : '' ?>">
                    <?php if (Auth::access('Super Admin') && !Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#forms">
                            <i class="fas fa-users"></i>
                            <p>My Users</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li class="<?= $link == 'userslist' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/users">
                                    <span class="sub-item">List of Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?= $actives == 'customers' ? 'active submenu' : '' ?>">
                    <?php if (Auth::access('Sales') && !Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#maps">
                            <i class="fas fa-th-list"></i>
                            <p>Manage Customers</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li class="<?= $link == 'customerslist' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/customers">
                                    <span class="sub-item">Customers List</span>
                                </a>
                            </li>
                            <li class="<?= $link == 'customersadd' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/customers/add">
                                    <span class="sub-item">Add Customer</span>
                                </a>
                            </li>
                            <li class="<?= $link == 'customersdebts' ? 'active' : '' ?>">
                                <a href="<?= HOME ?>/customers/debts">
                                    <span class="sub-item">Add Customer Debt</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?= $actives == 'suppliers' ? 'active submenu' : '' ?>">
                    <?php if (Auth::access('Admin') && !Auth::access('developer')): ?>
                        <a data-bs-toggle="collapse" href="#charts">
                            <i class="fas fa-bars"></i>
                            <p>Manage Supplyers</p>
                            <span class="caret"></span>
                        </a>
                    <?php endif ?>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= HOME ?>/suppliers">
                                    <span class="sub-item">Supplyers List</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOME ?>/suppliers/add">
                                    <span class="sub-item">Add Supplyer</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOME ?>/suppliers/debts">
                                    <span class="sub-item">Add Supplyer Debt</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>