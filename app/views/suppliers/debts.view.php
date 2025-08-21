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
                        <h3 class="fw-bold mb-3">Supplyer Debts</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="/dashboard">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Supplyer Debts</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Customers Debts</div>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Supplyer Name</label>
                                                    <select class="form-control" name="suplid" id="" required>
                                                        <option value="">Select Supplyer Name</option>
                                                        <?php if ($rows): ?>
                                                            <?php foreach ($rows as $supl): ?>
                                                                <option value="<?= $supl->suplid ?>"><?= esc($supl->suplname . ', ' . $supl->supllocation . ' - ' . $supl->suplphone) ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Order Number / Invoice</label>
                                                    <input type="text" name="invoicenum" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Amount (GHC)</label>
                                                    <input type="text" name="amount" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-primary">Add Debt</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Debt List</h4>

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
                                                    <th>Customer Name</th>
                                                    <th>Phone</th>
                                                    <th>Total Debt</th>
                                                    <th>Total Paid</th>
                                                    <th>Total Bal.</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rowsdebt): ?>
                                                    <?php foreach ($rowsdebt as $debt): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?= HOME ?>/suppliers/alldebts/<?= esc($debt->suplid) ?>">
                                                                    <?= esc($debt->supplyer->suplname . ', ' .  $debt->supplyer->supllocation . ' - ' . $debt->supplyer->suplphone) ?>
                                                                </a>
                                                            </td>
                                                            <td><a href="tel:<?= esc($debt->supplyer->suplphone) ?>"><?= esc($debt->supplyer->suplphone) ?></a></td>
                                                            <td><?= esc(number_format($debt->amount, 2)) ?></td>
                                                            <td><?= esc(number_format($debt->supplyer->supplyer_total_pay->total_pay, 2)) ?></td>
                                                            <td><?= esc(number_format($debt->amount - $debt->supplyer->supplyer_total_pay->total_pay, 2)) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/suppliers/alldebts/<?= esc($debt->suplid) ?>"
                                                                        type="button"
                                                                        data-bs-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-original-title="Edit Task">
                                                                        <i class="fa fa-money">Depts</i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="2">No Data Found!</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php $pager->display($rowsdebt ? count($rowsdebt) : 0); ?>
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