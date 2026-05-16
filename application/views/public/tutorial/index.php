<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="article-hero">

    <div class="container text-center">

        <span class="hero-badge">
            🎥 Tutorial
        </span>

        <h1 class="hero-title">
            Tutorial
        </h1>

        <p class="hero-subtitle">
            Pelajari penggunaan sistem
            melalui video tutorial
            yang mudah dipahami.
        </p>

        <div class="hero-meta">

            <span>
                <?= count($tutorials) ?>
                Tutorial
            </span>

        </div>

    </div>

</section>

<!-- CONTENT -->
<div class="content-section">

<div class="container py-5">

    <!-- SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">

        <div class="card-body p-3">

            <div class="input-group">

                <span class="input-group-text
                             bg-transparent
                             border-0">

                    <i class="fas fa-search text-muted"></i>

                </span>

                <input type="text"
                       id="searchTutorial"
                       class="form-control border-0"
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

/* YOUTUBE */
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

/* TIKTOK */
elseif(
    $tutorial->video_type
    == 'tiktok'
){

    if(
        !empty(
            $tutorial->thumbnail
        )
    ){

        $thumbnail =
            $tutorial->thumbnail;
    }
    else{

        $thumbnail =
        base_url(
        'assets/public/img/tiktok-placeholder.jpg'
        );
    }
}

/* OTHER */
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

<div class="card tutorial-card border-0 h-100">

    <!-- THUMB -->
    <div class="tutorial-thumb">

        <?php if(!empty($thumbnail)): ?>

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
==
'tiktok'
){

$play_color =
'#000000';

}
elseif(
$tutorial->video_type
==
'vimeo'
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

<span class="badge
bg-dark">

TikTok

</span>

<?php else: ?>

<span class="badge
bg-secondary">

Video

</span>

<?php endif; ?>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="card-body">

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

<div class="card border-0 shadow-sm">

<div class="card-body text-center py-5">

<h4>

Belum ada tutorial

</h4>

<p class="text-muted">

Tutorial akan muncul
di sini.

</p>

</div>

</div>

</div>

<?php endif; ?>

    </div>

</div>
</div>

<style>

/* CARD */
.tutorial-card{
transition:.3s ease;
border-radius:24px;
overflow:hidden;
}

.tutorial-card:hover{
transform:
translateY(-8px);
}

/* THUMB */
.tutorial-thumb{
position:relative;
overflow:hidden;
}

.tutorial-thumb img{
width:100%;
height:240px;
object-fit:cover;
transition:.35s ease;
}

.tutorial-card:hover
.tutorial-thumb img{
transform:scale(1.06);
}

/* PLAY */
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

/* BADGE */
.platform-badge{
position:absolute;
top:18px;
left:18px;
z-index:5;
}

.platform-badge .badge{
font-size:13px;
padding:10px 16px;
border-radius:999px;
}

/* CONTENT */
.tutorial-title{
font-size:22px;
font-weight:700;
line-height:1.4;
margin-bottom:8px;
color:inherit;
}

.tutorial-desc{
font-size:15px;
opacity:.8;
margin-bottom:0;
}

/* SEARCH */
.input-group{
background:
rgba(0,0,0,.03);
border-radius:18px;
overflow:hidden;
}

/* MOBILE */
@media(max-width:768px){

.tutorial-thumb img{
height:220px;
}

.tutorial-title{
font-size:19px;
}

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