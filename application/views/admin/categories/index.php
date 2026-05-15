<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="d-flex justify-content-between">

<h1>Kategori</h1>

<button class="btn btn-primary"
data-toggle="modal"
data-target="#modalTambah">

<i class="fas fa-plus"></i>
Tambah Kategori

</button>

</div>

</div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-body table-responsive">

<table id="datatable"
class="table table-bordered table-hover">

<thead>

<tr>
    <th width="60">No</th>
    <th>Nama</th>
    <th>Slug</th>
    <th width="220">
        Aksi
    </th>
</tr>

</thead>

<tbody>

<?php foreach($categories as $key => $cat): ?>

<tr>

<td>
<?= $key+1 ?>
</td>

<td>
<?= $cat->name ?>
</td>

<td>
<?= $cat->slug ?>
</td>

<td>

<button class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#edit<?= $cat->id ?>">

Edit

</button>

<a href="<?= base_url('admin/categories/delete/'.$cat->id) ?>"
onclick="return confirm('Hapus kategori?')"
class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<!-- modal edit -->
<div class="modal fade"
id="edit<?= $cat->id ?>">

<div class="modal-dialog">

<div class="modal-content">

<form action="<?= base_url('admin/categories/update/'.$cat->id) ?>"
method="POST">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">
<div class="modal-header">

<h5>Edit Kategori</h5>

<button type="button"
class="close"
data-dismiss="modal">

×

</button>

</div>

<div class="modal-body">

<label>Nama</label>

<input type="text"
name="name"
class="form-control"
value="<?= $cat->name ?>"
required>

</div>

<div class="modal-footer">

<button class="btn btn-primary">

Update

</button>

</div>

</form>

</div>
</div>
</div>

<?php endforeach; ?>

</tbody>

</table>

</div>
</div>

</div>
</section>

</div>

<!-- modal tambah -->
<div class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form action="<?= base_url('admin/categories/store') ?>"
method="POST">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">
<div class="modal-header">

<h5>Tambah Kategori</h5>

<button type="button"
class="close"
data-dismiss="modal">

×

</button>

</div>

<div class="modal-body">

<label>Nama Kategori</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="modal-footer">

<button class="btn btn-primary">

Simpan

</button>

</div>

</form>

</div>
</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>