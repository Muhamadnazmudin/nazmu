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

Menu Builder

</h1>

<button
class="btn btn-primary"
data-toggle="modal"
data-target="#addMenuModal">

<i class="fas fa-plus"></i>

Tambah Menu

</button>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body table-responsive">

<table
class="table table-bordered">

<thead>

<tr>

<th width="60">
No
</th>

<th>
Nama
</th>

<th>
URL
</th>

<th width="100">
Urutan
</th>

<th width="100">
Status
</th>

<th width="120">
Aksi
</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;
foreach(
$menus as $menu
):
?>

<tr>

<td>

<?= $no++ ?>

</td>

<td>

<?= $menu->title ?>

</td>

<td>

<?= $menu->url ?>

</td>

<td>

<?= $menu->sort_order ?>

</td>

<td>

<?php if(
$menu->status
): ?>

<span class="badge badge-success">

Aktif

</span>

<?php else: ?>

<span class="badge badge-danger">

Nonaktif

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url(
'admin/menu/delete/' .
$menu->id
) ?>"
onclick="
return confirm(
'Hapus menu?'
)
"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<!-- MODAL -->
<div class="modal fade"
id="addMenuModal">

<div class="modal-dialog">

<div class="modal-content">

<form
action="<?= base_url(
'admin/menu/store'
) ?>"
method="POST">

<div class="modal-header">

<h5>

Tambah Menu

</h5>

</div>

<div class="modal-body">

<div class="form-group">

<label>

Nama Menu

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="form-group">

<label>

URL

</label>

<input
type="text"
name="url"
class="form-control"
placeholder="
contoh:
about
atau
https://google.com
">

</div>

<div class="form-group">

<label>

Urutan

</label>

<input
type="number"
name="sort_order"
class="form-control"
value="1">

</div>

<div class="form-check">

<input
type="checkbox"
name="status"
checked
class="form-check-input">

<label
class="form-check-label">

Aktif

</label>

</div>

</div>

<div class="modal-footer">

<button
type="submit"
class="btn btn-primary">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>