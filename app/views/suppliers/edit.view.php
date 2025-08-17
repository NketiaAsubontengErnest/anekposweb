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
                        <h3 class="fw-bold mb-3">Supplyer</h3>
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
                                <a href="#">Edit Supplyer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($row): ?>
                                <form method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Supplyer</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Supplyer Name</label>
                                                        <input
                                                            type="text"
                                                            value="<?= get_var('suplname', $row->suplname) ?>"
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
                                                        <label for="cost_price">Supplyer Phone</label>
                                                        <input name="suplphone"
                                                            type="text"
                                                            class="form-control"
                                                            value="<?= get_var('suplphone', $row->suplphone) ?>"
                                                            id="phone"
                                                            placeholder="024 *** ****" />
                                                        <?php if (isset($errors['suplphone'])) : ?>
                                                            <code><?= $errors['custsuplphonephone'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Supplyer Location</label>
                                                        <input
                                                            type="text"
                                                            value="<?= get_var('supllocation', $row->supllocation) ?>"
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
                                            <button class="btn btn-primary">Update Sypplyer</button>
                                            <a href="<?= HOME ?>/suppliers" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                                No Data found
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>