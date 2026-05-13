<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom shadow-sm">

<!-- LEFT -->
<ul class="navbar-nav">

<li class="nav-item">

<a class="nav-link"
data-widget="pushmenu"
href="#"
role="button">

<i class="fas fa-bars"></i>

</a>

</li>

<li class="nav-item d-none d-sm-inline-block">

<a href="<?= base_url('admin') ?>"
class="nav-link">

Dashboard

</a>

</li>

</ul>

<!-- RIGHT -->
<ul class="navbar-nav ml-auto align-items-center">

<!-- VIEW WEBSITE -->
<li class="nav-item mr-3">

<a class="btn btn-sm btn-outline-primary"
href="<?= base_url() ?>"
target="_blank">

<i class="fas fa-globe"></i>

Lihat Website

</a>

</li>

<!-- USER MENU -->
<li class="nav-item dropdown user-menu">

<a href="#"
class="nav-link dropdown-toggle d-flex align-items-center"
data-toggle="dropdown">

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
class="user-image img-circle elevation-2"
style="
width:38px;
height:38px;
object-fit:cover;
"
alt="User">

<?php else: ?>

<img src="<?= base_url(
'assets/admin/dist/img/user2-160x160.jpg'
) ?>"
class="user-image img-circle elevation-2"
alt="User">

<?php endif; ?>

<span class="d-none d-md-inline ml-2">

<?= $this->session
->userdata(
'nama'
) ?? 'Administrator' ?>

</span>

</a>

<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

<!-- USER HEADER -->
<li class="user-header bg-primary">

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
width:90px;
height:90px;
object-fit:cover;
"
alt="User">

<?php else: ?>

<img src="<?= base_url(
'assets/admin/dist/img/user2-160x160.jpg'
) ?>"
class="img-circle elevation-2"
alt="User">

<?php endif; ?>

<p>

<?= $this->session
->userdata(
'nama'
) ?>

<small>

<?= $this->session
->userdata(
'username'
) ?>

</small>

</p>

</li>

<!-- MENU BODY -->
<li class="user-body text-center py-3">

<a href="<?= base_url(
'admin/profile'
) ?>"
class="btn btn-outline-primary btn-sm">

<i class="fas fa-user"></i>

Profile Saya

</a>

</li>

<!-- MENU FOOTER -->
<li class="user-footer">

<a href="<?= base_url(
'auth/logout'
) ?>"
class="btn btn-danger btn-flat btn-block">

<i class="fas fa-sign-out-alt"></i>

Logout

</a>

</li>

</ul>

</li>

</ul>

</nav>