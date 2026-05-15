<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<section class="article-wrapper py-5">

<div class="container">

<!-- BREADCRUMB -->
<nav class="mb-4">

<ol class="breadcrumb custom-breadcrumb">

<li class="breadcrumb-item">

<a href="<?= base_url() ?>">

Home

</a>

</li>

<li class="breadcrumb-item active">

<?= character_limiter(
$post->title,
40
) ?>

</li>

</ol>

</nav>

<div class="row justify-content-center">

<div class="col-lg-9">

<!-- BACK -->
<a href="<?= base_url() ?>"
class="btn btn-light shadow-sm mb-4">

<i class="bi bi-arrow-left"></i>

Kembali ke Home

</a>

<!-- ARTICLE -->
<div class="card border-0 shadow-sm overflow-hidden">

<?php if($post->thumbnail): ?>

<img src="<?= base_url('uploads/media/'.$post->thumbnail) ?>"
style="
width:100%;
max-height:450px;
object-fit:cover;">

<?php endif; ?>

<div class="card-body p-lg-5 p-4">

<!-- META -->
<div class="d-flex flex-wrap gap-3 text-muted small mb-3">

<span>

<i class="bi bi-calendar3"></i>

<?= date(
'd M Y',
strtotime(
$post->created_at
)
) ?>

</span>

<span>

<i class="bi bi-eye"></i>

<?= $post->views ?>

views

</span>

<span>

<i class="bi bi-chat-left-text"></i>

<?= count($comments) ?>

komentar

</span>

<?php if(!empty($post->category_name)): ?>

<span class="badge bg-primary">

<?= $post->category_name ?>

</span>

<?php endif; ?>

</div>

<!-- TITLE -->
<h1 class="fw-bold mb-4">

<?= $post->title ?>

</h1>

<!-- EXCERPT -->
<?php if($post->excerpt): ?>

<div class="alert alert-light border">

<?= $post->excerpt ?>

</div>

<?php endif; ?>

<!-- CONTENT -->
<div class="article-content">

<?= $post->content ?>

</div>

</div>

</div>

<!-- COMMENTS -->
<div class="card border-0 shadow-sm mt-5">

<div class="card-body p-4">

<h4 class="mb-4">

Komentar
(<?= count($comments) ?>)

</h4>

<?php if(empty($comments)): ?>

<div class="text-muted">

Belum ada komentar.

Jadilah yang pertama 😊

</div>

<?php endif; ?>

<?php foreach($comments as $comment): ?>

<div class="comment-box">

<div class="d-flex justify-content-between">

<div>

<strong>

<?= $comment->name ?>

</strong>

<div class="small text-muted">

<?= date(
'd M Y H:i',
strtotime(
$comment->created_at
)
) ?>

</div>

</div>

</div>

<p class="mt-2 mb-0">

<?= nl2br(
htmlspecialchars(
$comment->content
)
) ?>

</p>

</div>

<?php endforeach; ?>

</div>

</div>

<!-- COMMENT FORM -->
<div class="card border-0 shadow-sm mt-4">

<div class="card-body p-4">

<h4 class="mb-4">

Tinggalkan Komentar

</h4>

<?php if(
$this->session
->flashdata(
'success'
)
): ?>

<div class="alert alert-success">

<?= $this->session
->flashdata(
'success'
) ?>

</div>

<?php endif; ?>

<form action="<?= base_url('comment/store') ?>"
method="POST">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">

<input type="hidden"
name="post_id"
value="<?= $post->id ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control">

</div>

</div>

<div class="mb-3">

<label>Komentar</label>

<textarea
name="content"
class="form-control"
rows="5"
required></textarea>

</div>

<button type="submit"
class="btn btn-primary">

Kirim Komentar

</button>

</form>

<p class="small text-muted mt-3 mb-0">

Komentar akan tampil setelah disetujui admin.

</p>

</div>

</div>

<!-- FOOTER NAV -->
<div class="text-center mt-5">

<a href="<?= base_url() ?>"
class="btn btn-outline-primary px-4">

← Kembali ke Beranda

</a>

</div>

</div>

</div>

</div>

</section>

<style>

.article-content{
line-height:1.9;
font-size:17px;
}

.article-content img{
max-width:100%;
border-radius:12px;
margin:20px 0;
}

.comment-box{
padding:20px;
border-radius:14px;
background:#f8f9fa;
margin-bottom:20px;
}

@media(max-width:768px){

.article-content{
font-size:16px;
}

}

</style>

<?php $this->load->view('public/layout/footer'); ?>