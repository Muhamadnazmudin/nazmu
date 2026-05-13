<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="d-flex justify-content-between">

<h1>Draft Artikel</h1>

<a href="<?= base_url('admin/posts/create') ?>"
class="btn btn-primary">

Tambah Artikel

</a>

</div>

</div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>
    <th width="50">No</th>
    <th width="100">Thumbnail</th>
    <th>Judul</th>
    <th width="120">Status</th>
    <th width="180">Tanggal</th>
    <th width="250">Aksi</th>
</tr>

</thead>

<tbody>

<?php if(empty($posts)): ?>

<tr>
    <td colspan="6"
        class="text-center">

        Belum ada draft artikel

    </td>
</tr>

<?php endif; ?>

<?php foreach($posts as $key => $post): ?>

<tr>

<td>
    <?= $key+1 ?>
</td>

<td>

<?php if($post->thumbnail): ?>

<img src="<?= base_url('uploads/posts/'.$post->thumbnail) ?>"
style="width:80px;
height:60px;
object-fit:cover;
border-radius:5px;">

<?php else: ?>

<span class="badge badge-secondary">
No Image
</span>

<?php endif; ?>

</td>

<td>

<strong>
<?= $post->title ?>
</strong>

</td>

<td>

<span class="badge badge-warning">
Draft
</span>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime($post->created_at)
) ?>

</td>

<td>

<a href="<?= base_url('admin/posts/toggle_status/'.$post->id) ?>"
class="btn btn-success btn-sm">

<i class="fas fa-upload"></i>
Publish

</a>

<a href="#"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>
Edit

</a>

<a href="<?= base_url('admin/posts/delete/'.$post->id) ?>"
onclick="return confirm('Hapus artikel ini?')"
class="btn btn-danger btn-sm">

<i class="fas fa-trash"></i>
Delete

</a>

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