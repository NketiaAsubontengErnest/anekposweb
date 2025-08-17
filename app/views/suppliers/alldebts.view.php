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
                        <h4 class="card-title">Supplyer Debt</h4>
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
                                <a href="#">Supplyer</a>
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
                                            <h4 class="fw-bold mb-3"><?= esc($row->suplname . ', ' .  $row->supllocation . ' - ' . $row->suplphone) ?> Debts</h4>
                                            <h2 class="ms-auto">Total: GHC <?= esc($row->supplyer_total_debt->total_debt - $row->supplyer_total_pay->total_pay) ?></h2>
                                        <?php else: ?>
                                            <h4 class="fw-bold mb-3">Supplyer Debts</h4>
                                        <?php endif; ?>
                                        <div class="form-button-action">
                                            <a href="<?= HOME ?>/suppliers/paydebt/<?= esc($rows[0]->id) ?>?invoice=<?= esc($rows[0]->invoicenum) ?>&suplid=<?= esc($rows[0]->suplid) ?>"
                                                type="button"
                                                data-bs-toggle="tooltip"
                                                title=""
                                                class="btn btn-link btn-primary btn-lg"
                                                data-original-title="Edit Task">
                                                <h1><i class="fa fa-money-bill"> Pay</i></h1>
                                            </a>
                                        </div>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $debt): ?>
                                                        <tr>
                                                            <td><?= esc($debt->invoicenum) ?></td>
                                                            <td><?= esc($debt->amount) ?></td>
                                                            <td><?= esc($debt->date) ?></td>
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
                                    <?php $pager->display($rows ? count($rows) : 0); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>