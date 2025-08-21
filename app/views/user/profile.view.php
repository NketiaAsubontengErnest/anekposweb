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
                        <h3 class="fw-bold mb-3">Forms</h3>
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
                                <a href="#">Profile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Personal Details</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">

                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <h4>Change Image</h4>

                                            <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <?php
                                                    // Default placeholder
                                                    $imageUrl = ASSETS . "/images/male_user.png";

                                                    // Case 1: Row being edited with stored picture
                                                    if (!empty($row_to_edit) && !empty($row_to_edit[0]['picture'])) {
                                                        $imageUrl = ROOT . "/uploads/" . $row_to_edit[0]['picture'];
                                                    }
                                                    // Case 2: Logged in user already has an image
                                                    if (Auth::getImage()) {
                                                        $imageUrl = ROOT . "/" . Auth::getImage();
                                                    }
                                                    ?>

                                                    <!-- Show old image first -->
                                                    <img
                                                        src="<?= $imageUrl ?>"
                                                        id="imageDisplay"
                                                        class="d-block mx-auto border border-primary mb-1"
                                                        style="width:120px; height:120px; object-fit:cover; border-radius:50%"
                                                        alt="Profile Picture">

                                                    <!-- File input -->
                                                    <input
                                                        type="file"
                                                        class="form-control mt-2"
                                                        name="image"
                                                        id="fileInput"
                                                        accept="image/*"
                                                        required>

                                                    <!-- Server-side error -->
                                                    <?php if (isset($errors['image'])): ?>
                                                        <div class="alert alert-warning alert-dismissible mt-2" role="alert">
                                                            <?= $errors['image'] ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- File info -->
                                                    <small class="file_info text-muted d-block mt-1"></small>
                                                </div>

                                                <button type="submit" name="img" class="btn btn-success">Save Image</button>
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

                                        <div class="col-md-6 col-lg-4">

                                            <form action="" method="post">
                                                <h4>Change Password</h4>
                                                <div class="form-group">
                                                    <label for="email2">New Password</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="password"
                                                        name="newpassword"
                                                        placeholder="New Password" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Repeat Password</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="password"
                                                        name="reppassword"
                                                        placeholder="Repeat Password" />
                                                </div>
                                                <button name="pass" class="btn btn-success">Change</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>