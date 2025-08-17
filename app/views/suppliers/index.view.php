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
                        <h3 class="fw-bold mb-3">Supplyer</h3>
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
                                <a href="#">Forms</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Supplyer List</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="searchuser">Search Supplyer</label>
                                <nav
                                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-search pe-1">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                        <input
                                            id="searchsupplyer"
                                            type="text"
                                            placeholder="Type Name or Number..."
                                            value="<?= isset($_GET['searchsupplyer']) ? esc($_GET['searchsupplyer']) : '' ?>"
                                            class="form-control" />
                                    </div>
                                </nav>
                            </div>
                            <script>
                                // Search invoice while typing
                                document.getElementById('searchsupplyer').addEventListener('input', function() {
                                    const value = this.value.trim();
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (value) {
                                        urlParams.set('searchsupplyer', value);
                                    } else {
                                        urlParams.delete('searchsupplyer');
                                    }
                                    // Retain other filters
                                    window.location.search = urlParams.toString();
                                });

                                // Keep cursor in input after reload
                                window.addEventListener('DOMContentLoaded', function() {
                                    const invoiceInput = document.getElementById('searchsupplyer');
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
                                        <h4 class="card-title">Supplyer List</h4>
                                        <a href="<?= HOME ?>/suppliers/add"
                                            class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            Add Supplyer
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
                                                    <th>Supplyer Name</th>
                                                    <th>Phone</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $supl): ?>
                                                        <tr>
                                                            <td><?= esc($supl->suplname) ?></td>
                                                            <td><?= esc($supl->suplphone) ?></td>
                                                            <td><?= esc($supl->supllocation) ?></td>
                                                            <td><?= esc($supl->status == 0 ? 'Active' : 'In-Active') ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <?php if (Auth::access('Super Admin')): ?>
                                                                        <a href="<?= HOME ?>/suppliers/edit/<?= esc($supl->suplid) ?>"
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title=""
                                                                            class="btn btn-link btn-primary btn-lg"
                                                                            data-original-title="Edit Task">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!--  -->
                                                                    <?php endif ?>
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
                                    <?php $pager->display($rows ? count($rows) : 0); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>