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
                                <a href="#">Add a User</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Add User</div>
                                    </div>
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
                                                        <option value="Sales">Sales</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Super Admin">Super Admin</option>
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
                                        <button class="btn btn-primary">Add User</button>
                                        <a href="<?= HOME ?>/users" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>