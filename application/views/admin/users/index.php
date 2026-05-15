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

Manajemen User

</h1>

<a href="<?= base_url(
'admin/users/create'
) ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>

Tambah User

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body">

<div class="table-responsive">

<table class="table
table-bordered
table-hover
datatable">

<thead>

<tr>

<th width="70">

Foto

</th>

<th>

Nama

</th>

<th>

Username

</th>

<th>

Email

</th>

<th width="100">

Role

</th>

<th width="170">

Dibuat

</th>

<th width="160">

Aksi

</th>

</tr>

</thead>

<tbody>

<?php foreach(
$users as $user
): ?>

<tr>

<td class="text-center">

<?php if(
!empty(
$user->photo
)
): ?>

<img src="<?= base_url(
'uploads/users/' .
$user->photo
) ?>"
style="
width:55px;
height:55px;
object-fit:cover;
border-radius:12px;
">

<?php else: ?>

<div style="
width:55px;
height:55px;
background:#f1f5f9;
border-radius:12px;
display:flex;
align-items:center;
justify-content:center;
">

<i class="fas fa-user
text-muted"></i>

</div>

<?php endif; ?>

</td>

<td>

<?= html_escape(
$user->nama
) ?>

</td>

<td>

<?= html_escape(
$user->username
) ?>

</td>

<td>

<?= html_escape(
$user->email
) ?>

</td>

<td>

<span class="badge
badge-primary">

<?= ucfirst(
$user->role
) ?>

</span>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$user->created_at
)
) ?>

</td>

<td>

<a href="<?= base_url(
'admin/users/edit/' .
$user->id
) ?>"
class="btn
btn-warning
btn-sm">

<i class="fas fa-edit"></i>

</a>

<?php if(
$user->id !=
$this->session
->userdata(
'id_user'
)
): ?>

<a href="<?= base_url(
'admin/users/delete/' .
$user->id
) ?>"
class="btn
btn-danger
btn-sm"
onclick="return confirm(
'Yakin hapus user ini?'
)">

<i class="fas fa-trash"></i>

</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>