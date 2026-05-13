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

<h1>

Pages

</h1>

<a href="<?= base_url(
'admin/pages/create'
) ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>

Tambah Halaman

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body table-responsive p-0">

<table class="table table-hover">

<thead>

<tr>

<th width="60">

#

</th>

<th>

Judul

</th>

<th>

Slug

</th>

<th width="120">

Status

</th>

<th width="180">

Aksi

</th>

</tr>

</thead>

<tbody>

<?php if(
!empty(
$pages
)
): ?>

<?php
$no = 1;
foreach(
$pages
as $page
):
?>

<tr>

<td>

<?= $no++ ?>

</td>

<td>

<strong>

<?= $page->title ?>

</strong>

</td>

<td>

<code>

/<?= $page->slug ?>

</code>

</td>

<td>

<?php if(
$page->status
): ?>

<span class="badge badge-success">

Published

</span>

<?php else: ?>

<span class="badge badge-secondary">

Draft

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= base_url(
'admin/pages/edit/' .
$page->id
) ?>"
class="btn btn-sm btn-warning">

Edit

</a>

<a href="<?= base_url(
'admin/pages/delete/' .
$page->id
) ?>"
class="btn btn-sm btn-danger"
onclick="return confirm(
'Hapus halaman ini?'
)">

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="5"
class="text-center
text-muted
py-4">

Belum ada halaman

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

<?php $this->load->view(
'admin/layout/footer'
); ?>