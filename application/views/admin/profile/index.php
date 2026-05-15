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

<h1>

Profile Saya

</h1>

<small class="text-muted">

Kelola akun administrator

</small>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(
$this->session
->flashdata(
'success'
)
): ?>

<div class="alert
alert-success
shadow-sm">

<i class="fas fa-check-circle"></i>

<?= $this->session
->flashdata(
'success'
) ?>

</div>

<?php endif; ?>

<div class="row">

<!-- LEFT -->
<div class="col-lg-4">

<div class="card
card-primary
card-outline
shadow-sm">

<div class="card-body
text-center">

<?php if(
!empty(
$user->photo
)
): ?>

<img src="<?= base_url(
'uploads/users/' .
$user->photo
) ?>"
class="profile-avatar">

<?php else: ?>

<img src="<?= base_url(
'assets/admin/dist/img/user2-160x160.jpg'
) ?>"
class="profile-avatar">

<?php endif; ?>

<h4 class="mt-3
font-weight-bold">

<?= $user->nama ?>

</h4>

<p class="text-muted
mb-1">

@
<?= $user->username ?>

</p>

<span class="badge
badge-primary
px-3 py-2">

Administrator

</span>

<hr>

<p class="text-muted
mb-0">

<?= $user->email ?>

</p>

</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-lg-8">

<div class="card
shadow-sm">

<div class="card-header
bg-white">

<h5 class="mb-0">

Edit Profile

</h5>

</div>

<div class="card-body">

<form action="<?= base_url(
'admin/profile/update'
) ?>"
method="POST"
enctype="multipart/form-data">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">
<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Nama Lengkap

</label>

<input type="text"
name="nama"
class="form-control"
value="<?= $user->nama ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Username

</label>

<input type="text"
name="username"
class="form-control"
value="<?= $user->username ?>"
required>

</div>

</div>

</div>

<div class="form-group">

<label>

Email

</label>

<input type="email"
name="email"
class="form-control"
value="<?= $user->email ?>">

</div>

<div class="form-group">

<label>

Foto Profile

</label>

<div class="custom-file">

<input type="file"
name="photo"
class="custom-file-input"
id="photo">

<label class="custom-file-label"
for="photo">

Pilih gambar

</label>

</div>

<small class="text-muted">

Format:
JPG, PNG, WEBP

</small>

</div>

<hr>

<h5 class="mb-3">

Ganti Password

</h5>

<div class="form-group">

<label>

Password Baru

</label>

<input type="password"
name="password"
class="form-control"
placeholder="Kosongkan jika tidak diubah">

</div>

<div class="text-right">

<button type="submit"
class="btn btn-primary
btn-lg px-4">

<i class="fas fa-save"></i>

Simpan Perubahan

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<style>

.profile-avatar{
width:130px;
height:130px;
object-fit:cover;
border-radius:50%;
border:5px solid #fff;
box-shadow:
0 5px 20px
rgba(
0,0,0,.15
);
}

.card{
border-radius:16px;
overflow:hidden;
}

.form-control{
border-radius:10px;
height:45px;
}

.custom-file-label{
border-radius:10px;
}

.btn{
border-radius:10px;
}

</style>

<script>

document
.querySelector(
'.custom-file-input'
)
.addEventListener(
'change',
function(e){

this.nextElementSibling
.innerText =
e.target.files[0]
.name;

}
);

</script>

<?php $this->load->view(
'admin/layout/footer'
); ?>