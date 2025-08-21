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
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Shop</h3>
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
                                <a href="#">Edit Shop</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($row): ?>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Shop</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Shop Name</label>
                                                        <input
                                                            type="text"
                                                            value="<?= get_var('shopname', $row->shopname) ?>"
                                                            id="successInput"
                                                            name="shopname"
                                                            class="form-control" />
                                                        <?php if (isset($errors['shopname'])) : ?>
                                                            <code><?= $errors['shopname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="successInput">Address</label>
                                                        <input
                                                            type="text"
                                                            value="<?= get_var('address', $row->address) ?>"
                                                            id="successInput"
                                                            name="address"
                                                            class="form-control" />
                                                        <?php if (isset($errors['shopname'])) : ?>
                                                            <code><?= $errors['shopname'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Start Date</label>
                                                        <input name="startdate"
                                                            type="date"
                                                            value="<?= get_var('startdate', $row->startdate) ?>"
                                                            class="form-control"
                                                            id="startdate"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['startdate'])) : ?>
                                                            <code><?= $errors['startdate'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="successInput">Shop Location</label>
                                                        <input
                                                            type="text"
                                                            value="<?= get_var('location', $row->location) ?>"
                                                            id="successInput"
                                                            name="location"
                                                            class="form-control" />
                                                        <?php if (isset($errors['location'])) : ?>
                                                            <code><?= $errors['location'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="successInput">Shop Email</label>
                                                        <input
                                                            type="email"
                                                            value="<?= get_var('email', $row->email) ?>"
                                                            id="successInput"
                                                            name="email"
                                                            class="form-control" />
                                                        <?php if (isset($errors['email'])) : ?>
                                                            <code><?= $errors['email'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="quantity">Number of Year(s)</label>
                                                        <input name="years"
                                                            type="number"
                                                            value="<?= get_var('years', $row->years) ?>"
                                                            class="form-control"
                                                            id="years"
                                                            placeholder="20" />
                                                        <?php if (isset($errors['years'])) : ?>
                                                            <code><?= $errors['years'] ?></code>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="cost_price">Shop Phone</label>
                                                        <input name="phone"
                                                            type="text"
                                                            value="<?= get_var('phone', $row->phone) ?>"
                                                            class="form-control"
                                                            id="phone"
                                                            placeholder="024 *** ****" />
                                                        <?php if (isset($errors['phone'])) : ?>
                                                            <code><?= $errors['phone'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cost_price">Initials</label>
                                                        <input name="initials"
                                                            type="text"
                                                            value="<?= get_var('initials', $row->initials) ?>"
                                                            class="form-control"
                                                            id="initials"
                                                            placeholder="X X X" />
                                                        <?php if (isset($errors['initials'])) : ?>
                                                            <code><?= $errors['initials'] ?></code>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <h4>Logo</h4>
                                                        <?php
                                                        // Default placeholder
                                                        $imageUrl = ASSETS . "/images/male_user.png";

                                                        // Case 1: Row being edited with stored picture
                                                        if (!empty($row_to_edit) && !empty($row_to_edit[0]['picture'])) {
                                                            $imageUrl = ROOT . "/uploads/" . $row_to_edit[0]['picture'];
                                                        }
                                                        // Case 2: Logged in user already has an image
                                                        if ($row->logo) {
                                                            $imageUrl = ROOT . "/" . $row->logo;
                                                        }
                                                        ?>

                                                        <!-- Show old image first -->
                                                        <img
                                                            src="<?= $imageUrl ?>"
                                                            id="imageDisplay"
                                                            class="d-block mx-auto border border-primary mb-1"
                                                            style="width:120px; height:120px; object-fit:cover; border-radius:50%"
                                                            alt="">

                                                        <!-- File input -->
                                                        <input
                                                            type="file"
                                                            class="form-control mt-2"
                                                            name="logo"
                                                            id="fileInput"
                                                            accept="image/*">

                                                        <!-- Server-side error -->
                                                        <?php if (isset($errors['logo'])): ?>
                                                            <div class="alert alert-warning alert-dismissible mt-2" role="alert">
                                                                <?= $errors['logo'] ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- File info -->
                                                        <small class="file_info text-muted d-block mt-1"></small>
                                                    </div>

                                                    <script>
                                                        $(function() {
                                                            // Keep old image in memory
                                                            const oldImage = $('#imageDisplay').attr('src');

                                                            $('#fileInput').on('change', function() {
                                                                const input = this;
                                                                const file = input.files && input.files[0] ? input.files[0] : null;

                                                                if (!file) {
                                                                    // If user cancels → revert back to old image
                                                                    $('#imageDisplay').attr('src', oldImage);
                                                                    $('.file_info').text('');
                                                                    return;
                                                                }

                                                                // Validate type
                                                                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                                                                if ($.inArray(file.type, validTypes) === -1) {
                                                                    alert('Please select an image (JPG, PNG, GIF, or WEBP).');
                                                                    $(input).val(''); // reset input
                                                                    $('#imageDisplay').attr('src', oldImage); // revert
                                                                    return;
                                                                }

                                                                // Validate size (< 3 MB)
                                                                if (file.size > 3 * 1024 * 1024) {
                                                                    alert('Image size must be less than 3 MB.');
                                                                    $(input).val('');
                                                                    $('#imageDisplay').attr('src', oldImage);
                                                                    return;
                                                                }

                                                                // Preview new file
                                                                const reader = new FileReader();
                                                                reader.onload = function(e) {
                                                                    $('#imageDisplay').attr('src', e.target.result);
                                                                    $('.file_info').text('New File: ' + file.name + ' (' + (file.size / 1048576).toFixed(2) + ' MB)');
                                                                };
                                                                reader.readAsDataURL(file);
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-primary">Update Shop</button>
                                            <a href="<?= HOME ?>/products" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            <?php else: ?>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Shop Users</div>
                                </div>

                                <div class="card-body">
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
                                                <?php if ($adminData): ?>
                                                    <?php foreach ($adminData as $user): ?>

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
                                    <?php $pager->display($adminData ? count($adminData) : 0); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>