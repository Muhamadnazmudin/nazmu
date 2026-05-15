<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<div class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="fw-bold">

            Tutorial

        </h1>

        <p class="text-muted">

            Pelajari penggunaan sistem
            melalui video tutorial.

        </p>

    </div>

    <!-- SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">

        <div class="card-body p-3">

            <div class="input-group">

                <span class="input-group-text
                             bg-white
                             border-end-0">

                    <i class="fas fa-search text-muted"></i>

                </span>

                <input type="text"
                       id="searchTutorial"
                       class="form-control
                              border-start-0"
                       placeholder="Cari tutorial...">

            </div>

        </div>

    </div>

    <!-- GRID -->
    <div class="row">

        <?php if(!empty($tutorials)): ?>

            <?php foreach(
                $tutorials
                as $tutorial
            ): ?>

                <?php

$thumbnail = '';

/*
|--------------------------------------------------------------------------
| YOUTUBE THUMBNAIL
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

        $thumbnail =
            'https://img.youtube.com/vi/' .
            $video_id .
            '/hqdefault.jpg';

    }

}

/*
|--------------------------------------------------------------------------
| TIKTOK THUMBNAIL
|--------------------------------------------------------------------------
*/
elseif(
    $tutorial->video_type
    == 'tiktok'
){

    /*
    fallback thumbnail
    dari admin upload
    */
    if(
        !empty(
            $tutorial->thumbnail
        )
    ){

        $thumbnail =
            $tutorial->thumbnail;

    }
    else{

        /*
        thumbnail default
        kalau kosong
        */
        $thumbnail =
            base_url(
                'assets/public/img/tiktok-placeholder.jpg'
            );

    }

}

/*
|--------------------------------------------------------------------------
| OTHER VIDEO
|--------------------------------------------------------------------------
*/
elseif(
    !empty(
        $tutorial->thumbnail
    )
){

    $thumbnail =
        $tutorial->thumbnail;

}
?>

                <div class="col-md-4 mb-4 tutorial-item"
                     data-title="<?= strtolower(
                        $tutorial->title
                     ); ?>">

                    <a href="<?= site_url(
                        'tutorial/' .
                        $tutorial->slug
                    ); ?>"
                       class="text-decoration-none">

                        <div class="tutorial-card">

                            <!-- THUMBNAIL -->
                            <div class="tutorial-thumb">

                                <?php if(
                                    !empty(
                                        $thumbnail
                                    )
                                ): ?>

                                    <img src="<?= $thumbnail; ?>"
                                         alt="<?= $tutorial->title; ?>">

                                <?php endif; ?>

                                <!-- PLAY -->
<div class="play-overlay">

    <?php

    $play_color =
        '#FF0000';

    if(
        $tutorial->video_type
        == 'tiktok'
    ){

        $play_color =
            '#000000';

    }
    elseif(
        $tutorial->video_type
        == 'vimeo'
    ){

        $play_color =
            '#00ADEF';

    }

    ?>

    <svg
        width="90"
        height="64"
        viewBox="0 0 90 64"
        fill="none">

        <rect
            width="90"
            height="64"
            rx="18"
            fill="<?= $play_color; ?>"/>

        <path
            d="M58 32L37 44V20L58 32Z"
            fill="white"/>

    </svg>

</div>

                                <!-- PLATFORM -->
                                <div class="platform-badge">

                                    <?php if(
                                        $tutorial->video_type
                                        ==
                                        'youtube'
                                    ): ?>

                                        <span class="badge bg-danger">

                                            Youtube

                                        </span>

                                    <?php elseif(
                                        $tutorial->video_type
                                        ==
                                        'tiktok'
                                    ): ?>

                                        <span class="badge"
      style="
      background:#000;
      color:#fff;
      padding:10px 16px;
      border-radius:999px;
      ">

    <i class="fab fa-tiktok"></i>

    TikTok

</span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            Video

                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <!-- CONTENT -->
                            <div class="pt-3">

                                <h4 class="tutorial-title">

                                    <?= $tutorial->title; ?>

                                </h4>

                                <p class="tutorial-desc">

                                    <?= word_limiter(
                                        strip_tags(
                                            $tutorial->description
                                        ),
                                        12
                                    ); ?>

                                </p>

                            </div>

                        </div>

                    </a>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="alert alert-info rounded-4">

                    Belum ada tutorial.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<style>

.tutorial-card{
transition:.3s ease;
}

.tutorial-card:hover{
transform:
translateY(-8px);
}

.tutorial-thumb{
position:relative;
overflow:hidden;
border-radius:26px;
box-shadow:
0 12px 30px
rgba(0,0,0,.12);
}

.tutorial-thumb img{
width:100%;
height:250px;
object-fit:cover;
transition:.35s ease;
}

.tutorial-card:hover
.tutorial-thumb img{
transform:scale(1.06);
}

.play-overlay{
position:absolute;
top:50%;
left:50%;
transform:
translate(-50%,-50%);
transition:.3s;
}

.tutorial-card:hover
.play-overlay{
transform:
translate(-50%,-50%)
scale(1.08);
}

.platform-badge{
position:absolute;
top:18px;
left:18px;
z-index:5;
}

.platform-badge .badge{
font-size:14px;
padding:
10px 16px;
border-radius:999px;
}

.tutorial-title{
font-size:22px;
font-weight:700;
color:#0f172a;
line-height:1.4;
margin-bottom:8px;
}

.tutorial-desc{
font-size:15px;
color:#64748b;
margin-bottom:0;
}

</style>

<script>

document
.getElementById(
    'searchTutorial'
)
.addEventListener(
    'keyup',
    function(){

        let keyword =
            this.value
            .toLowerCase();

        let items =
            document.querySelectorAll(
                '.tutorial-item'
            );

        items.forEach(function(item){

            let title =
                item.dataset.title;

            item.style.display =
                title.includes(keyword)
                ? 'block'
                : 'none';

        });

    }
);

</script>

<?php $this->load->view('public/layout/footer'); ?>