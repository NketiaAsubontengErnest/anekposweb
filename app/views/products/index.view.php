<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch,]) ?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch,]) ?>
        <!-- End Sidebar -->

        <div class="main-panel">

            <?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch,]) ?>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold">Product</h3>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Products List</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Invoice Search Input -->
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="searchproduct">Search Product</label>
                                <nav
                                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-search pe-1">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                        <input
                                            id="searchproduct"
                                            type="text"
                                            placeholder="Type Product Name..."
                                            value="<?= isset($_GET['searchproduct']) ? esc($_GET['searchproduct']) : '' ?>"
                                            class="form-control" />
                                    </div>
                                </nav>
                            </div>
                            <script>
                                // Search invoice while typing
                                document.getElementById('searchproduct').addEventListener('input', function() {
                                    const value = this.value.trim();
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (value) {
                                        urlParams.set('searchproduct', value);
                                    } else {
                                        urlParams.delete('searchproduct');
                                    }
                                    // Retain other filters
                                    window.location.search = urlParams.toString();
                                });

                                // Keep cursor in input after reload
                                window.addEventListener('DOMContentLoaded', function() {
                                    const invoiceInput = document.getElementById('searchproduct');
                                    if (invoiceInput) {
                                        invoiceInput.focus();
                                        // Move cursor to end if value exists
                                        const val = invoiceInput.value;
                                        invoiceInput.value = '';
                                        invoiceInput.value = val;
                                    }
                                });
                            </script>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Product List</h4>
                                        <?php if (Auth::access('Admin')): ?>
                                            <a href="<?= HOME ?>/products/add"
                                                class="btn btn-primary btn-round ms-auto">
                                                <i class="fa fa-plus"></i>
                                                Add Product
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="table-responsive">
                                        <table
                                            id="add-row"
                                            class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Threshold</th>
                                                    <th>Cost Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Hidden</th>
                                                    <th>Barcode</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $prod): ?>
                                                        <tr>
                                                            <td><?= esc($prod->pro_name) ?></td>
                                                            <td><?= esc($prod->category->category) ?></td>
                                                            <td><?= esc($prod->quantity) ?></td>
                                                            <td><?= esc($prod->threshold) ?></td>
                                                            <td>GHC <?= esc($prod->cost_price) ?></td>
                                                            <td>GHC <?= esc($prod->selling_price) ?></td>
                                                            <td><?= esc($prod->hide) ?></td>
                                                            <td><?= esc($prod->barcode) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <?php if (Auth::access('Admin')): ?>
                                                                        <a href="<?= HOME ?>/products/edit/<?= esc($prod->productid) ?>"
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg"
                                                                            data-original-title="Edit Task">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="<?= HOME ?>/products/quantupdate/<?= esc($prod->productid) ?>"
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg"
                                                                            data-original-title="Edit Task">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    <?php endif ?>
                                                                    <?php if (Auth::access('Super Admin')): ?>
                                                                        <form action="" method="post">
                                                                            <button
                                                                                name="del"
                                                                                value="<?= esc($prod->productid) ?>"
                                                                                type="button"
                                                                                data-bs-toggle="tooltip"
                                                                                title=""
                                                                                class="btn btn-link btn-danger"
                                                                                data-original-title="Remove">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </form>
                                                                    <?php endif ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9">No Data Found!</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php $pager->display($rows ? count($rows) : 0); ?>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <?php if (Auth::access('Admin')): ?>
                                                    <form action="" method="post">
                                                        <button name="export"
                                                            class="btn btn-success btn-round ms-auto">
                                                            <i class="fa fa-download"></i>
                                                            Export to Excel
                                                        </button>
                                                    </form>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>