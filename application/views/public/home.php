<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="hero-section py-5">

<div class="container">

<div class="text-center">

<h1 class="display-5 fw-bold mb-3">

Welcome to Nazmu Blog

</h1>

<p class="lead text-muted">

Blog Ngahuleng

</p>

</div>

</div>

</section>

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

<style>

.hero-section{
background:
linear-gradient(
135deg,
#f8fafc,
#eef2ff
);
border-bottom:
1px solid #eee;
}

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