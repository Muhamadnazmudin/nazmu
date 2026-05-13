<?php $this->load->view(
'admin/layout/header'
); ?>

<?php $this->load->view(
'admin/layout/navbar'
); ?>

<?php $this->load->view(
'admin/layout/sidebar'
); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex
justify-content-between
align-items-center">

<div>

<h1 class="mb-1">

Dashboard

</h1>

<small class="text-muted">

Selamat datang di
<?= $setting->site_name ?>

</small>

</div>

<div>

<a href="<?= base_url() ?>"
target="_blank"
class="btn btn-primary">

<i class="fas fa-globe"></i>

Lihat Website

</a>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<!-- HERO -->
<div class="card border-0 shadow-sm mb-4">

<div class="card-body p-4">

<div class="row align-items-center">

<div class="col-md-8">

<h2 class="font-weight-bold mb-2">

Halo,
<?= $this->session
->userdata('nama'); ?> 👋

</h2>

<p class="text-muted mb-0">

Selamat datang di
<strong>

<?= $setting->site_name ?>

</strong>

dashboard administrator.

Kelola artikel,
media library,
SEO,
pengguna,
dan pengaturan website
dengan mudah.

</p>

</div>

<div class="col-md-4 text-md-right mt-3 mt-md-0">

<?php if(
!empty(
$setting->logo
)
): ?>

<img src="<?= base_url(
'uploads/media/' .
$setting->logo
) ?>"
style="
height:70px;
max-width:150px;
object-fit:contain;
">

<?php endif; ?>

</div>

</div>

</div>

</div>

<!-- QUICK MENU -->
<div class="row">

<!-- ARTIKEL -->
<div class="col-lg-3 col-md-6">

<div class="small-box bg-primary">

<div class="inner">

<h3>

<?= $total_posts ?>

</h3>

<p>

Total Artikel

</p>

</div>

<div class="icon">

<i class="fas fa-newspaper"></i>

</div>

<a href="<?= base_url(
'admin/posts'
) ?>"
class="small-box-footer">

Kelola Artikel
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

<!-- MEDIA -->
<div class="col-lg-3 col-md-6">

<div class="small-box bg-success">

<div class="inner">

<h3>

<?= $total_media ?>

</h3>

<p>

Media Library

</p>

</div>

<div class="icon">

<i class="fas fa-photo-video"></i>

</div>

<a href="<?= base_url(
'admin/media'
) ?>"
class="small-box-footer">

Kelola Media
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

<!-- KOMENTAR -->
<div class="col-lg-3 col-md-6">

<div class="small-box bg-warning">

<div class="inner">

<h3>

<?= $total_comments ?>

</h3>

<p>

Total Komentar

</p>

</div>

<div class="icon">

<i class="fas fa-comments"></i>

</div>

<a href="<?= base_url(
'admin/comments'
) ?>"
class="small-box-footer">

Kelola Komentar
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

<!-- KATEGORI -->
<div class="col-lg-3 col-md-6">

<div class="small-box bg-danger">

<div class="inner">

<h3>

<?= $total_categories ?>

</h3>

<p>

Kategori

</p>

</div>

<div class="icon">

<i class="fas fa-list"></i>

</div>

<a href="<?= base_url(
'admin/categories'
) ?>"
class="small-box-footer">

Kelola Kategori
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="small-box bg-danger">

<div class="inner">

<h4>
Settings
</h4>

<p>
Pengaturan Website
</p>

</div>

<div class="icon">

<i class="fas fa-cogs"></i>

</div>

<a href="<?= base_url(
'admin/settings'
) ?>"
class="small-box-footer">

Kelola
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

</div>

<!-- INFO -->
<div class="card shadow-sm border-0">

<div class="card-header
bg-white">

<h5 class="mb-0">

Informasi Website

</h5>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4 mb-3">

<strong>
Nama Website
</strong>

<p class="mb-0 text-muted">

<?= $setting->site_name ?>

</p>

</div>

<div class="col-md-4 mb-3">

<strong>
Tagline
</strong>

<p class="mb-0 text-muted">

<?= $setting->tagline ?>

</p>

</div>

<div class="col-md-4 mb-3">

<strong>
Email
</strong>

<p class="mb-0 text-muted">

<?= $setting->email ?>

</p>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>