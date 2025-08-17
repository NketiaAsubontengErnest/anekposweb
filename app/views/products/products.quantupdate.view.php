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
                        <h3 class="fw-bold mb-3">Product</h3>
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
                                <a href="#">Add Quantity Prodcut</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($row): ?>
                                <form method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Add Quantity Prodcut</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Barcode</label>
                                                        <input
                                                            value="<?= get_var('barcode', $row->barcode) ?>"
                                                            type="text"
                                                            id="successInput"
                                                            readonly
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="quantity">Quantity</label>
                                                                <input name=""
                                                                    readonly
                                                                    type="number"
                                                                    value="<?= get_var('quantity', $row->quantity) ?>"
                                                                    class="form-control"
                                                                    id="quantity"
                                                                    placeholder="20" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="quantity">New Quantity</label>
                                                                <input name="quantity"
                                                                    type="number"
                                                                    class="form-control"
                                                                    id="quantity"
                                                                    placeholder="20" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Product Name</label>
                                                        <input
                                                            value="<?= get_var('pro_name', $row->pro_name) ?>"
                                                            type="text"
                                                            id="successInput"
                                                            readonly
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="threshold">Threshold Quantity</label>
                                                        <input name="threshold"
                                                            value="<?= get_var('threshold', $row->threshold) ?>"
                                                            type="number"
                                                            class="form-control"
                                                            id="threshold"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['threshold'])) : ?>
                                                            <code><?= $errors['threshold'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">

                                                    <div class="form-group">
                                                        <label for="cost_price">Cost Price</label>
                                                        <input
                                                            value="<?= get_var('cost_price', $row->cost_price) ?>"
                                                            type="text"
                                                            class="form-control"
                                                            readonly
                                                            id="cost_price"
                                                            placeholder="20.00" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="selling_price">Selling Price</label>
                                                        <input
                                                            value="<?= get_var('selling_price', $row->selling_price) ?>"
                                                            type="text"
                                                            class="form-control"
                                                            id="selling_price"
                                                            readonly
                                                            placeholder="20.00" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-lg-4">

                                                        <div class="form-group">
                                                            <label for="expiredate">Expire Date</label>
                                                            <input
                                                                value="<?= get_var('expiredate') ?>"
                                                                type="date"
                                                                class="form-control"
                                                                id="expiredate"
                                                                name="expiredate"
                                                                placeholder="dd/mm/yyyy" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4">

                                                        <div class="form-group">
                                                            <label for="batchcode">Batch Code</label>
                                                            <input
                                                                value="<?= get_var('batchcode') ?>"
                                                                type="text"
                                                                class="form-control"
                                                                id="batchcode"
                                                                name="batchcode"
                                                                placeholder="X X X X X X X X" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Add Quantity</button>
                                            <a href="<?= HOME ?>/products/update" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>