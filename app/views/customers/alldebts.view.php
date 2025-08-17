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
                        <h4 class="card-title">Customer Debt</h4>
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
                                <a href="#">Customers</a>
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
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <?php if ($row): ?>
                                            <h4 class="fw-bold mb-3"><?= esc($row->custname . ', ' .  $row->custlocation . ' - ' . $row->custphone) ?> Debts</h4>
                                            <h2 class="ms-auto">Total: GHC <?= esc($row->customer_total_debt->total_debt - $row->customer_total_pay->total_pay) ?></h2>
                                        <?php else: ?>
                                            <h4 class="fw-bold mb-3">Customers Debts</h4>
                                        <?php endif; ?>
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
                                                    <th>Invoice</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $debt): ?>
                                                        <tr>
                                                            <td><a href="<?= HOME ?>/sales/invoice/<?= $debt->invoicenum ?>"><?= esc($debt->invoicenum) ?></a></td>
                                                            <td><?= esc($debt->amount) ?></td>
                                                            <td><?= esc($debt->date) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/customers/paydebt/<?= esc($debt->id) ?>?invoice=<?= esc($debt->invoicenum) ?>&custid=<?= esc($debt->custid) ?>"
                                                                        type="button"
                                                                        data-bs-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"> Pay</i>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>