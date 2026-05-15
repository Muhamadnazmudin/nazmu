<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex
justify-content-between
align-items-center">

<h1>

Banner / Slider

</h1>

<a href="<?= base_url(
'admin/sliders/create'
) ?>"
class="btn btn-primary">

<i class="fas fa-plus"></i>

Tambah Slider

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body">

<div class="table-responsive">

<table class="table
table-bordered
table-hover">

<thead>

<tr>

<th width="100">

Preview

</th>

<th>

Judul

</th>

<th>

Subtitle

</th>

<th width="100">

Urutan

</th>

<th width="100">

Status

</th>

<th width="160">

Aksi

</th>

</tr>

</thead>

<tbody>

<?php foreach(
$sliders as $slider
): ?>

<tr>

<td>

<?php if(
!empty(
$slider->image
)
): ?>

<img src="<?= base_url(
'uploads/sliders/' .
$slider->image
) ?>"
style="
width:90px;
height:60px;
object-fit:cover;
border-radius:10px;
">

<?php endif; ?>

</td>

<td>

<?= html_escape(
$slider->title
) ?>

</td>

<td>

<?= html_escape(
$slider->subtitle
) ?>

</td>

<td>

<?= $slider->sort_order ?>

</td>

<td>

<span class="badge
badge-<?= $slider->status
== 'publish'
? 'success'
: 'secondary' ?>">

<?= ucfirst(
$slider->status
) ?>

</span>

</td>

<td>

<a href="<?= base_url(
'admin/sliders/edit/' .
$slider->id
) ?>"
class="btn
btn-warning
btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="<?= base_url(
'admin/sliders/delete/' .
$slider->id
) ?>"
class="btn
btn-danger
btn-sm"
onclick="return confirm(
'Yakin hapus slider ini?'
)">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view('admin/layout/footer'); ?>