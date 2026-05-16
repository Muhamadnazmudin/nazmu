<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="article-hero">

    <div class="container text-center">

        <span class="hero-badge">
            📂 Category
        </span>

        <h1 class="hero-title">
            <?= $category->name ?>
        </h1>

        <p class="hero-subtitle">
            <?= count($posts) ?>
            artikel ditemukan dalam kategori ini
        </p>

        <div class="hero-meta">

            <span>
                <?= count($posts) ?>
                Artikel
            </span>

            <span>
                <?= count($categories) ?>
                Kategori
            </span>

        </div>

    </div>

</section>

<div class="content-section">
<div class="container py-5">

<div class="row">

<!-- CONTENT -->
<div class="col-lg-8">

<?php if(empty($posts)): ?>

<div class="card border-0 shadow-sm">

<div class="card-body text-center py-5">

<h4>

Belum ada artikel

</h4>

<p class="text-muted">

Belum ada artikel
dalam kategori ini.

</p>

</div>

</div>

<?php endif; ?>

<div class="row">

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

<!-- CATEGORIES -->
<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<h5 class="mb-3">

Categories

</h5>

<ul class="list-group list-group-flush">

    <!-- ALL CATEGORY -->
    <li class="list-group-item px-0">

        <a href="<?= base_url('articles') ?>"
        class="text-decoration-none
        <?= uri_string() == 'articles'
            ? 'fw-bold text-primary'
            : '' ?>">

            📰 Semua Artikel

        </a>

    </li>

    <?php foreach($categories as $cat): ?>

    <li class="list-group-item px-0">

        <a href="<?= base_url('category/'.$cat->slug) ?>"
        class="text-decoration-none
        <?= $category->id == $cat->id
            ? 'fw-bold text-primary'
            : '' ?>">

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

/* SIDEBAR CATEGORY */
.list-group-item a{
	color:#374151 !important;
	font-weight:500;
}

.list-group-item a:hover{
	color:var(--primary,#2563eb)
	!important;

	text-decoration:none;
}

/* ACTIVE CATEGORY */
.text-primary{
	color:
	var(--primary,#2563eb)
	!important;
}

/* POPULAR POST */
.card-body a.text-dark{
	color:#111827 !important;
}

.card-body a.text-dark:hover{
	color:
	var(--primary,#2563eb)
	!important;

	text-decoration:none;
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
</div>
</div>
<?php $this->load->view('public/layout/footer'); ?>