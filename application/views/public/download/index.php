<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<div class="container py-5">

    <div class="mb-4">

        <h1 class="fw-bold">
            Download Center
        </h1>

        <p class="text-muted">

            Download berbagai file
            yang tersedia.

        </p>

    </div>

    <div class="row">

        <?php if(!empty($downloads)): ?>

            <?php foreach($downloads as $file): ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow-sm border-0 rounded-4 h-100">

                        <div class="card-body">

                            <div class="mb-3">

                                <?php
                                $ext = strtolower(
                                    $file->file_type
                                );
                                ?>

                                <span class="badge bg-primary">

                                    <?= strtoupper($ext); ?>

                                </span>

                            </div>

                            <h5 class="fw-bold">

                                <?= $file->title; ?>

                            </h5>

                            <p class="text-muted small">

                                <?= word_limiter(
                                    strip_tags(
                                        $file->description
                                    ),
                                    15
                                ); ?>

                            </p>

                            <div class="small text-muted mb-3">

                                Size:
                                <?= $file->file_size ?: '-'; ?>

                                <br>

                                Downloaded:
                                <?= $file->total_download; ?>x

                            </div>

                            <a href="<?= base_url(
                                'download/file/' .
                                $file->slug
                            ) ?>"
                               class="btn btn-primary w-100">

                                <i class="fas fa-download"></i>

                                Download

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="alert alert-info rounded-4">

                    Belum ada file download.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php $this->load->view('public/layout/footer'); ?>