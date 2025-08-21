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
                        <h3 class="fw-bold mb-3"></h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">Messages
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Read</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Subject: <?= esc($row->subject) ?></h4>
                                        <a href="#"
                                            class="btn btn-white btn-round ms-auto">

                                        </a>

                                        <form action="" method="post">
                                            <button
                                                name="del"
                                                value="<?= esc($row->id) ?>"
                                                data-bs-toggle="tooltip"
                                                title=""
                                                class="btn btn-danger btn-round ms-auto"
                                                data-original-title="Remove">
                                                <i class="fa fa-trash"> </i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->

                                    <p>
                                        <strong>Name:</strong> <?= esc($row->name) ?><br>
                                        <strong>Email:</strong> <a href="mailto:<?= esc($row->email) ?>"><?= esc($row->email) ?></a><br>
                                        <strong>Phone:</strong> <a href="tel:<?= esc($row->phone) ?>"><?= esc($row->phone) ?></a><br>
                                        <strong>Sent At:</strong> <?= date('d M Y H:i:s', strtotime($row->sentdatetime)) ?><br>
                                        <strong>Read At:</strong> <?= $row->read_datetime ? date('d M Y H:i:s', strtotime($row->read_datetime)) : 'Not Read Yet' ?><br>
                                    </p>

                                    <hr>

                                    <strong>Message:</strong>
                                    <hr>
                                    <p>
                                        <?= nl2br(esc($row->message)) ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>