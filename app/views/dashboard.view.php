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
                    <div
                        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                        </div>
                        <?php if (Auth::access('developer')): ?>
                            <div class="ms-md-auto py-2 py-md-0">
                                <a href="<?= HOME ?>/#" class="btn btn-label-info btn-round me-2">Manage</a>
                                <a href="<?= HOME ?>/#" class="btn btn-primary btn-round">Add Customer</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (Auth::getRanks() == 'developer'): ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Visitors</p>
                                                    <h4 class="card-title">1,294</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Subscribers</p>
                                                    <h4 class="card-title">1303</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="fas fa-luggage-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Sales</p>
                                                    <h4 class="card-title">$ 1,345</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="far fa-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title">576</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Total Visitors</p>
                                                    <h4 class="card-title"><?= number_format($rows['totalVisitors']) ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Total Customers</p>
                                                    <h4 class="card-title"><?= number_format($rows['totalCustomers']) ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="fas fa-luggage-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Total Sales</p>
                                                    <h4 class="card-title">GHC <?= number_format($rows['totalSales'], 2) ?> </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div
                                                    class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="far fa-check-circle"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Total Products</p>
                                                    <h4 class="card-title"> <?= number_format($rows['totalProducts']) ?> </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                    <?php if (Auth::access('Admin')): ?>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Sales Statistics</div>
                                            <div class="card-tools">
                                                <a
                                                    href="#"
                                                    class="btn btn-label-success btn-round btn-sm me-2"
                                                    id="exportBtn">
                                                    <span class="btn-label">
                                                        <i class="fa fa-pencil"></i>
                                                    </span>
                                                    Export
                                                </a>
                                                <a href="#" class="btn btn-label-info btn-round btn-sm" id="printBtn">
                                                    <span class="btn-label">
                                                        <i class="fa fa-print"></i>
                                                    </span>
                                                    Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container" style="min-height: 375px">
                                            <canvas id="salesChart" width="100%" height="40"></canvas>
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                            <script>
                                                <?php
                                                $salesGraph = $rows['salesWeeklyGraph'] ?? [
                                                    'Mon' => 0,
                                                    'Tue' => 0,
                                                    'Wed' => 0,
                                                    'Thu' => 0,
                                                    'Fri' => 0,
                                                    'Sat' => 0,
                                                    'Sun' => 0
                                                ];
                                                $salesLabels = array_keys($salesGraph);
                                                $salesData = array_values($salesGraph);
                                                ?>
                                                const salesLabels = <?= json_encode($salesLabels) ?>;
                                                const salesData = <?= json_encode($salesData) ?>;

                                                const ctx = document.getElementById('salesChart').getContext('2d');
                                                const salesChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: salesLabels,
                                                        datasets: [{
                                                            label: 'Sales',
                                                            data: salesData,
                                                            backgroundColor: 'rgba(23, 162, 184, 0.2)',
                                                            borderColor: 'rgba(23, 162, 184, 1)',
                                                            borderWidth: 2,
                                                            pointBackgroundColor: 'rgba(23, 162, 184, 1)',
                                                            tension: 0.3,
                                                            fill: true
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        plugins: {
                                                            legend: {
                                                                display: true,
                                                                position: 'top'
                                                            }
                                                        },
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true
                                                            }
                                                        }
                                                    }
                                                });

                                                // Export as CSV
                                                document.getElementById('exportBtn').addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    let csv = 'Day,Sales\n';
                                                    salesLabels.forEach((label, i) => {
                                                        csv += `"${label}",${salesData[i]}\n`;
                                                    });
                                                    const blob = new Blob([csv], {
                                                        type: 'text/csv'
                                                    });
                                                    const url = window.URL.createObjectURL(blob);
                                                    const a = document.createElement('a');
                                                    a.href = url;
                                                    a.download = 'sales_statistics.csv';
                                                    document.body.appendChild(a);
                                                    a.click();
                                                    document.body.removeChild(a);
                                                    window.URL.revokeObjectURL(url);
                                                });

                                                // Print chart
                                                document.getElementById('printBtn').addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    const canvas = document.getElementById('salesChart');
                                                    const dataUrl = canvas.toDataURL();
                                                    const windowContent = `
                                                    <html>
                                                        <head><title>Print Chart</title></head>
                                                        <body>
                                                            <img src="${dataUrl}" style="width:100%;max-width:600px;">
                                                        </body>
                                                    </html>`;
                                                    const printWin = window.open('', '', 'width=800,height=600');
                                                    printWin.document.open();
                                                    printWin.document.write(windowContent);
                                                    printWin.document.close();
                                                    printWin.focus();
                                                    printWin.print();
                                                });
                                            </script>
                                        </div>
                                        <div id="myChartLegend"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary card-round">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Weekly Sales</div>

                                        </div>
                                        <div class="card-category">
                                            <span id="sales-date-range"></span>
                                            <script>
                                                // Format: March 25 - April 02 (Monday to Sunday)
                                                function formatDate(date) {
                                                    const options = {
                                                        month: 'long',
                                                        day: '2-digit'
                                                    };
                                                    return date.toLocaleDateString('en-US', options);
                                                }

                                                // Get current date
                                                const today = new Date();

                                                // Find last Monday
                                                const dayOfWeek = today.getDay(); // 0 (Sun) - 6 (Sat)
                                                const monday = new Date(today);
                                                monday.setDate(today.getDate() - ((dayOfWeek + 6) % 7));

                                                // Find next Sunday
                                                const sunday = new Date(monday);
                                                sunday.setDate(monday.getDate() + 6);

                                                const formattedRange = `${formatDate(monday)} - ${formatDate(sunday)}`;
                                                document.getElementById('sales-date-range').textContent = formattedRange;
                                            </script>
                                        </div>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="mb-4 mt-2 text-center">
                                            <b>
                                                <h1>GHC <?= number_format($rows['totalRevenue'], 2) ?></h1>
                                            </b>
                                        </div>
                                        <div class="pull-in">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-round">
                                    <div class="card-body pb-0">
                                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                                        <h2 class="mb-2">17</h2>
                                        <p class="text-muted">Monthly online</p>
                                        <div class="pull-in sparkline-fix">
                                            <div id="lineChart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>