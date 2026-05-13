<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1 class="m-0">

Media Library

</h1>

<button class="btn btn-primary"
data-toggle="modal"
data-target="#uploadModal">

<i class="fas fa-upload"></i>
Upload Media

</button>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<!-- SEARCH -->
<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<input type="text"
id="searchMedia"
class="form-control"
placeholder="Cari media...">

</div>

</div>

<!-- EMPTY -->
<?php if(empty($media)): ?>

<div class="card shadow-sm border-0">

<div class="card-body text-center p-5">

<i class="fas fa-images fa-4x text-muted mb-3"></i>

<h4>
Belum ada media
</h4>

<p class="text-muted">

Upload gambar pertama
untuk memulai.

</p>

<button class="btn btn-primary"
data-toggle="modal"
data-target="#uploadModal">

Upload Sekarang

</button>

</div>

</div>

<?php else: ?>

<!-- GRID -->
<div class="row"
id="mediaWrapper">

<?php foreach($media as $m): ?>

<div class="col-xl-2
col-lg-3
col-md-4
col-sm-6
col-6
mb-4 media-item">

<div class="card media-card h-100 border-0">

<div class="media-thumb">

<img src="<?= base_url('uploads/media/'.$m->file_name) ?>"
class="media-image"
onclick="previewImage(
'<?= base_url('uploads/media/'.$m->file_name) ?>'
)">

</div>

<div class="card-body p-3">

<div class="media-name">

<?= character_limiter(
$m->file_name,
18
) ?>

</div>

<div class="small text-muted mb-3">

<?= strtoupper(
pathinfo(
$m->file_name,
PATHINFO_EXTENSION
)
) ?>

</div>

<div class="d-flex justify-content-between">

<button
type="button"
class="btn btn-light btn-sm"
onclick="copyUrl(
'<?= base_url('uploads/media/'.$m->file_name) ?>'
)">

<i class="fas fa-copy text-info"></i>

</button>

<a href="<?= base_url('admin/media/delete/'.$m->id) ?>"
class="btn btn-light btn-sm"
onclick="return confirm('Hapus media ini?')">

<i class="fas fa-trash text-danger"></i>

</a>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<?php endif; ?>

</div>

</section>

</div>

<!-- MODAL UPLOAD -->
<div class="modal fade"
id="uploadModal">

<div class="modal-dialog">

<div class="modal-content">

<form action="<?= base_url('admin/media/upload') ?>"
method="POST"
enctype="multipart/form-data">

<div class="modal-header">

<h5 class="modal-title">

Upload Media

</h5>

<button type="button"
class="close"
data-dismiss="modal">

<span>&times;</span>

</button>

</div>

<div class="modal-body">

<input type="file"
name="media"
class="form-control"
required>

<small class="text-muted">

Format:
JPG, PNG, WEBP, GIF

</small>

</div>

<div class="modal-footer">

<button type="submit"
class="btn btn-primary">

Upload

</button>

</div>

</form>

</div>

</div>

</div>

<!-- MODAL PREVIEW -->
<div class="modal fade"
id="previewModal">

<div class="modal-dialog modal-lg">

<div class="modal-content border-0">

<div class="modal-body p-0">

<img id="previewImg"
style="
width:100%;
border-radius:10px;
">

</div>

</div>

</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>

<style>

/* CARD */
.media-card{
    border-radius:18px;
    overflow:hidden;
    transition:.25s;
    box-shadow:
    0 4px 18px
    rgba(0,0,0,.06);
}

.media-card:hover{
    transform:
    translateY(-5px);
}

/* IMAGE */
.media-thumb{
    height:180px;
    overflow:hidden;
    background:#f5f5f5;
}

.media-image{
    width:100%;
    height:100%;
    object-fit:cover;
    cursor:pointer;
}

/* FILE NAME */
.media-name{
    font-size:13px;
    font-weight:600;
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
}

/* MOBILE */
@media(max-width:768px){

.media-thumb{
    height:140px;
}

}

</style>

<script>

// preview image
function previewImage(url)
{
    $('#previewImg')
    .attr('src', url);

    $('#previewModal')
    .modal('show');
}

// copy url
function copyUrl(url)
{
    navigator.clipboard
    .writeText(url);

    alert('URL copied!');
}

// search media
$('#searchMedia').on(
'keyup',
function(){

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