<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<div class="container py-5">

    <div class="mb-4 text-center">

        <h1 class="fw-bold">
            Download Center
        </h1>

        <p class="text-muted">

            Download berbagai file
            yang tersedia.

        </p>

    </div>

    <!-- SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <div class="input-group">

                <span class="input-group-text bg-white border-end-0">

                    <i class="fas fa-search text-muted"></i>

                </span>

                <input type="text"
                       id="searchDownload"
                       class="form-control border-start-0 ps-0"
                       placeholder="Cari file download...">

            </div>

        </div>

    </div>

    <!-- CATEGORY FILTER -->
    <div class="mb-4">

        <div class="d-flex flex-wrap gap-2 justify-content-center">

            <a href="<?= site_url('download-center'); ?>"
               class="btn rounded-pill <?= !isset($category)
                    ? 'btn-primary'
                    : 'btn-outline-primary'; ?>">

                Semua

            </a>

            <?php if(!empty($download_categories)): ?>

                <?php foreach($download_categories as $cat): ?>

                    <a href="<?= site_url(
                        'download-center/category/' .
                        $cat->slug
                    ); ?>"
                       class="btn rounded-pill <?= (
                            isset($category)
                            &&
                            $category->id == $cat->id
                       )
                            ? 'btn-primary'
                            : 'btn-outline-primary'; ?>">

                        <?= $cat->name; ?>

                    </a>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

    <div class="row"
         id="downloadWrapper">

        <?php if(!empty($downloads)): ?>

            <?php foreach($downloads as $file): ?>

                <?php

                $ext = '-';

                if(
                    !empty(
                        $file->file_type
                    )
                ){

                    $ext =
                        strtolower(
                            str_replace(
                                '.',
                                '',
                                $file->file_type
                            )
                        );

                }
                elseif(
                    $file->file_source
                    == 'external'
                ){

                    if(
                        strpos(
                            $file->file_path,
                            'drive.google.com'
                        ) !== false
                    ){

                        $ext = 'gdrive';

                    }
                    elseif(
                        strpos(
                            $file->file_path,
                            'dropbox'
                        ) !== false
                    ){

                        $ext = 'dropbox';

                    }
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

                <div class="col-md-4 mb-4 download-item"
                     data-title="<?= strtolower(
                        $file->title
                     ); ?>"
                     data-description="<?= strtolower(
                        strip_tags(
                            $file->description
                        )
                     ); ?>">

                    <div class="card shadow-sm border-0 rounded-4 h-100">

                        <div class="card-body d-flex flex-column">

                            <!-- FILE TYPE -->
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

                            <!-- TITLE -->
                            <h5 class="fw-bold">

                                <?= $file->title; ?>

                            </h5>

                            <!-- DESCRIPTION -->
                            <p class="text-muted small flex-grow-1">

                                <?= word_limiter(
                                    strip_tags(
                                        $file->description
                                    ),
                                    15
                                ); ?>

                            </p>

                            <!-- META -->
                            <div class="small text-muted mb-3">

                                <div>

                                    <strong>Size:</strong>
                                    <?= $file->file_size ?: '-'; ?>

                                </div>

                                <div>

                                    <strong>Downloaded:</strong>
                                    <?= $file->total_download; ?>x

                                </div>

                            </div>

                            <!-- BUTTON -->
                            <a href="<?= site_url(
                                'download-center/file/' .
                                $file->slug
                            ); ?>"
                               class="btn btn-primary w-100 rounded-pill">

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

<script>

document
.getElementById(
    'searchDownload'
)
.addEventListener(
    'keyup',
    function(){

        let keyword =
            this.value
            .toLowerCase()
            .trim();

        let items =
            document.querySelectorAll(
                '.download-item'
            );

        items.forEach(function(item){

            let title =
                item.dataset.title;

            let description =
                item.dataset.description;

            let found =
                title.includes(keyword)
                ||
                description.includes(keyword);

            item.style.display =
                found
                ? 'block'
                : 'none';

        });

    }
);

</script>

<?php $this->load->view('public/layout/footer'); ?>