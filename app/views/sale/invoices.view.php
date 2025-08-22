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
                            <!-- Invoice Search Input -->
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="invoiceSearch">Search Invoice</label>
                                <nav
                                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-search pe-1">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                        <input
                                            id="invoiceSearch"
                                            type="text"
                                            placeholder="Type invoice number..."
                                            value="<?= isset($_GET['invoice']) ? esc($_GET['invoice']) : '' ?>"
                                            class="form-control" />
                                    </div>
                                </nav>
                            </div>
                            <script>
                                // Search invoice while typing
                                document.getElementById('invoiceSearch').addEventListener('input', function() {
                                    const value = this.value.trim();
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (value) {
                                        urlParams.set('invoice', value);
                                    } else {
                                        urlParams.delete('invoice');
                                    }
                                    // Retain other filters
                                    window.location.search = urlParams.toString();
                                });

                                // Keep cursor in input after reload
                                window.addEventListener('DOMContentLoaded', function() {
                                    const invoiceInput = document.getElementById('invoiceSearch');
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
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">List of Invoices</h4>
                                </div>

                                <div class="card-body">
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Total Products</th>
                                                    <th>Total Amount</th>
                                                    <th>Sold Date</th>
                                                    <th>Sales Person</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($salesdata): ?>
                                                    <?php foreach ($salesdata as $sale): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?= HOME ?>/sales/invoice/<?= esc($sale->ordernumber) ?>">
                                                                    <?= esc($sale->ordernumber) ?>
                                                                </a>
                                                            </td>
                                                            <td><?= esc($sale->total_products) ?></td>
                                                            <td><?= esc($sale->total_amount) ?></td>
                                                            <td><?= esc($sale->datesold) ?></td>
                                                            <td><?= esc($sale->seller->lastname) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/sales/invoice/<?= esc($sale->ordernumber) ?>"
                                                                        type="button"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Edit Task"
                                                                        class="btn btn-link btn-primary btn-lg">
                                                                        <i class="fa fa-eye"></i>
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