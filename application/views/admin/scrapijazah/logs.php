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
Logs Penggunaan
</h1>

<p class="text-muted mb-0">

Riwayat penggunaan
tool Scrap e-Ijazah

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

Riwayat Upload

</h4>

<span class="badge
badge-primary
px-3 py-2">

<?= count(
$logs
) ?>

Logs

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
Sekolah
</th>

<th>
NPSN
</th>

<th>
Jumlah Siswa
</th>

<th>
IP Address
</th>

<th>
Browser
</th>

<th>
Platform
</th>

<th>
Tanggal
</th>

</tr>

</thead>

<tbody>

<?php if(
!empty(
$logs
)
): ?>

<?php foreach(
$logs
as $key => $log
): ?>

<tr>

<td>

<?= $key+1 ?>

</td>

<td>

<strong>

<?= $log
->school_name ?>

</strong>

</td>

<td>

<?= $log
->npsn ?>

</td>

<td>

<span class="badge
badge-success
px-3 py-2">

<?= number_format(
$log
->jumlah_siswa
) ?>

siswa

</span>

</td>

<td>

<code>

<?= $log
->ip_address ?>

</code>

</td>

<td>

<?= $log
->browser ?>

</td>

<td>

<?= $log
->platform ?>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$log
->created_at
)
) ?>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="8"
class="text-center
text-muted">

Belum ada logs penggunaan

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

code{

font-size:13px;

}

</style>

<?php
$this->load->view(
'admin/layout/footer'
);
?>