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
                                <a href="<?= HOME ?>/sales/invoice/<?= $salesdata->ordernumber ?>"><?= $salesdata->ordernumber ?></a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Return Prodcut</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <?php if ($salesdata): ?>
                            <div class="col-md-12">
                                <form method="post">
                                    <input type="hidden" name="productid" value="<?= $salesdata->productid ?>">
                                    <input type="hidden" name="ordernumber" value="<?= $salesdata->ordernumber ?>">
                                    <input type="hidden" name="oldquant" value="<?= $salesdata->quantity ?>">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Return Prodcut</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Barcode</label>
                                                        <input
                                                            type="text"
                                                            id="successInput"
                                                            disabled
                                                            value="<?= $salesdata->product->barcode ?>"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input disabled
                                                            value="<?= $salesdata->quantity ?>"
                                                            type="number"
                                                            class="form-control"
                                                            id="quantity"
                                                            placeholder="20" />
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Product Name</label>
                                                        <input
                                                            disabled
                                                            value="<?= $salesdata->product->pro_name ?>"
                                                            type="text"
                                                            id="successInput"
                                                            class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="threshold">Retuning Quantity</label>
                                                        <input
                                                            name="returningQty"
                                                            type="number"
                                                            min="1"
                                                            max="<?= $salesdata->quantity ?>"
                                                            required
                                                            class="form-control"
                                                            id="threshold"
                                                            placeholder="<?= $salesdata->quantity ?>" />
                                                    </div>

                                                </div>

                                                <div class="col-md-6 col-lg-4">

                                                    <div class="form-group">
                                                        <label for="cost_price">Sold by:</label>
                                                        <input
                                                            disabled
                                                            value="<?= $salesdata->seller->firstname . " " . $salesdata->seller->lastname ?>"
                                                            type="text"
                                                            class="form-control"
                                                            id="cost_price"
                                                            placeholder="20.00" />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="selling_price">Seller Phone</label>
                                                        <input
                                                            disabled
                                                            value="<?= $salesdata->seller->phone ?>"
                                                            type="text"
                                                            class="form-control"
                                                            id="selling_price"
                                                            placeholder="20.00" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Return</button>
                                            <a href="<?= HOME ?>/sales/invoice/<?= $salesdata->ordernumber ?>" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>