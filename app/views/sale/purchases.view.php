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
                        <h3 class="fw-bold mb-3">Reports</h3>
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
                                <a href="#">Products Purchases</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Product Purchases</h4>
                                    </div>
                                    <!-- Start Date and End Date Inputs -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <div class="form-group col-md-5">
                                            <label for="startdate">Start Date</label>
                                            <input type="date" id="startdate" name="startdate" class="form-control" value="<?= esc($_GET['startdate'] ?? '') ?>" onchange="submitForm()">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="enddate">End Date</label>
                                            <input type="date" id="enddate" name="enddate" class="form-control" value="<?= esc($_GET['enddate'] ?? '') ?>" onchange="submitForm()">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary mt-4" onclick="clearDates()">Clear</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Cost Price</th>
                                                    <th>Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $prod): ?>
                                                        <tr>
                                                            <td><?= esc($prod->product_name) ?></td>
                                                            <td><?= esc($prod->total_prod_quantity) ?></td>
                                                            <td>GHC <?= esc($prod->prod_unit_price) ?></td>
                                                            <td>GHC <?= esc($prod->total_prod_amount) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4">No Data Found!</td>
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

            <?php $this->view('includes/footer') ?>

            <script>
                function submitForm() {
                    const startDate = document.getElementById('startdate').value;
                    const endDate = document.getElementById('enddate').value;

                    const form = document.createElement('form');
                    form.method = 'GET';
                    form.action = ''; // Current page URL

                    // Add start date as a hidden input
                    if (startDate) {
                        const startInput = document.createElement('input');
                        startInput.type = 'hidden';
                        startInput.name = 'startdate';
                        startInput.value = startDate;
                        form.appendChild(startInput);
                    }

                    // Add end date as a hidden input
                    if (endDate) {
                        const endInput = document.createElement('input');
                        endInput.type = 'hidden';
                        endInput.name = 'enddate';
                        endInput.value = endDate;
                        form.appendChild(endInput);
                    }

                    // Retain other query parameters in the URL
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.forEach((value, key) => {
                        if (key !== 'startdate' && key !== 'enddate') { // Avoid duplicating current selections
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

                function clearDates() {
                    const form = document.createElement('form');
                    form.method = 'GET';
                    form.action = ''; // Current page URL
                    // Retain other query parameters in the URL, but remove date filters
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.forEach((value, key) => {
                        if (key !== 'startdate' && key !== 'enddate') {
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
            </script>
        </div>
    </div>
</body>