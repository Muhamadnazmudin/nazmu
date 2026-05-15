<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1>Tambah Artikel</h1>

<a href="<?= base_url('admin/posts') ?>"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>
</section>

<section class="content">
<div class="container-fluid">

<form action="<?= base_url('admin/posts/store') ?>"
method="POST">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">

<div class="row">

<!-- LEFT -->
<div class="col-lg-8">

<div class="card shadow-sm">

<div class="card-body">

<!-- TITLE -->
<div class="form-group">

<label>Judul Artikel</label>

<input type="text"
name="title"
id="title"
class="form-control"
placeholder="Masukkan judul artikel"
required>

</div>

<!-- SLUG -->
<div class="form-group">

<label>Permalink</label>

<div class="input-group">

<div class="input-group-prepend">

<span class="input-group-text">

<?= base_url('blog/') ?>

</span>

</div>

<input type="text"
id="slug"
class="form-control"
readonly>

</div>

<small class="text-muted">

URL otomatis dibuat dari judul

</small>

</div>

<!-- CATEGORY -->
<div class="form-group">

<label>Kategori</label>

<select name="category_id"
class="form-control"
required>

<option value="">
Pilih kategori
</option>

<?php foreach($categories as $cat): ?>

<option value="<?= $cat->id ?>">

<?= $cat->name ?>

</option>

<?php endforeach; ?>

</select>

</div>

<!-- EXCERPT -->
<div class="form-group">

<label>Ringkasan</label>

<textarea name="excerpt"
class="form-control"
rows="4"
placeholder="Ringkasan artikel"></textarea>

</div>

<hr>

<h5 class="mb-3">

SEO Settings

</h5>

<!-- META TITLE -->
<div class="form-group">

<label>Meta Title</label>

<input type="text"
name="meta_title"
class="form-control"
placeholder="Judul SEO Google">

</div>

<!-- META DESCRIPTION -->
<div class="form-group">

<label>Meta Description</label>

<textarea name="meta_description"
class="form-control"
rows="3"
placeholder="Deskripsi SEO Google"></textarea>

</div>

<!-- CONTENT -->
<div class="form-group">

<label>Isi Artikel</label>

<textarea name="content"
id="summernote"></textarea>

</div>

</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-lg-4">

<!-- FEATURED IMAGE -->
<div class="card shadow-sm">

<div class="card-header">

Featured Image

</div>

<div class="card-body text-center">

<img id="preview"
style="
width:100%;
height:230px;
object-fit:cover;
border-radius:12px;
margin-bottom:15px;
display:none;
">

<input type="hidden"
name="thumbnail_selected"
id="thumbnail_selected">

<button type="button"
class="btn btn-outline-primary btn-block"
data-toggle="modal"
data-target="#mediaModal">

<i class="fas fa-images"></i>

Set Featured Image

</button>

</div>

</div>

<!-- PUBLISH -->
<div class="card shadow-sm">

<div class="card-header">

Publish

</div>

<div class="card-body">

<div class="form-group">

<label>Status</label>

<select name="status"
class="form-control">

<option value="draft">

Draft

</option>

<option value="publish">

Publish

</option>

</select>

</div>

<button type="submit"
class="btn btn-primary btn-block">

<i class="fas fa-save"></i>

Simpan Artikel

</button>

</div>

</div>

</div>

</div>

</form>

</div>
</section>

</div>

<!-- MEDIA MODAL -->
<div class="modal fade"
id="mediaModal">

<div class="modal-dialog modal-xl">

<div class="modal-content">

<div class="modal-header bg-light">

<h5 class="modal-title">

Pilih Featured Image

</h5>

<button type="button"
class="close"
data-dismiss="modal">

<span>&times;</span>

</button>

</div>

<div class="modal-body">

<input type="text"
id="searchMedia"
class="form-control mb-4"
placeholder="Cari media...">

<div class="row media-grid">

<?php foreach($media as $m): ?>

<div class="col-xl-2
col-lg-3
col-md-4
col-sm-6
col-6
mb-4 media-item">

<div class="media-card"
data-file="<?= $m->file_name ?>"
data-url="<?= base_url('uploads/media/'.$m->file_name) ?>">

<img src="<?= base_url('uploads/media/'.$m->file_name) ?>"
class="picker-image">

<div class="p-2">

<small>

<?= character_limiter(
$m->file_name,
15
) ?>

</small>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<div class="modal-footer">

<button type="button"
class="btn btn-secondary"
data-dismiss="modal">

Tutup

</button>

<button type="button"
class="btn btn-primary"
id="chooseImageBtn"
disabled>

Gunakan Gambar

</button>

</div>

</div>

</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>

<style>

.media-grid{
max-height:500px;
overflow-y:auto;
}

.media-card{
border:2px solid transparent;
border-radius:14px;
overflow:hidden;
cursor:pointer;
transition:.25s;
background:#fff;
box-shadow:
0 4px 15px
rgba(0,0,0,.06);
}

.media-card:hover{
transform:translateY(-4px);
}

.media-card.active{
border-color:#007bff;
}

.picker-image{
width:100%;
height:150px;
object-fit:cover;
}

</style>

<script>

$('#summernote').summernote({
height:450
});

// auto slug
$('#title').keyup(function(){

let slug =
$(this)
.val()
.toLowerCase()
.replace(/[^a-z0-9 ]/g,'')
.replace(/\s+/g,'-');

$('#slug').val(slug);

});

let selectedFile = '';
let selectedUrl = '';

$('.media-card').click(function(){

$('.media-card')
.removeClass('active');

$(this)
.addClass('active');

selectedFile =
$(this).data('file');

selectedUrl =
$(this).data('url');

$('#chooseImageBtn')
.prop(
'disabled',
false
);

});

$('#chooseImageBtn')
.click(function(){

$('#thumbnail_selected')
.val(selectedFile);

$('#preview')
.attr(
'src',
selectedUrl
)
.show();

$('#mediaModal')
.modal('hide');

});

$('#searchMedia')
.on('keyup', function(){

let value =
$(this)
.val()
.toLowerCase();

$('.media-item')
.filter(function(){

$(this).toggle(
$(this)
.text()
.toLowerCase()
.indexOf(value)
> -1
);

});

});

</script>