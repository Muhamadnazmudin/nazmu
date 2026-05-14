<?php
$this->load->view(
'admin/layout/header'
);

$this->load->view(
'admin/layout/navbar'
);

$this->load->view(
'admin/layout/sidebar'
);
?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex
justify-content-between
align-items-center">

<div>

<h1>
<?= $title ?>
</h1>

<p class="text-muted mb-0">

Monitoring penggunaan
tool scrap e-Ijazah

</p>

</div>

<a href="<?= base_url(
'scrap-ijazah'
) ?>"
target="_blank"
class="btn btn-primary">

<i class="fas fa-external-link-alt"></i>

Buka Tool

</a>

</div>

</div>

</section>


<section class="content">

<div class="container-fluid">

<!-- STATISTIC -->
<div class="row">

<!-- total sekolah -->
<div class="col-lg-4 col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="d-flex
justify-content-between
align-items-center">

<div>

<p class="text-muted mb-1">

Total Sekolah

</p>

<h2 class="font-weight-bold">

<?= number_format(
$total_sekolah
) ?>

</h2>

</div>

<div class="icon-box bg-primary">

<i class="fas fa-school"></i>

</div>

</div>

</div>

</div>

</div>


<!-- total siswa -->
<div class="col-lg-4 col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="d-flex
justify-content-between
align-items-center">

<div>

<p class="text-muted mb-1">

Total Siswa

</p>

<h2 class="font-weight-bold">

<?= number_format(
$total_siswa
) ?>

</h2>

</div>

<div class="icon-box bg-success">

<i class="fas fa-user-graduate"></i>

</div>

</div>

</div>

</div>

</div>


<!-- upload hari ini -->
<div class="col-lg-4 col-md-12">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="d-flex
justify-content-between
align-items-center">

<div>

<p class="text-muted mb-1">

Upload Hari Ini

</p>

<h2 class="font-weight-bold">

<?= number_format(
$upload_today
) ?>

</h2>

</div>

<div class="icon-box bg-warning">

<i class="fas fa-file-upload"></i>

</div>

</div>

</div>

</div>

</div>

</div>


<!-- TABLE -->
<div class="card
shadow-sm
border-0">

<div class="card-header
bg-white">

<h4 class="mb-0">

Sekolah Terbaru

</h4>

</div>

<div class="card-body
table-responsive">

<table class="table
table-hover
align-middle">

<thead>

<tr>

<th width="60">
#
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

<?php if(
!empty(
$latest_schools
)
): ?>

<?php foreach(
$latest_schools
as $key => $school
): ?>

<tr>

<td>

<?= $key+1 ?>

</td>

<td>

<span class="badge
badge-primary
px-3 py-2">

<?= $school
->jenjang ?>

</span>

</td>

<td>

<strong>

<?= $school
->nama_sekolah ?>

</strong>

</td>

<td>

<?= $school
->npsn ?>

</td>

<td>

<span class="badge
badge-success
px-3 py-2">

<?= number_format(
$school
->jumlah_siswa
) ?>

siswa

</span>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$school
->created_at
)
) ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6"
class="text-center
text-muted">

Belum ada data

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>


<style>

.icon-box{

width:64px;
height:64px;
border-radius:20px;

display:flex;
align-items:center;
justify-content:center;

font-size:24px;
color:#fff;

}

.card{

border-radius:20px;

}

.badge{

border-radius:50px;
font-size:13px;

}

</style>

<?php
$this->load->view(
'admin/layout/footer'
);
?>