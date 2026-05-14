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
Riwayat Sekolah
</h1>

<p class="text-muted mb-0">

Data sekolah yang
menggunakan tool
scrap e-Ijazah

</p>

</div>

<a href="<?= base_url(
'admin/scrapijazah'
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

<div class="card
shadow-sm
border-0">

<div class="card-header
bg-white">

<div class="d-flex
justify-content-between
align-items-center">

<h4 class="mb-0">

Semua Sekolah

</h4>

<span class="badge
badge-primary
px-3 py-2">

<?= count(
$schools
) ?>

Sekolah

</span>

</div>

</div>


<div class="card-body
table-responsive">

<table id="datatable"
class="table
table-hover
table-bordered">

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
Tanggal Upload
</th>

<th width="120">
Aksi
</th>

</tr>

</thead>

<tbody>

<?php if(
!empty(
$schools
)
): ?>

<?php foreach(
$schools
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

<td>

<a href="<?= base_url(
'admin/scrapijazah/delete_school/' .
$school->id
) ?>"

onclick="return confirm(
'Hapus data sekolah ini?'
)"

class="btn
btn-danger
btn-sm">

<i class="fas
fa-trash"></i>

Hapus

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="7"
class="text-center
text-muted">

Belum ada data sekolah

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

.card{

border-radius:20px;

}

.badge{

border-radius:50px;
font-size:13px;

}

.table td,
.table th{

vertical-align:middle;

}

</style>

<?php
$this->load->view(
'admin/layout/footer'
);
?>