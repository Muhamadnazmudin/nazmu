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

<h1 class="mb-1">

Tambah Halaman

</h1>

<small class="text-muted">

Buat halaman website
dengan editor lengkap

</small>

</div>

<a href="<?= base_url(
'admin/pages'
) ?>"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<form action="<?= base_url(
'admin/pages/store'
) ?>"
method="POST">
<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">
<div class="row">

<!-- LEFT -->
<div class="col-lg-8">

<!-- BASIC -->
<div class="card shadow-sm border-0">

<div class="card-body p-4">

<div class="form-group">

<label>

Judul Halaman

</label>

<input type="text"
name="title"
id="title"
class="form-control
form-control-lg"
placeholder="contoh:
Tentang Kami"
required>

</div>

<div class="form-group">

<label>

Slug URL

</label>

<input type="text"
name="slug"
id="slug"
class="form-control"
placeholder="otomatis">

<small class="text-muted">

URL:

<strong id="slugPreview">

/-

</strong>

</small>

</div>

<div class="form-group">

<label>

Ringkasan Halaman

</label>

<textarea
name="excerpt"
class="form-control"
rows="3"
placeholder="deskripsi singkat halaman..."></textarea>

</div>

<div class="form-group mb-0">

<label>

Isi Halaman

</label>

<textarea
name="content"
id="summernote">

</textarea>

</div>

</div>

</div>

<!-- SEO -->
<div class="card shadow-sm border-0 mt-3">

<div class="card-header
bg-white">

<h5 class="mb-0">

SEO Halaman

</h5>

</div>

<div class="card-body">

<div class="form-group">

<label>

Meta Title

</label>

<input type="text"
name="meta_title"
class="form-control">

</div>

<div class="form-group">

<label>

Meta Description

</label>

<textarea
name="meta_description"
class="form-control"
rows="3"></textarea>

</div>

<div class="form-group mb-0">

<label>

Meta Keywords

</label>

<input type="text"
name="meta_keywords"
class="form-control"
placeholder="seo, website, blog">

</div>

</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-lg-4">

<!-- PUBLISH -->
<div class="card shadow-sm border-0 mb-3">

<div class="card-header
bg-white">

<h5 class="mb-0">

Publish

</h5>

</div>

<div class="card-body">

<div class="custom-control
custom-switch mb-3">

<input type="checkbox"
name="status"
class="custom-control-input"
id="status"
checked>

<label class="custom-control-label"
for="status">

Publish halaman

</label>

</div>

<div class="custom-control
custom-switch mb-3">

<input type="checkbox"
name="show_menu"
class="custom-control-input"
id="show_menu"
checked>

<label class="custom-control-label"
for="show_menu">

Tampilkan di menu

</label>

</div>

<div class="custom-control
custom-switch">

<input type="checkbox"
name="target_blank"
class="custom-control-input"
id="target_blank">

<label class="custom-control-label"
for="target_blank">

Buka tab baru

</label>

</div>

</div>

</div>

<!-- MENU -->
<div class="card shadow-sm border-0 mb-3">

<div class="card-header
bg-white">

<h5 class="mb-0">

Pengaturan Menu

</h5>

</div>

<div class="card-body">

<div class="form-group">

<label>

Urutan Menu

</label>

<input type="number"
name="sort_order"
class="form-control"
value="999">

</div>

<div class="form-group mb-0">

<label>

CSS Class

</label>

<input type="text"
name="css_class"
class="form-control"
placeholder="custom-class">

</div>

</div>

</div>

<!-- FEATURE IMAGE -->
<div class="card shadow-sm border-0 mb-3">

<div class="card-header
bg-white">

<h5 class="mb-0">

Thumbnail Halaman

</h5>

</div>

<div class="card-body text-center">

<img src="https://placehold.co/500x250?text=No+Image"
id="thumbnailPreview"
class="img-fluid rounded mb-3">

<input type="hidden"
name="thumbnail"
id="thumbnail">

<button type="button"
class="btn btn-outline-primary btn-block">

<i class="fas fa-image"></i>

Pilih Thumbnail

</button>

</div>

</div>

<!-- SAVE -->
<div class="card shadow-sm border-0">

<div class="card-body">

<button type="submit"
class="btn btn-primary btn-block btn-lg">

<i class="fas fa-save"></i>

Simpan Halaman

</button>

</div>

</div>

</div>

</div>

</form>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>

<script>

$(document)
.ready(function(){

/* SUMMERNOTE */
$('#summernote')
.summernote({

height:550,

placeholder:
'Tulis isi halaman di sini...',

toolbar: [

['style',
['style']],

['font',
[
'bold',
'italic',
'underline',
'clear'
]],

['fontsize',
['fontsize']],

['color',
['color']],

['para',
[
'ul',
'ol',
'paragraph'
]],

['table',
['table']],

['insert',
[
'link',
'picture',
'video',
'hr'
]],

['view',
[
'fullscreen',
'codeview'
]]

]

});

/* AUTO SLUG */
$('#title').on(
'keyup',
function(){

let slug =
$(this)
.val()
.toLowerCase()
.replace(
/[^a-z0-9 ]/g,
''
)
.replace(
/\s+/g,
'-'
);

$('#slug')
.val(slug);

$('#slugPreview')
.text(
'/' + slug
);

});

});

</script>