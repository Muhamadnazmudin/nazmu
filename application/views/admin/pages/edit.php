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

Edit Halaman

</h1>

<small class="text-muted">

Update halaman website

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
'admin/pages/update/' .
$page->id
) ?>"
method="POST">

<div class="row">

<!-- LEFT -->
<div class="col-lg-8">

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
value="<?= $page->title ?>"
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
value="<?= $page->slug ?>">

<small class="text-muted">

URL:

<strong id="slugPreview">

/<?= $page->slug ?>

</strong>

</small>

</div>

<div class="form-group mb-0">

<label>

Isi Halaman

</label>

<textarea
name="content"
id="summernote"><?= $page->content ?></textarea>

</div>

</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-lg-4">

<!-- PUBLISH -->
<div class="card shadow-sm border-0 mb-3">

<div class="card-header bg-white">

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

<?= $page->status
? 'checked'
: '' ?>>

<label class="custom-control-label"
for="status">

Publish halaman

</label>

</div>

<div class="custom-control
custom-switch">

<input type="checkbox"
name="show_menu"
class="custom-control-input"
id="show_menu"

<?= $this->db
->where(
'url',
$page->slug
)
->count_all_results(
'menus'
)
? 'checked'
: '' ?>>

<label class="custom-control-label"
for="show_menu">

Tampilkan di menu

</label>

</div>

</div>

</div>

<!-- ACTION -->
<div class="card shadow-sm border-0">

<div class="card-body">

<button type="submit"
class="btn btn-warning btn-block btn-lg">

<i class="fas fa-save"></i>

Update Halaman

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
'Tulis isi halaman...',

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