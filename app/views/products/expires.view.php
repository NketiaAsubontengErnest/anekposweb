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
                        <h3 class="fw-bold mb-3">Product</h3>
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
                                <a href="#">Products List</a>
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
                                        <h4 class="card-title">Products Expired</h4>
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
                                                    <th>Batchcode</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Expire Date</th>
                                                    <th>Expire Quantity</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $prod): ?>
                                                        <tr>
                                                            <td><?= esc($prod->batchcode) ?></td>
                                                            <td><?= esc($prod->product->pro_name) ?></td>
                                                            <td><?= esc($prod->product->category->category) ?></td>
                                                            <td><?= esc($prod->product->quantity) ?></td>
                                                            <td><?= esc($prod->expiredate) ?></td>
                                                            <td><?= esc($prod->quantity) ?></td>
                                                            <td>
                                                                <div class="form-button-action">

                                                                    <?php if (Auth::access('Super Admin')): ?>
                                                                        <form action="" method="post">
                                                                            <button
                                                                                name="del"
                                                                                value="<?= esc($prod->id) ?>"
                                                                                type="button"
                                                                                data-bs-toggle="tooltip"
                                                                                title=""
                                                                                class="btn btn-link btn-danger"
                                                                                data-original-title="Remove">
                                                                                <i class="fa fa-times"></i>
                                                                            </button>
                                                                        </form>
                                                                    <?php endif ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9">No Data Found!</td>
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