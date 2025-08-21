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
                                <a href="#">Add Shop</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Add Shop</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Shop Name</label>
                                                    <input
                                                        type="text"
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
                                                        id="successInput"
                                                        name="address"
                                                        class="form-control" />
                                                    <?php if (isset($errors['shopname'])) : ?>
                                                        <code><?= $errors['shopname'] ?></code>
                                                    <?php endif; ?>
                                                </div>

                                            </div>


                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="successInput">Shop Location</label>
                                                    <input
                                                        type="text"
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
                                                        id="successInput"
                                                        name="email"
                                                        class="form-control" />
                                                    <?php if (isset($errors['email'])) : ?>
                                                        <code><?= $errors['email'] ?></code>
                                                    <?php endif; ?>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="quantity">Number of Year(s)</label>
                                                    <select name="years" class="form-select form-control-lg" id="largeSelect">
                                                        <option value="1">1 Year</option>
                                                        <option value="2">2 Years</option>
                                                        <option value="3">3 Years</option>
                                                        <option value="4">5 Years</option>
                                                    </select>
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
                                                        class="form-control"
                                                        id="initials"
                                                        placeholder="X X X" />
                                                    <?php if (isset($errors['initials'])) : ?>
                                                        <code><?= $errors['initials'] ?></code>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-group">
                                                    <h4>Logo</h4>
                                                    <form class="forms-sample" method="POST" enctype="multipart/form-data">

                                                        <!-- Show old image first -->
                                                        <img
                                                            src=""
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
                                                            accept="image/*"
                                                            required>

                                                        <!-- Server-side error -->
                                                        <?php if (isset($errors['logo'])): ?>
                                                            <div class="alert alert-warning alert-dismissible mt-2" role="alert">
                                                                <?= $errors['logo'] ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- File info -->
                                                        <small class="file_info text-muted d-block mt-1"></small>
                                                    </form>
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
                                        <button class="btn btn-primary">Add Shop</button>
                                        <a href="<?= HOME ?>/shops" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>