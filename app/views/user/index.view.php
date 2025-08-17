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
                        <h3 class="fw-bold mb-3">Users</h3>
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
                                <a href="#">List of Users</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Invoice Search Input -->
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="searchuser">Search User</label>
                                <nav
                                    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-search pe-1">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                        <input
                                            id="searchuser"
                                            type="text"
                                            placeholder="Type Name or Number..."
                                            value="<?= isset($_GET['searchuser']) ? esc($_GET['searchuser']) : '' ?>"
                                            class="form-control" />
                                    </div>
                                </nav>
                            </div>
                            <script>
                                // Search invoice while typing
                                document.getElementById('searchuser').addEventListener('input', function() {
                                    const value = this.value.trim();
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (value) {
                                        urlParams.set('searchuser', value);
                                    } else {
                                        urlParams.delete('searchuser');
                                    }
                                    // Retain other filters
                                    window.location.search = urlParams.toString();
                                });

                                // Keep cursor in input after reload
                                window.addEventListener('DOMContentLoaded', function() {
                                    const invoiceInput = document.getElementById('searchuser');
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
                                        <h4 class="card-title">List of Users</h4>
                                        <a href="<?= HOME ?>/users/add"
                                            class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            Add Users
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
                                                    <th>Employee Number</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone</th>
                                                    <th>Rank</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $user): ?>

                                                        <tr>
                                                            <td><?= esc($user->username) ?></td>
                                                            <td><?= esc($user->firstname) ?></td>
                                                            <td><?= esc($user->lastname) ?></td>
                                                            <td><?= esc($user->phone) ?></td>
                                                            <td><?= esc(ucfirst($user->rank)) ?></td>
                                                            <td>
                                                                <?php if ($user->status == 0): ?>
                                                                    <label class="text-success">Active</label>
                                                                <?php else: ?>
                                                                    <label class="text-danger">In-Active</label>
                                                                <?php endif ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($user->rank != 'Super Admin'): ?>
                                                                    <div class="form-button-action">
                                                                        <?php if (Auth::access('Super Admin')): ?>
                                                                            <a href="<?= HOME ?>/users/edit/<?= esc($user->username) ?>"
                                                                                type="button"
                                                                                data-bs-toggle="tooltip"
                                                                                title=""
                                                                                class="btn btn-link btn-primary btn-lg"
                                                                                data-original-title="Edit Task">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <?php if ($user->status == 0): ?>
                                                                                <form method="post">
                                                                                    <input type="hidden" name="status" value="1">
                                                                                    <button
                                                                                        name="del"
                                                                                        value="<?= esc($user->username) ?>"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title=""
                                                                                        class="btn btn-link btn-danger"
                                                                                        data-original-title="Remove">
                                                                                        <i class="fa fa-times"></i>
                                                                                    </button>
                                                                                </form>
                                                                            <?php else: ?>
                                                                                <form method="post">
                                                                                    <input type="hidden" name="status" value="0">
                                                                                    <button
                                                                                        name="del"
                                                                                        value="<?= esc($user->username) ?>"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title=""
                                                                                        class="btn btn-link btn-success"
                                                                                        data-original-title="Remove">
                                                                                        <i class="fa fa-check"></i>
                                                                                    </button>
                                                                                </form>
                                                                            <?php endif; ?>
                                                                        <?php endif ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7">No Data Found!</td>
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