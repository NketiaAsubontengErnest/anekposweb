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
                        <h3 class="fw-bold mb-3">Shop</h3>
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
                                <a href="#">Edit Shop</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($row): ?>
                                <form method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Shop</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Shop Name</label>
                                                        <input
                                                            type="text"
                                                            value="<?=get_var('shopname', $row->shopname)?>"
                                                            id="successInput"
                                                            name="shopname"
                                                            class="form-control" />
                                                        <?php if (isset($errors['shopname'])) : ?>
                                                            <code><?= $errors['shopname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="successInput">Address</label>
                                                        <input
                                                            type="text"
                                                            value="<?=get_var('address', $row->address)?>"
                                                            id="successInput"
                                                            name="address"
                                                            class="form-control" />
                                                        <?php if (isset($errors['shopname'])) : ?>
                                                            <code><?= $errors['shopname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Start Date</label>
                                                        <input name="startdate"
                                                            type="date"
                                                            value="<?=get_var('startdate', $row->startdate)?>"
                                                            class="form-control"
                                                            id="startdate"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['startdate'])) : ?>
                                                            <code><?= $errors['startdate'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Shop Location</label>
                                                        <input
                                                            type="text"
                                                            value="<?=get_var('location', $row->location)?>"
                                                            id="successInput"
                                                            name="location"
                                                            class="form-control" />
                                                        <?php if (isset($errors['location'])) : ?>
                                                            <code><?= $errors['location'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="successInput">Shop Email</label>
                                                        <input
                                                            type="email"
                                                            value="<?=get_var('email', $row->email)?>"
                                                            id="successInput"
                                                            name="email"
                                                            class="form-control" />
                                                        <?php if (isset($errors['email'])) : ?>
                                                            <code><?= $errors['email'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Number of Year(s)</label>
                                                        <input name="years"
                                                            type="number"
                                                            value="<?=get_var('years', $row->years)?>"
                                                            class="form-control"
                                                            id="years"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['years'])) : ?>
                                                            <code><?= $errors['years'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="cost_price">Shop Phone</label>
                                                        <input name="phone"
                                                            type="text"
                                                            value="<?=get_var('phone', $row->phone)?>"
                                                            class="form-control"
                                                            id="phone"
                                                            placeholder="024 *** ****" />
                                                        <?php if (isset($errors['phone'])) : ?>
                                                            <code><?= $errors['phone'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cost_price">Initials</label>
                                                        <input name="initials"
                                                            type="text"
                                                            value="<?=get_var('initials', $row->initials)?>"
                                                            class="form-control"
                                                            id="initials"
                                                            placeholder="X X X" />
                                                        <?php if (isset($errors['initials'])) : ?>
                                                            <code><?= $errors['initials'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Update Shop</button>
                                            <a href="<?= HOME ?>/products" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>