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

$ext = '-';

if(
    !empty($file->file_type)
){

    $ext =
        strtolower(
            str_replace(
                '.',
                '',
                $file->file_type
            )
        );

}elseif(
    $file->file_source
    == 'external'
){

    // Google Drive
    if(
        strpos(
            $file->file_path,
            'drive.google.com'
        ) !== false
    ){

        $ext = 'gdrive';

    }

    // Dropbox
    elseif(
        strpos(
            $file->file_path,
            'dropbox'
        ) !== false
    ){

        $ext = 'dropbox';

    }

    // OneDrive
    elseif(
        strpos(
            $file->file_path,
            'onedrive'
        ) !== false
    ){

        $ext = 'onedrive';

    }

    else{

        $ext = 'link';

    }

}
?>

<div class="mb-3">

    <?php if($ext == 'gdrive'): ?>

        <span class="badge bg-success">

            <i class="fab fa-google-drive"></i>
            Google Drive

        </span>

    <?php elseif($ext == 'pdf'): ?>

        <span class="badge bg-danger">

            PDF

        </span>

    <?php elseif(
        in_array(
            $ext,
            ['doc','docx']
        )
    ): ?>

        <span class="badge bg-primary">

            WORD

        </span>

    <?php elseif(
        in_array(
            $ext,
            ['xls','xlsx']
        )
    ): ?>

        <span class="badge bg-success">

            EXCEL

        </span>

    <?php elseif(
        in_array(
            $ext,
            ['ppt','pptx']
        )
    ): ?>

        <span class="badge bg-warning text-dark">

            PPT

        </span>

    <?php elseif($ext == 'zip'): ?>

        <span class="badge bg-secondary">

            ZIP

        </span>

    <?php else: ?>

        <span class="badge bg-dark">

            <?= strtoupper($ext); ?>

        </span>

    <?php endif; ?>

</div>

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