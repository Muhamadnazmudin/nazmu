<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO SLIDER -->
<?php if(!empty($sliders)): ?>

<section class="hero-slider">

<div id="heroCarousel"
class="carousel slide carousel-fade"
data-ride="carousel"
data-interval="5000"
data-pause="false">

<div class="carousel-inner">

<?php foreach(
$sliders as
$key => $slider
): ?>

<div class="carousel-item
<?= $key == 0
? 'active'
: '' ?>">

<div class="hero-slide"
style="
background-image:
linear-gradient(
rgba(0,0,0,.45),
rgba(0,0,0,.45)
),
url('<?= base_url(
'uploads/sliders/' .
$slider->image
) ?>');
">

<div class="container">

<div class="hero-content">

<?php if(!empty($slider->subtitle)): ?>

<span class="hero-subtitle">

<?= html_escape(
$slider->subtitle
) ?>

</span>

<?php endif; ?>

<h1>

<?= html_escape(
$slider->title
) ?>

</h1>

<p>

<?= nl2br(
html_escape(
$slider->description
)
) ?>

</p>

<?php if(
!empty(
$slider->button_text
)
): ?>

<a href="<?= $slider->button_link ?>"
class="btn
btn-success
btn-lg">

<?= html_escape(
$slider->button_text
) ?>

</a>

<?php endif; ?>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<a class="carousel-control-prev"
href="#heroCarousel"
role="button"
data-slide="prev">

<span class="carousel-control-prev-icon"></span>

</a>

<a class="carousel-control-next"
href="#heroCarousel"
role="button"
data-slide="next">

<span class="carousel-control-next-icon"></span>

</a>

</div>

</section>

<?php endif; ?>

<div class="content-section">

<div class="container pb-5">

<div class="row">

<!-- LEFT CONTENT -->
<div class="col-lg-8">

<!-- FEATURED -->
<?php if($featured): ?>

<div class="mb-5">

<div class="d-flex align-items-center mb-3">

<span class="badge bg-danger me-2">

🔥 Featured

</span>

<h4 class="mb-0">

Artikel Pilihan

</h4>

</div>

<div class="card border-0 shadow-sm overflow-hidden">

<a href="<?= base_url('blog/'.$featured->slug) ?>">

<?php if(!empty($featured->thumbnail)): ?>

<img src="<?= base_url('uploads/media/'.$featured->thumbnail) ?>"
class="featured-image">

<?php else: ?>

<img src="https://placehold.co/1200x500?text=No+Image"
class="featured-image">

<?php endif; ?>

</a>

<div class="card-body p-4">

<div class="small text-muted mb-2">

<?= date(
'd M Y',
strtotime(
$featured->published_at
)
) ?>

•

<?= $featured->category_name ?? 'Uncategorized' ?>

</div>

<h2 class="fw-bold">

<?= $featured->title ?>

</h2>

<p class="text-muted">

<?= character_limiter(
strip_tags(
$featured->excerpt
),
180
) ?>

</p>

<a href="<?= base_url('blog/'.$featured->slug) ?>"
class="btn btn-primary">

Baca Selengkapnya

</a>

</div>

</div>

</div>

<?php endif; ?>

<!-- LATEST POSTS -->
<div class="d-flex align-items-center mb-4">

<span class="badge bg-primary me-2">

📰 Latest

</span>

<h4 class="mb-0">

Artikel Terbaru

</h4>

</div>

<div class="row">

<?php foreach($posts as $post): ?>

<div class="col-md-6 mb-4">

<div class="card h-100 border-0 shadow-sm post-card">

<a href="<?= base_url('blog/'.$post->slug) ?>">

<?php if(!empty($post->thumbnail)): ?>

<img src="<?= base_url('uploads/media/'.$post->thumbnail) ?>"
class="post-image">

<?php else: ?>

<img src="https://placehold.co/700x400?text=No+Image"
class="post-image">

<?php endif; ?>

</a>

<div class="card-body">

<div class="small text-muted mb-2">

<?= date(
'd M Y',
strtotime(
$post->published_at
)
) ?>

