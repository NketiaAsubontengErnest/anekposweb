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
                                <a href="#">Edit Prodcut</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($row): ?>
                                <form method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Prodcut</div>
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
                                                            name="barcode"
                                                            class="form-control" />
                                                        <?php if (isset($errors['barcode'])) : ?>
                                                            <code><?= $errors['barcode'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input name="quantity"
                                                            value="<?= get_var('quantity', $row->quantity) ?>"
                                                            type="number"
                                                            class="form-control"
                                                            id="quantity"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['quantity'])) : ?>
                                                            <code><?= $errors['quantity'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Product Name</label>
                                                        <input
                                                            value="<?= get_var('pro_name', $row->pro_name) ?>"
                                                            type="text"
                                                            id="successInput"
                                                            name="pro_name"
                                                            class="form-control" />
                                                        <?php if (isset($errors['pro_name'])) : ?>
                                                            <code><?= $errors['pro_name'] ?></code>
                                                        <?php endif; ?>
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

                                                    <div class="form-group">
                                                        <label for="largeSelect">Hidden</label>
                                                        <select name="hide"
                                                            class="form-select form-control-lg" id="largeSelect">
                                                            <option <?= get_select('hide', 'NO', $row->hide) ?> value="NO">NO</option>
                                                            <option <?= get_select('hide', 'YES', $row->hide) ?> value="YES">YES</option>
                                                        </select>
                                                        <?php if (isset($errors['hide'])) : ?>
                                                            <code><?= $errors['hide'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="largeSelect">Category</label>
                                                        <select name="catid"
                                                            class="form-select form-control-lg" id="largeSelect">
                                                            <option>--Select Category --</option>
                                                            <?php if ($catrows): ?>
                                                                <?php foreach ($catrows as $cat): ?>
                                                                    <option <?= get_select('catid', $cat->id, $row->catid) ?> value="<?= esc($cat->id) ?>"><?= esc($cat->category) ?></option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                            <?php if (isset($errors['catid'])) : ?>
                                                                <code><?= $errors['catid'] ?></code>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cost_price">Cost Price</label>
                                                        <input name="cost_price"
                                                            value="<?= get_var('cost_price', $row->cost_price) ?>"
                                                            type="text"
                                                            class="form-control"
                                                            id="cost_price"
                                                            placeholder="20.00" />
                                                        <?php if (isset($errors['cost_price'])) : ?>
                                                            <code><?= $errors['cost_price'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="selling_price">Selling Price</label>
                                                        <input name="selling_price"
                                                            value="<?= get_var('selling_price', $row->selling_price) ?>"
                                                            type="text"
                                                            class="form-control"
                                                            id="selling_price"
                                                            placeholder="20.00" />
                                                        <?php if (isset($errors['selling_price'])) : ?>
                                                            <code><?= $errors['selling_price'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Update Product</button>
                                            <a href="<?= HOME ?>/products" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>