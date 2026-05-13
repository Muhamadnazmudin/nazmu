<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1 class="m-0">

Semua Artikel

</h1>

<a href="<?= base_url('admin/posts/create') ?>"
class="btn btn-primary shadow-sm">

<i class="fas fa-plus"></i>

Tambah Artikel

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm border-0">

<div class="card-body table-responsive p-0">

<table id="datatable"
class="table table-hover align-middle mb-0">

<thead class="bg-light">

<tr>

<th width="60">
No
</th>

<th width="110">
Thumbnail
</th>

<th>
Artikel
</th>

<th width="150">
Kategori
</th>

<th width="100">
Status
</th>

<th width="80">
Views
</th>

<th width="130">
Tanggal
</th>

<th width="200">
Aksi
</th>

</tr>

</thead>

<tbody>

<?php if(empty($posts)): ?>

<tr>

<td colspan="8"
class="text-center py-5">

<div class="text-muted">

<i class="fas fa-newspaper fa-3x mb-3"></i>

<h5>
Belum ada artikel
</h5>

<p>

Klik tombol
<b>Tambah Artikel</b>
untuk mulai membuat post.

</p>

</div>

</td>

</tr>

<?php endif; ?>

<?php foreach($posts as $key => $post): ?>

<tr>

<!-- NO -->
<td>

<?= $key + 1 ?>

</td>

<!-- THUMBNAIL -->
<td>

<?php if(!empty($post->thumbnail)): ?>

<img src="<?= base_url('uploads/media/'.$post->thumbnail) ?>"
style="
width:90px;
height:60px;
object-fit:cover;
border-radius:10px;
box-shadow:
0 2px 10px
rgba(0,0,0,.08);
">

<?php else: ?>

<div style="
width:90px;
height:60px;
background:#f5f5f5;
border-radius:10px;
display:flex;
align-items:center;
justify-content:center;
font-size:12px;
color:#999;">

No Image

</div>

<?php endif; ?>

</td>

<!-- TITLE -->
<td>

<div>

<strong style="
font-size:15px;">

<?= $post->title ?>

</strong>

</div>

<div class="text-muted small mt-1">

<?= character_limiter(
strip_tags(
$post->excerpt
),
80
) ?>

</div>

<div class="small mt-2">

<code>

<?= $post->slug ?>

</code>

</div>

</td>

<!-- CATEGORY -->
<td>

<?php if(!empty($post->category_name)): ?>

<span class="badge badge-light border px-3 py-2">

<?= $post->category_name ?>

</span>

<?php else: ?>

-

<?php endif; ?>

</td>

<!-- STATUS -->
<td>

<?php if($post->status == 'publish'): ?>

<span class="badge badge-success px-3 py-2">

Publish

</span>

<?php else: ?>

<span class="badge badge-warning px-3 py-2">

Draft

</span>

<?php endif; ?>

</td>

<!-- VIEWS -->
<td>

<span class="font-weight-bold">

<?= $post->views ?>

</span>

</td>

<!-- DATE -->
<td>

<?= date(
'd M Y',
strtotime(
$post->created_at
)
) ?>

</td>

<!-- ACTION -->
<td>

<div class="btn-group">

<!-- VIEW -->
<a href="<?= base_url('blog/'.$post->slug) ?>"
target="_blank"
class="btn btn-info btn-sm"
title="View">

<i class="fas fa-eye"></i>

</a>

<!-- TOGGLE -->
<?php if($post->status == 'publish'): ?>

<a href="<?= base_url('admin/posts/toggle_status/'.$post->id) ?>"
class="btn btn-secondary btn-sm"
onclick="return confirm('Ubah menjadi draft?')"
title="Draft">

<i class="fas fa-file"></i>

</a>

<?php else: ?>

<a href="<?= base_url('admin/posts/toggle_status/'.$post->id) ?>"
class="btn btn-success btn-sm"
onclick="return confirm('Publish artikel ini?')"
title="Publish">

<i class="fas fa-upload"></i>

</a>

<?php endif; ?>

<!-- EDIT -->
<a href="<?= base_url('admin/posts/edit/'.$post->id) ?>"
class="btn btn-warning btn-sm"
title="Edit">

<i class="fas fa-edit"></i>

</a>

<!-- DELETE -->
<a href="<?= base_url('admin/posts/delete/'.$post->id) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus artikel ini?')"
title="Delete">

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