•

<?= $post->category_name ?? '-' ?>

</div>

<h5 class="fw-bold">

<?= character_limiter(
$post->title,
60
) ?>

</h5>

<p class="text-muted">

<?= character_limiter(
strip_tags(
$post->excerpt
),
100
) ?>

</p>

<a href="<?= base_url('blog/'.$post->slug) ?>"
class="btn btn-outline-primary btn-sm">

Read More →

</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<!-- SIDEBAR -->
<div class="col-lg-4">

<!-- SEARCH -->
<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<h5 class="mb-3">

Search

</h5>

<form action="<?= base_url('search') ?>"
method="GET">

<div class="input-group">

<input class="form-control"
type="text"
name="q"
placeholder="Cari artikel...">

<button class="btn btn-primary">

Cari

</button>

</div>

</form>

</div>

</div>

<!-- CATEGORY -->
<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<h5 class="mb-3">

Kategori

</h5>

<ul class="list-group list-group-flush">

<?php foreach($categories as $cat): ?>

<li class="list-group-item px-0">

<a href="<?= base_url('category/'.$cat->slug) ?>"
class="text-decoration-none">

<?= $cat->name ?>

</a>

</li>

<?php endforeach; ?>

</ul>

</div>

</div>

<!-- POPULAR POSTS -->
<div class="card border-0 shadow-sm">

<div class="card-body">

<h5 class="mb-4">

Popular Posts

</h5>

<?php foreach($popular_posts as $pop): ?>

<div class="d-flex mb-3">

<?php if(!empty($pop->thumbnail)): ?>

<img src="<?= base_url('uploads/media/'.$pop->thumbnail) ?>"
style="
width:80px;
height:60px;
object-fit:cover;
border-radius:10px;
margin-right:12px;
">

<?php endif; ?>

<div>

<a href="<?= base_url('blog/'.$pop->slug) ?>"
class="fw-semibold text-dark text-decoration-none">

<?= character_limiter(
$pop->title,
45
) ?>

</a>

<div class="small text-muted">

<?= $pop->views ?>

views

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</div>

</div>

</div>
</div>
<style>
.content-section{
position:relative;
margin-top:-80px;
z-index:20;
background:#fff;
border-radius:40px 40px 0 0;
padding-top:45px;
box-shadow:
0 -10px 30px
rgba(0,0,0,.04);
}

.hero-slider{
position:relative;
z-index:1;
}
.hero-slide{
height:520px;
background-size:cover;
background-position:center;
display:flex;
align-items:center;
color:#fff;
}

.hero-content{
max-width:650px;
}

.hero-subtitle{
display:inline-block;
padding:8px 16px;
border-radius:999px;
background:
rgba(255,255,255,.18);
backdrop-filter:blur(8px);
margin-bottom:18px;
font-size:14px;
}

.hero-content h1{
font-size:52px;
font-weight:800;
margin-bottom:18px;
line-height:1.15;
color:#fff !important;
}

.hero-content p{
font-size:18px;
line-height:1.8;
color:
rgba(255,255,255,.92)
!important;
margin-bottom:24px;
}

.carousel-control-prev,
.carousel-control-next{
width:7%;
}

@media(max-width:768px){

.hero-slide{
height:420px;
padding:40px 0;
}

.hero-content h1{
font-size:34px;
}

.hero-content p{
font-size:16px;
}

}

/* FIX HERO TEXT */
/* .hero-section h1{
color:#111827 !important;
font-weight:800;
}

.hero-section p{
color:#6b7280 !important;
font-size:18px;
} */

.featured-image{
width:100%;
height:400px;
object-fit:cover;
}

.post-image{
width:100%;
height:220px;
object-fit:cover;
}

.post-card{
transition:.3s;
border-radius:16px;
overflow:hidden;
}

.post-card:hover{
transform:
translateY(-6px);
}

@media(max-width:768px){

.featured-image{
height:240px;
}

.post-image{
height:200px;
}

}

</style>


<?php $this->load->view('public/layout/footer'); ?>