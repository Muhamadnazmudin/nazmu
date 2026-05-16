<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<!-- HERO -->
<section class="article-hero">

<div class="container text-center">

<span class="hero-badge">
🎓 Tools Pendidikan
</span>

<h1 class="hero-title">
Scrap e-Ijazah ke Excel
</h1>

<p class="hero-subtitle">

Upload file PDF e-Ijazah lalu
sistem akan otomatis membaca data siswa
dan mengubahnya menjadi file Excel.

</p>

<div class="hero-meta">

<span>SMA</span>
<span>SMK</span>
<span>SMP</span>
<span>SD</span>
<span>MA / MTs</span>
<span>Paket A/B/C</span>

</div>

</div>

</section>


<!-- CONTENT -->
<div class="content-section">

<div class="container py-5">

<!-- ALERT -->
<?php if($this->session->flashdata('error')): ?>

<div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

<?= $this->session->flashdata('error'); ?>

</div>

<?php endif; ?>


<!-- UPLOAD -->
<div class="row justify-content-center mb-5">

<div class="col-lg-8">

<div class="card border-0 shadow-lg upload-card">

<div class="card-body p-5">

<div class="text-center mb-4">

<div class="upload-icon mb-3">

<i class="bi bi-file-earmark-pdf-fill text-danger"></i>

</div>

<h3 class="fw-bold">

Upload PDF e-Ijazah

</h3>

<p class="text-muted">

Maksimal ukuran file
<strong>10MB</strong>

</p>

</div>

<form action="<?= base_url('scrap-ijazah/process') ?>"
method="POST"
enctype="multipart/form-data"
id="uploadForm">

<input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">

<div class="mb-4">

<input type="file"
name="pdf_file"
id="pdf_file"
accept=".pdf"
class="form-control form-control-lg rounded-4"
required>

</div>

<button type="submit"
id="btnProcess"
class="btn btn-primary btn-lg rounded-pill w-100">

<span id="btnText">

<i class="bi bi-upload"></i>
Proses Sekarang

</span>

<span id="loadingText"
style="display:none;">

<span class="spinner-border spinner-border-sm me-2"></span>

Sedang Memproses PDF...

</span>

</button>

</form>

</div>

</div>

</div>

</div>


<!-- HISTORY -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">

<div class="card-header border-0 p-4 bg-transparent">

<h4 class="fw-bold mb-1">

Riwayat Sekolah

</h4>

<p class="text-muted mb-0">

Riwayat penggunaan tool scrap e-Ijazah

</p>

</div>

<div class="table-responsive">

<table class="table align-middle mb-0">

<thead>

<tr>

<th width="70" class="ps-4">

No

</th>

<th>

Jenjang

</th>

<th>

Nama Sekolah

</th>

<th>

NPSN

</th>

<th>

Jumlah Siswa

</th>

<th>

Tanggal

</th>

</tr>

</thead>

<tbody>

<?php if(!empty($schools)): ?>

<?php foreach($schools as $key => $school): ?>

<tr>

<td class="ps-4">

<?= $start_no + $key ?>

</td>

<td>

<span class="badge bg-primary rounded-pill px-3 py-2">

<?= $school->jenjang ?>

</span>

</td>

<td>

<strong>

<?= $school->nama_sekolah ?>

</strong>

</td>

<td>

<?= $school->npsn ?>

</td>

<td>

<span class="badge bg-success rounded-pill">

<?= number_format(
$school->jumlah_siswa
) ?>

siswa

</span>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$school->created_at
)
) ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6"
class="text-center py-5 text-muted">

Belum ada data sekolah

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>


<!-- PAGINATION -->
<?php if(!empty($pagination)): ?>

<div class="d-flex justify-content-center mt-4 pagination-wrap">

<?= $pagination ?>

</div>

<?php endif; ?>

</div>
</div>


<style>

/* UPLOAD ICON */
.upload-icon{
font-size:72px;
}

/* CARD */
.upload-card{
transition:.3s ease;
}

.upload-card:hover{
transform:
translateY(-6px);
}

/* TABLE */
.table thead{
background:
rgba(0,0,0,.04);
}

.table th{
font-weight:700;
padding:18px 16px;
border:0;
}

.table td{
padding:18px 16px;
vertical-align:middle;
border-color:
rgba(0,0,0,.05);
}

/* PAGINATION */
.pagination-wrap a,
.pagination-wrap span{

display:inline-flex;
align-items:center;
justify-content:center;

min-width:46px;
height:46px;

margin:0 4px;
padding:0 16px;

border-radius:14px;

text-decoration:none;

transition:.25s;
}

.pagination-wrap a{
background:
rgba(0,0,0,.04);
}

.pagination-wrap a:hover{
transform:
translateY(-2px);
}

.pagination-wrap .active{
background:
var(--theme-hero-start,#4f46e5);

color:#fff;
}

/* MOBILE */
@media(max-width:768px){

.hero-meta{
justify-content:center;
}

.table{
font-size:14px;
}

.upload-icon{
font-size:56px;
}

}

</style>


<script>

document
.getElementById(
'uploadForm'
)
.addEventListener(
'submit',
function(){

document
.getElementById(
'btnText'
)
.style.display='none';

document
.getElementById(
'loadingText'
)
.style.display='inline';

document
.getElementById(
'btnProcess'
)
.disabled=true;

setTimeout(function(){

document
.getElementById(
'btnText'
)
.style.display='inline';

document
.getElementById(
'loadingText'
)
.style.display='none';

document
.getElementById(
'btnProcess'
)
.disabled=false;

},5000);

});

</script>

<?php $this->load->view('public/layout/footer'); ?>