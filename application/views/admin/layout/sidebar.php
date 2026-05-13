<aside class="main-sidebar sidebar-dark-primary elevation-4">

<!-- BRAND -->
<a href="<?= base_url('admin') ?>"
class="brand-link">

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
class="brand-logo">

<?php endif; ?>

<div class="brand-content">

<div class="brand-title">

<?= $setting->site_name ?>

</div>

<small class="brand-subtitle">

<?= $setting->tagline ?>

</small>

</div>

</a>

<div class="sidebar">

<!-- USER PANEL -->
<div class="user-panel d-flex">

<div class="image">

<?php if(
!empty(
$this->session
->userdata(
'photo'
)
)
): ?>

<img src="<?= base_url(
'uploads/users/' .
$this->session
->userdata(
'photo'
)
) ?>"
class="img-circle elevation-2"
style="
width:45px;
height:45px;
object-fit:cover;
"
alt="User Image">

<?php else: ?>

<img src="<?= base_url(
'assets/admin/dist/img/user2-160x160.jpg'
) ?>"
class="img-circle elevation-2"
alt="User Image">

<?php endif; ?>

</div>

<div class="info">

<div class="user-name">

<?= $this->session
->userdata('nama'); ?>

</div>

<small class="text-muted">

Administrator

</small>

</div>

</div>

<!-- SIDEBAR MENU -->
<nav class="mt-3">

<ul class="nav nav-pills nav-sidebar flex-column"
data-widget="treeview"
role="menu"
data-accordion="false">

<!-- DASHBOARD -->
<li class="nav-item">

<a href="<?= base_url('admin') ?>"
class="nav-link
<?= uri_string() ==
'admin'
? 'active'
: '' ?>">

<i class="nav-icon fas fa-tachometer-alt"></i>

<p>
Dashboard
</p>

</a>

</li>

<!-- BLOG -->
<li class="nav-header">

BLOG MANAGEMENT

</li>

<li class="nav-item has-treeview
<?= strpos(
uri_string(),
'admin/posts'
) !== false
? 'menu-open'
: '' ?>">

<a href="#"
class="nav-link
<?= strpos(
uri_string(),
'admin/posts'
) !== false
? 'active'
: '' ?>">

<i class="nav-icon fas fa-newspaper"></i>

<p>

Artikel

<i class="right fas fa-angle-left"></i>

</p>

</a>

<ul class="nav nav-treeview">

<li class="nav-item">

<a href="<?= base_url(
'admin/posts'
) ?>"
class="nav-link
<?= uri_string()
== 'admin/posts'
? 'active'
: '' ?>">

<i class="far fa-circle nav-icon"></i>

<p>
Semua Artikel
</p>

</a>

</li>

<li class="nav-item">

<a href="<?= base_url(
'admin/posts/create'
) ?>"
class="nav-link
<?= uri_string()
== 'admin/posts/create'
? 'active'
: '' ?>">

<i class="far fa-circle nav-icon"></i>

<p>
Tambah Artikel
</p>

</a>

</li>

<li class="nav-item">

<a href="<?= base_url(
'admin/posts/draft'
) ?>"
class="nav-link
<?= uri_string()
== 'admin/posts/draft'
? 'active'
: '' ?>">

<i class="far fa-circle nav-icon"></i>

<p>
Draft Artikel
</p>

</a>

</li>

</ul>

</li>

<!-- MENU -->
<?php
$menus = [

[
'url' =>
'admin/categories',
'icon' =>
'fas fa-list',
'name' =>
'Kategori'
],

[
'url' =>
'admin/tags',
'icon' =>
'fas fa-tags',
'name' =>
'Tags'
],

[
'url' =>
'admin/media',
'icon' =>
'fas fa-photo-video',
'name' =>
'Media Library'
],

[
'url' =>
'admin/comments',
'icon' =>
'fas fa-comments',
'name' =>
'Komentar'
]

];
?>

<?php foreach(
$menus as $menu
): ?>

<li class="nav-item">

<a href="<?= base_url(
$menu['url']
) ?>"
class="nav-link
<?= uri_string()
== $menu['url']
? 'active'
: '' ?>">

<i class="nav-icon
<?= $menu['icon'] ?>"></i>

<p>

<?= $menu['name'] ?>

</p>

</a>

</li>

<?php endforeach; ?>

<!-- CONTENT -->
<li class="nav-header">

SEO & CONTENT

</li>

<li class="nav-item">

<a href="<?= base_url(
'admin/pages'
) ?>"
class="nav-link">

<i class="nav-icon fas fa-file"></i>

<p>
Halaman
</p>

</a>

</li>

<!-- USER -->
<li class="nav-header">

USER MANAGEMENT

</li>

<li class="nav-item">

<a href="<?= base_url(
'admin/profile'
) ?>"
class="nav-link">

<i class="nav-icon fas fa-user"></i>

<p>
Profile Saya
</p>

</a>

</li>

<!-- SETTINGS -->
<li class="nav-header">

SETTINGS

</li>

<li class="nav-item">

<a href="<?= base_url(
'admin/settings'
) ?>"
class="nav-link
<?= uri_string()
== 'admin/settings'
? 'active'
: '' ?>">

<i class="nav-icon fas fa-cogs"></i>

<p>
Pengaturan Website
</p>

</a>

</li>

<li class="nav-item">

<a href="<?= base_url() ?>"
target="_blank"
class="nav-link">

<i class="nav-icon fas fa-globe"></i>

<p>
Lihat Website
</p>

</a>

</li>

<li class="nav-item mt-4">

<a href="<?= base_url(
'auth/logout'
) ?>"
class="nav-link bg-danger">

<i class="nav-icon
fas fa-sign-out-alt"></i>

<p>Logout</p>

</a>
</p>

</a>

</li>

</ul>

</nav>

</div>

</aside>

<style>

.brand-link{
display:flex;
align-items:center;
padding:14px 18px;
min-height:74px;
overflow:hidden;
}

.brand-logo{
width:48px;
height:48px;
object-fit:contain;
margin-right:14px;
flex-shrink:0;
}

.brand-content{
overflow:hidden;
}

.brand-title{
font-size:18px;
font-weight:700;
color:#fff;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

.brand-subtitle{
font-size:11px;
color:#adb5bd;
display:block;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

.user-panel{
padding:16px;
border-top:
1px solid rgba(
255,255,255,.06
);
border-bottom:
1px solid rgba(
255,255,255,.06
);
}

.user-name{
font-weight:600;
color:#fff;
}

.nav-sidebar .nav-link{
border-radius:12px;
margin-bottom:4px;
}

.nav-sidebar
.nav-link.active{
box-shadow:
0 8px 20px
rgba(
0,123,255,.2
);
}

</style>