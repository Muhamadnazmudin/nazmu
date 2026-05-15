<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex
justify-content-between
align-items-center">

<h1>

Tambah Slider

</h1>

<a href="<?= base_url(
'admin/sliders'
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
'admin/sliders/store'
) ?>"
method="POST"
enctype="multipart/form-data">

<input type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<div class="form-group">

<label>Judul</label>

<input type="text"
name="title"
class="form-control"
required>

</div>

<div class="form-group">

<label>Subtitle</label>

<input type="text"
name="subtitle"
class="form-control">

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea name="description"
class="form-control"
rows="4"></textarea>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Teks Tombol</label>

<input type="text"
name="button_text"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Link Tombol</label>

<input type="text"
name="button_link"
class="form-control">

</div>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="form-group">

<label>Urutan</label>

<input type="number"
name="sort_order"
value="0"
class="form-control">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control">

<option value="publish">

Publish

</option>

<option value="draft">

Draft

</option>

</select>

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Gambar</label>

<input type="file"
name="image"
class="form-control-file"
accept="image/*"
required>

</div>

</div>

</div>

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan Slider

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('admin/layout/footer'); ?>