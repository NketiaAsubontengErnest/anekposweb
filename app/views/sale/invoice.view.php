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
                        <h3 class="fw-bold mb-3">Sales</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="<?= HOME ?>/dashboard">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="<?= HOME ?>/sales/invoices">Invoices</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">History</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">List of Products on Invoice <?= $id ?></h4>
                                        <a href="<?= HOME ?>/sales"
                                            class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-cart"></i>
                                            Go To Sales
                                        </a>
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
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Total</th>
                                                    <th>Sold Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($salesdata): ?>
                                                    <?php foreach ($salesdata as $prod): ?>
                                                        <tr>
                                                            <td><?= esc($prod->product->pro_name) ?></td>
                                                            <td><?= esc($prod->quantity) ?></td>
                                                            <td>GHC <?= esc($prod->price) ?></td>
                                                            <td>GHC <?= esc(number_format($prod->price * $prod->quantity, 2)) ?></td>
                                                            <td><?= esc($prod->datesold) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/sales/returnSale/<?= esc($prod->id) ?>"
                                                                        type="button"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Edit Task"
                                                                        class="btn btn-link btn-primary btn-lg">
                                                                        <i class="fa fa-undo"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6">No Data Found!</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Total</th>
                                                    <th>
                                                        <h3>GHC <?= esc(number_format($subdata->sub_total, 2)) ?></h3>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>