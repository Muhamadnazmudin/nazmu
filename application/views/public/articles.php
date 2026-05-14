<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="hero-section py-5">

<div class="container text-center">

<span class="badge bg-primary mb-3">

📰 All Articles

</span>

<h1 class="display-5 fw-bold">

Semua Artikel

</h1>

<p class="text-muted">

<?= count($posts) ?>
artikel tersedia

</p>

</div>

</section>

<div class="container py-5">

<div class="row">

<!-- CONTENT -->
<div class="col-lg-8">

<div class="row">

<?php if(empty($posts)): ?>

<div class="col-12">

<div class="card border-0 shadow-sm">

<div class="card-body text-center py-5">

<h4>

Belum ada artikel

</h4>

<p class="text-muted">

Artikel akan muncul di sini.

</p>

</div>

</div>

</div>

<?php endif; ?>

<?php foreach($posts as $post): ?>

<div class="col-md-6 mb-4">

<div class="card post-card border-0 shadow-sm h-100">

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

<input type="text"
name="q"
class="form-control"
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

Categories

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
padding:80px 0;
}

/* FIX TEXT HERO */
/* .hero-section h1{
color:#111827 !important;
font-weight:800;
}

.hero-section p{
color:#6b7280 !important;
font-size:18px;
} */

.hero-section .badge{
font-size:14px;
padding:8px 14px;
}

/* CARD */
.post-card{
border-radius:18px;
overflow:hidden;
transition:.3s;
}

.post-card:hover{
transform:
translateY(-6px);
}

.post-image{
width:100%;
height:220px;
object-fit:cover;
}

@media(max-width:768px){

.post-image{
height:200px;
}

}

</style>

<?php $this->load->view('public/layout/footer'); ?>