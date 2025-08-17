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
                        <h3 class="fw-bold mb-3">Category</h3>
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
                                <a href="#">Category</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group d-flex align-items-end">
                                                    <div style="flex:1;">
                                                        <label for="successInput">Add Category</label>
                                                        <input
                                                            name="category"
                                                            type="text"
                                                            id="successInput"
                                                            placeholder="Category Name"
                                                            required
                                                            class="form-control" />
                                                    </div>
                                                    <button class="btn btn-primary ms-2" style="height:40px;">Add </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Category List</h4>
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
                                                    <th>Category Name</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($rows): ?>
                                                    <?php foreach ($rows as $cat): ?>
                                                        <tr>
                                                            <td><?= esc($cat->category) ?></td>
                                                            <td>
                                                                <div class="form-button-action">
                                                                    <a href="<?= HOME ?>/products/catedit/<?= esc($cat->id) ?>"
                                                                        type="button"
                                                                        data-bs-toggle="tooltip"
                                                                        title=""
                                                                        class="btn btn-link btn-primary btn-lg"
                                                                        data-original-title="Edit Task">
                                                                        <i class="fa fa-edit"></i>
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