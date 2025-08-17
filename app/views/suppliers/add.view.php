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
                        <h3 class="fw-bold mb-3">Sypplyer</h3>
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
                                <a href="#">Add Sypplyer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Add Sypplyer</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Sypplyer Name</label>
                                                    <input
                                                        type="text"
                                                        id="successInput"
                                                        name="suplname"
                                                        class="form-control" />
                                                    <?php if (isset($errors['suplname'])) : ?>
                                                        <code><?= $errors['suplname'] ?></code>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="cost_price">Sypplyer Phone</label>
                                                    <input name="suplphone"
                                                        type="text"
                                                        class="form-control"
                                                        id="phone"
                                                        placeholder="024 *** ****" />
                                                    <?php if (isset($errors['suplphone'])) : ?>
                                                        <code><?= $errors['suplphone'] ?></code>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Sypplyer Location</label>
                                                    <input
                                                        type="text"
                                                        id="successInput"
                                                        name="supllocation"
                                                        class="form-control" />
                                                    <?php if (isset($errors['supllocation'])) : ?>
                                                        <code><?= $errors['supllocation'] ?></code>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-primary">Add Customer</button>
                                        <a href="<?= HOME ?>/suppliers" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>