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

<h1>

Edit User

</h1>

<a href="<?= base_url(
'admin/users'
) ?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body">

<form action="<?= base_url(
'admin/users/update/' .
$user->id
) ?>"
method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama</label>

<input type="text"
name="nama"
class="form-control"
value="<?= html_escape(
$user->nama
) ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Username</label>

<input type="text"
name="username"
class="form-control"
value="<?= html_escape(
$user->username
) ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?= html_escape(
$user->email
) ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Password Baru</label>

<input type="password"
name="password"
class="form-control">

<small class="text-muted">

Kosongkan jika
tidak ingin
mengganti password

</small>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Role</label>

<select name="role"
class="form-control">

<option value="admin"
<?= $user->role
== 'admin'
? 'selected'
: '' ?>>

Admin

</option>

<option value="editor"
<?= $user->role
== 'editor'
? 'selected'
: '' ?>>

Editor

</option>

<option value="author"
<?= $user->role
== 'author'
? 'selected'
: '' ?>>

Author

</option>

</select>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Foto</label>

<input type="file"
name="photo"
class="form-control-file"
accept="image/*">

<?php if(
!empty(
$user->photo
)
): ?>

<div class="mt-2">

<img src="<?= base_url(
'uploads/users/' .
$user->photo
) ?>"
style="
width:90px;
height:90px;
object-fit:cover;
border-radius:14px;
">

</div>

<?php endif; ?>

</div>

</div>

</div>

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Update User

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>