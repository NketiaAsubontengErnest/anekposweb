<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch]) ?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch]) ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'link' => $link, 'hiddenSearch' => $hiddenSearch]) ?>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Daily</h3>
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
                                <a href="<?= HOME ?>/sales">Sales</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Daily Sales</a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="d-flex justify-content-between mt-4">
                                    <!-- Employee Select -->
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="employeeSelect">Employee Name</label>
                                        <select name="userid" id="employeeSelect" class="form-control" onchange="submitForm()">
                                            <option value="">Select an Employee</option>
                                            <?php foreach ($employees as $employee): ?>
                                                <option value="<?= esc($employee->username) ?>" <?= isset($_GET['userid']) && $_GET['userid'] == $employee->username ? 'selected' : '' ?>>
                                                    <?= esc($employee->firstname) ?> <?= esc($employee->lastname) ?> - <?= esc($employee->username) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Date Select -->
                                    <div class="form-group mb-4 col-md-4">
                                        <label for="dateOption">Sold Date</label>
                                        <select name="solddate" id="dateOption" class="form-control" onchange="submitForm()">
                                            <option value="">Select Date</option>
                                            <?php foreach ($dates as $date): ?>
                                                <option value="<?= esc($date->datesold) ?>" <?= isset($_GET['solddate']) && $_GET['solddate'] == $date->datesold ? 'selected' : '' ?>>
                                                    <?= esc($date->datesold) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- Date Select -->
                                    <div class="form-group mb-4 col-md-2">
                                        <div class="form-group mb-4 col-md-2 d-flex align-items-end">
                                            <button class="btn btn-secondary" onclick="clearFilters()">Refresh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Daily Sales History</h4>
                                    <h2 class="ms-auto">Total: GHC <?= esc($subtotal->sub_total) ?></h2>
                                </div>

                                <div class="card-body">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Total</th>
                                                    <th>Sold Date</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($salesdata): ?>
                                                    <?php foreach ($salesdata as $sale): ?>
                                                        <tr>
                                                            <td><?= esc($sale->ordernumber) ?></td>
                                                            <td><?= esc($sale->product->pro_name) ?></td>
                                                            <td><?= esc($sale->quantity) ?></td>
                                                            <td>GHC <?= esc($sale->price) ?></td>
                                                            <td>GHC <?= esc(number_format($sale->price * $sale->quantity, 2)) ?></td>
                                                            <td><?= esc($sale->datesold) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/sales/returnSale/<?= esc($sale->id) ?>"
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
                                                        <td colspan="8">No Data Found!</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php $pager->display($salesdata ? count($salesdata) : 0); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer') ?>

            <script>
                function submitForm() {
                    const selectedEmployee = document.getElementById('employeeSelect').value;
                    const selectedDate = document.getElementById('dateOption').value;

                    const form = document.createElement('form');
                    form.method = 'GET';
                    form.action = ''; // Current page URL

                    // Add selected employee as a hidden input
                    if (selectedEmployee) {
                        const employeeInput = document.createElement('input');
                        employeeInput.type = 'hidden';
                        employeeInput.name = 'userid';
                        employeeInput.value = selectedEmployee;
                        form.appendChild(employeeInput);
                    }

                    // Add selected date as a hidden input
                    if (selectedDate) {
                        const dateInput = document.createElement('input');
                        dateInput.type = 'hidden';
                        dateInput.name = 'solddate';
                        dateInput.value = selectedDate;
                        form.appendChild(dateInput);
                    }

                    // Retain other query parameters in the URL
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.forEach((value, key) => {
                        if (key !== 'userid' && key !== 'solddate') { // Avoid duplicating current selections
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = key;
                            input.value = value;
                            form.appendChild(input);
                        }
                    });

                    document.body.appendChild(form);
                    form.submit();
                }

                function clearFilters() {
                    window.location.href = window.location.pathname; // Redirect to the same page without query parameters
                }
            </script>
        </div>
    </div>
</body>