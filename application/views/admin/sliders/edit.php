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

Edit Slider

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
'admin/sliders/update/' .
$slider->id
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
value="<?= html_escape(
$slider->title
) ?>"
required>

</div>

<div class="form-group">

<label>Subtitle</label>

<input type="text"
name="subtitle"
class="form-control"
value="<?= html_escape(
$slider->subtitle
) ?>">

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea name="description"
class="form-control"
rows="4"><?= html_escape(
$slider->description
) ?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Teks Tombol</label>

<input type="text"
name="button_text"
class="form-control"
value="<?= html_escape(
$slider->button_text
) ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Link Tombol</label>

<input type="text"
name="button_link"
class="form-control"
value="<?= html_escape(
$slider->button_link
) ?>">

</div>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="form-group">

<label>Urutan</label>

<input type="number"
name="sort_order"
class="form-control"
value="<?= $slider->sort_order ?>">

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control">

<option value="publish"
<?= $slider->status
== 'publish'
? 'selected'
: '' ?>>

Publish

</option>

<option value="draft"
<?= $slider->status
== 'draft'
? 'selected'
: '' ?>>

Draft

</option>

</select>

</div>

</div>

<div class="col-md-4">

<div class="form-group">

<label>Gambar Baru</label>

<input type="file"
name="image"
class="form-control-file"
accept="image/*">

<small class="text-muted">

Kosongkan jika
tidak ingin
mengganti gambar

</small>

</div>

</div>

</div>

<?php if(
!empty(
$slider->image
)
): ?>

<div class="mb-4">

<label>

Preview Gambar

</label>

<div>

<img src="<?= base_url(
'uploads/sliders/' .
$slider->image
) ?>"
style="
width:320px;
max-width:100%;
height:180px;
object-fit:cover;
border-radius:16px;
box-shadow:
0 8px 20px
rgba(0,0,0,.12);
">

</div>

</div>

<?php endif; ?>

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Update Slider

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