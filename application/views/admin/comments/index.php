<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between">

<h1>

Komentar

</h1>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm border-0">

<div class="card-body table-responsive p-0">

<table id="datatable"
class="table table-hover">

<thead class="bg-light">

<tr>

<th width="60">
No
</th>

<th>
Komentar
</th>

<th width="180">
Artikel
</th>

<th width="120">
Status
</th>

<th width="150">
Tanggal
</th>

<th width="220">
Aksi
</th>

</tr>

</thead>

<tbody>

<?php foreach(
$comments as $key => $c
): ?>

<tr>

<td>

<?= $key+1 ?>

</td>

<td>

<div class="font-weight-bold">

<?= $c->name ?>

</div>

<small class="text-muted">

<?= $c->email ?>

</small>

<p class="mb-0 mt-2">

<?= character_limiter(
$c->content,
120
) ?>

</p>

</td>

<td>

<a href="<?= base_url(
'blog/'.$c->slug
) ?>"
target="_blank">

<?= character_limiter(
$c->post_title,
25
) ?>

</a>

</td>

<td>

<?php if(
$c->status ==
'approved'
): ?>

<span class="badge badge-success">

Approved

</span>

<?php elseif(
$c->status ==
'pending'
): ?>

<span class="badge badge-warning">

Pending

</span>

<?php else: ?>

<span class="badge badge-danger">

Spam

</span>

<?php endif; ?>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$c->created_at
)
) ?>

</td>

<td>

<div class="btn-group">

<a href="<?= base_url(
'admin/comments/approve/'.
$c->id
) ?>"
class="btn btn-success btn-sm">

<i class="fas fa-check"></i>

</a>

<a href="<?= base_url(
'admin/comments/pending/'.
$c->id
) ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-clock"></i>

</a>

<a href="<?= base_url(
'admin/comments/spam/'.
$c->id
) ?>"
class="btn btn-secondary btn-sm">

<i class="fas fa-ban"></i>

</a>

<a href="<?= base_url(
'admin/comments/delete/'.
$c->id
) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm(
'Hapus komentar?'
)">

<i class="fas fa-trash"></i>

</a>

</div>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('admin/layout/footer'); ?>