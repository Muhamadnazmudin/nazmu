<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="article-hero">

<div class="container text-center">

<span class="hero-badge">
📥 Download Center
</span>

<h1 class="hero-title">

Download Center

</h1>

<p class="hero-subtitle">

Download berbagai file,
dokumen, aplikasi,
dan kebutuhan lainnya.

</p>

<div class="hero-meta">

<span>

<?= !empty($downloads)
? count($downloads)
: 0 ?>

File

</span>

<span>

<?= !empty($download_categories)
? count($download_categories)
: 0 ?>

Kategori

</span>

</div>

</div>

</section>


<!-- CONTENT -->
<div class="content-section">

<div class="container py-5">

<!-- SEARCH -->
<div class="card border-0 shadow-sm rounded-4 mb-4">

<div class="card-body p-3">

<div class="input-group search-download-box">

<span class="input-group-text
bg-transparent border-0">

<i class="fas fa-search text-muted"></i>

</span>

<input type="text"
id="searchDownload"
class="form-control border-0"
placeholder="Cari file download...">

</div>

</div>

</div>


<!-- CATEGORY -->
<div class="mb-5">

<div class="d-flex
flex-wrap
gap-2
justify-content-center">

<a href="<?= site_url(
'download-center'
); ?>"
class="btn rounded-pill
<?= !isset($category)
? 'btn-primary'
: 'btn-outline-primary'; ?>">

Semua

</a>

<?php if(!empty(
$download_categories
)): ?>

<?php foreach(
$download_categories
as $cat
): ?>

<a href="<?= site_url(
'download-center/category/' .
$cat->slug
); ?>"
class="btn rounded-pill
<?= (
isset($category)
&&
$category->id
==
$cat->id
)
? 'btn-primary'
: 'btn-outline-primary'; ?>">

<?= $cat->name; ?>

</a>

<?php endforeach; ?>

<?php endif; ?>

</div>

</div>


<!-- GRID -->
<div class="row"
id="downloadWrapper">

<?php if(!empty($downloads)): ?>

<?php foreach(
$downloads as $file
): ?>

<?php

$ext = '-';

if(
!empty(
$file->file_type
)
){

$ext =
strtolower(
str_replace(
'.',
'',
$file->file_type
)
);

}
elseif(
$file->file_source
==
'external'
){

if(
strpos(
$file->file_path,
'drive.google.com'
)!==false
){

$ext =
'gdrive';

}
elseif(
strpos(
$file->file_path,
'dropbox'
)!==false
){

$ext =
'dropbox';

}
elseif(
strpos(
$file->file_path,
'onedrive'
)!==false
){

$ext =
'onedrive';

}
else{

$ext =
'link';

}
}
?>

<div class="col-md-4 mb-4
download-item"

data-title="<?= strtolower(
$file->title
); ?>"

data-description="<?= strtolower(
strip_tags(
$file->description
)
); ?>">

<div class="card
download-card
border-0
h-100">

<div class="card-body
d-flex
flex-column">

<!-- TYPE -->
<div class="mb-3">

<?php if(
$ext == 'gdrive'
): ?>

<span class="badge bg-success">

<i class="fab fa-google-drive"></i>

Google Drive

</span>

<?php elseif(
$ext == 'pdf'
): ?>

<span class="badge bg-danger">

PDF

</span>

<?php elseif(
in_array(
$ext,
['doc','docx']
)
): ?>

<span class="badge bg-primary">

WORD

</span>

<?php elseif(
in_array(
$ext,
['xls','xlsx']
)
): ?>

<span class="badge bg-success">

EXCEL

</span>

<?php elseif(
in_array(
$ext,
['ppt','pptx']
)
): ?>

<span class="badge
bg-warning
text-dark">

PPT

</span>

<?php elseif(
$ext == 'zip'
): ?>

<span class="badge bg-secondary">

ZIP

</span>

<?php else: ?>

<span class="badge bg-dark">

<?= strtoupper($ext); ?>

</span>

<?php endif; ?>

</div>

<!-- TITLE -->
<h5 class="download-title">

<?= $file->title; ?>

</h5>

<!-- DESC -->
<p class="download-desc
flex-grow-1">

<?= word_limiter(
strip_tags(
$file->description
),
15
); ?>

</p>

<!-- META -->
<div class="download-meta mb-3">

<div>

<strong>Size:</strong>

<?= $file->file_size ?: '-'; ?>

</div>

<div>

<strong>Downloaded:</strong>

<?= $file->total_download; ?>x

</div>

</div>

<!-- BTN -->
<div class="d-flex gap-2">

    <!-- VIEW -->
    <a href="<?= site_url(
        'download-center/view/' .
        $file->slug
    ); ?>"
    target="_blank"
    class="btn
    btn-outline-primary
    rounded-pill
    w-50">

        <i class="fas fa-eye me-1"></i>

        View

    </a>

    <!-- DOWNLOAD -->
    <a href="<?= site_url(
        'download-center/file/' .
        $file->slug
    ); ?>"
    class="btn
    btn-primary
    rounded-pill
    w-50">

        <i class="fas fa-download me-1"></i>

        Download

    </a>

</div>


</div>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12">

<div class="card border-0 shadow-sm">

<div class="card-body
text-center
py-5">

<h4>

Belum ada file

</h4>

<p class="text-muted">

File download
akan muncul di sini.

</p>

</div>

</div>

</div>

<?php endif; ?>

</div>

</div>
</div>


<style>

/* SEARCH */
.search-download-box{
background:
rgba(0,0,0,.03);

border-radius:18px;
overflow:hidden;
}

/* CARD */
.download-card{
border-radius:24px;
transition:.3s ease;
overflow:hidden;
}

.download-card:hover{
transform:
translateY(-8px);
}

/* TITLE */
.download-title{
font-size:22px;
font-weight:700;
line-height:1.4;
margin-bottom:10px;
}

/* DESC */
.download-desc{
opacity:.8;
font-size:15px;
}

/* META */
.download-meta{
font-size:14px;
opacity:.8;
}

/* BADGE */
.badge{
border-radius:999px;
padding:10px 14px;
font-weight:600;
}

/* MOBILE */
@media(max-width:768px){

.download-title{
font-size:19px;
}

}

</style>


<script>

document
.getElementById(
'searchDownload'
)
.addEventListener(
'keyup',
function(){

let keyword =
this.value
.toLowerCase()
.trim();

let items =
document.querySelectorAll(
'.download-item'
);

items.forEach(function(item){

let title =
item.dataset.title;

let description =
item.dataset.description;

let found =
title.includes(keyword)
||
description.includes(keyword);

item.style.display =
found
? 'block'
: 'none';

});

}
);

</script>

<?php $this->load->view('public/layout/footer'); ?>