<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<?php

$embed_url = '';

/*
|--------------------------------------------------------------------------
| YOUTUBE
|--------------------------------------------------------------------------
*/
if(
    $tutorial->video_type
    == 'youtube'
){

    preg_match(
        '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
        $tutorial->video_url,
        $match
    );

    $video_id =
        $match[1]
        ?? '';

    if($video_id){

        $embed_url =
            'https://www.youtube.com/embed/' .
            $video_id;

    }

}

/*
|--------------------------------------------------------------------------
| TIKTOK
|--------------------------------------------------------------------------
*/
elseif(
    $tutorial->video_type
    == 'tiktok'
){

    $embed_url =
        $tutorial->video_url;

}

/*
|--------------------------------------------------------------------------
| VIMEO
|--------------------------------------------------------------------------
*/
elseif(
    $tutorial->video_type
    == 'vimeo'
){

    preg_match(
        '/vimeo\.com\/([0-9]+)/',
        $tutorial->video_url,
        $match
    );

    $video_id =
        $match[1]
        ?? '';

    if($video_id){

        $embed_url =
            'https://player.vimeo.com/video/' .
            $video_id;

    }

}

?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <!-- TITLE -->
            <div class="mb-4">

                <h1 class="fw-bold">

                    <?= $tutorial->title; ?>

                </h1>

                <div class="text-muted">

                    <?= ucfirst(
                        $tutorial->video_type
                    ); ?>

                    •

                    <?= number_format(
                        $tutorial->views
                    ); ?>

                    views

                </div>

            </div>

            <!-- VIDEO -->
            <div class="card
                        border-0
                        shadow-sm
                        rounded-4
                        overflow-hidden
                        mb-4">

                <div class="ratio ratio-16x9">

                    <?php if(
                        $tutorial->video_type
                        == 'youtube'
                        ||
                        $tutorial->video_type
                        == 'vimeo'
                    ): ?>

                        <iframe
                            src="<?= $embed_url; ?>"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>

                    <?php elseif(
                        $tutorial->video_type
                        == 'tiktok'
                    ): ?>

                        <iframe
                            src="<?= $embed_url; ?>"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>

                    <?php else: ?>

                        <div class="p-5 text-center">

                            <a href="<?= $tutorial->video_url; ?>"
                               target="_blank"
                               class="btn btn-primary rounded-pill">

                                Buka Video

                            </a>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div class="card
                        border-0
                        shadow-sm
                        rounded-4
                        mb-5">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-3">

                        Deskripsi Tutorial

                    </h4>

                    <div class="text-muted">

                        <?= nl2br(
                            $tutorial->description
                        ); ?>

                    </div>

                </div>

            </div>

            <!-- RELATED -->
            <?php if(!empty($related)): ?>

                <div class="mb-3">

                    <h3 class="fw-bold">

                        Tutorial Lainnya

                    </h3>

                </div>

                <div class="row">

                    <?php foreach(
                        $related
                        as $item
                    ): ?>

                        <div class="col-md-4 mb-4">

                            <a href="<?= site_url(
                                'tutorial/' .
                                $item->slug
                            ); ?>"
                               class="text-decoration-none">

                                <div class="card
                                            border-0
                                            shadow-sm
                                            rounded-4
                                            h-100">

                                    <div class="card-body">

                                        <span class="badge bg-danger mb-3">

                                            <?= ucfirst(
                                                $item->video_type
                                            ); ?>

                                        </span>

                                        <h5 class="fw-bold text-dark">

                                            <?= $item->title; ?>

                                        </h5>

                                        <p class="text-muted small">

                                            <?= word_limiter(
                                                strip_tags(
                                                    $item->description
                                                ),
                                                10
                                            ); ?>

                                        </p>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php $this->load->view('public/layout/footer'); ?>