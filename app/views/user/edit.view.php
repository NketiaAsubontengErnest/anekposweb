<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>
        <!-- End Sidebar -->

        <div class="main-panel">

            <?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Users</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Forms</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Edit a User</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Edit User</div>
                                    </div>
                                    <?php if ($row): ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">

                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">First Name</label>
                                                        <input
                                                            type="text"
                                                            id="successInput"
                                                            value="<?= get_var('firstname', $row->firstname) ?>"
                                                            name="firstname"
                                                            class="form-control" />
                                                        <?php if (isset($errors['firstname'])) : ?>
                                                            <code><?= $errors['firstname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="lastname">Last Name</label>
                                                        <input name="lastname"
                                                            type="text"
                                                            value="<?= get_var('lastname', $row->firstname) ?>"
                                                            class="form-control"
                                                            id="lastname"
                                                            placeholder="" />
                                                        <?php if (isset($errors['lastname'])) : ?>
                                                            <code><?= $errors['lastname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input name="phone"
                                                            type="text"
                                                            value="<?= get_var('phone', $row->phone) ?>"
                                                            class="form-control"
                                                            id="phone"
                                                            placeholder="X X X X X X X X X X" />
                                                        <?php if (isset($errors['phone'])) : ?>
                                                            <code><?= $errors['phone'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="largeSelect">Rank</label>
                                                        <select name="rank"
                                                            class="form-select form-control-lg" id="largeSelect">
                                                            <option <?= get_select('rank', 'Sales', $row->rank) ?> value="Sales">Sales</option>
                                                            <option <?= get_select('rank', 'Admin', $row->rank) ?> value="Admin">Admin</option>
                                                            <?php if (Auth::getRank() == 'developer'): ?>
                                                                <option <?= get_select('rank', 'Super Admin', $row->rank) ?> value="Super Admin">Super Admin</option>
                                                            <?php endif; ?>
                                                        </select>
                                                        <?php if (isset($errors['rank'])) : ?>
                                                            <code><?= $errors['rank'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Update User</button>
                                            <a href="<?= HOME ?>/users" class="btn btn-danger">Cancel</a>
                                        </div>
                                    <?php else: ?>
                                        NO DATA FOUND!
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>