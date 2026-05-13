<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">

<div class="container">

<!-- LOGO -->
<!-- LOGO -->
<a class="navbar-brand d-flex align-items-center"
href="<?= base_url() ?>">

<?php if(
!empty(
$setting->logo
)
): ?>

<img src="<?= base_url(
'uploads/media/' .
$setting->logo
) ?>"
alt="Logo"
style="
height:42px;
width:auto;
object-fit:contain;
margin-right:10px;
">

<?php else: ?>

<div class="brand-logo">

<?= strtoupper(
substr(
$setting->site_name
?? 'N',
0,
1
)
) ?>

</div>

<?php endif; ?>

<div>

<div style="
font-weight:700;
font-size:18px;
line-height:1.2;
color:#111827;
">

<?= $setting->site_name
?? 'Website' ?>

</div>

<small style="
font-size:11px;
color:#6b7280;
display:block;
line-height:1;
">

<?= $setting->tagline
?? 'Website Modern' ?>

</small>

</div>

</a>

<!-- MOBILE BUTTON -->
<button class="navbar-toggler border-0 shadow-none"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<i class="bi bi-list fs-2"></i>

</button>

<!-- MENU -->
<div class="collapse navbar-collapse"
id="navbarNav">

<ul class="navbar-nav mx-auto align-items-lg-center">

<!-- HOME -->
<li class="nav-item">

<a class="nav-link"
href="<?= base_url() ?>">

Home

</a>

</li>

<!-- ARTIKEL -->
<li class="nav-item">

<a class="nav-link"
href="<?= base_url('articles') ?>">

Artikel

</a>

</li>

<!-- CATEGORY -->
<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle"
href="#"
role="button"
data-bs-toggle="dropdown"
aria-expanded="false">

Kategori

</a>

<ul class="dropdown-menu shadow border-0 rounded-4">

<?php if(!empty($categories)): ?>

<?php foreach($categories as $cat): ?>

<li>

<a class="dropdown-item py-2"
href="<?= base_url(
'category/' .
$cat->slug
) ?>">

<?= $cat->name ?>

</a>

</li>

<?php endforeach; ?>

<?php else: ?>

<li>

<span class="dropdown-item text-muted">

Belum ada kategori

</span>

</li>

<?php endif; ?>

</ul>

</li>

<!-- ABOUT -->
<li class="nav-item">

<a class="nav-link"
href="#">

About

</a>

</li>

</ul>

<!-- SEARCH -->
<form class="d-flex"
action="<?= base_url('search') ?>"
method="GET">

<div class="search-box">

<i class="bi bi-search"></i>

<input type="text"
name="q"
placeholder="Cari artikel..."
autocomplete="off">

</div>

</form>

</div>

</div>

</nav>