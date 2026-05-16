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

<div class="
d-flex
justify-content-between
align-items-center">

<h1>

Detail Pesan

</h1>

<a href="<?= base_url(
'admin/messages'
) ?>"
class="
btn btn-secondary">

<i class="
fas fa-arrow-left">
</i>

Kembali

</a>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="
card
shadow-sm">

<div class="
card-header
d-flex
justify-content-between
align-items-center">

<h5 class="mb-0">

Pesan dari

<strong>

<?= html_escape(
$message
->nama
) ?>

</strong>

</h5>

<?php if(
$message
->is_read
== 0
): ?>

<span class="
badge
badge-danger">

Belum Dibaca

</span>

<?php else: ?>

<span class="
badge
badge-success">

Sudah Dibaca

</span>

<?php endif; ?>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="
form-group">

<label>

Nama

</label>

<input
type="text"
class="
form-control"
value="<?= html_escape(
$message
->nama
) ?>"
readonly>

</div>

</div>

<div class="col-md-6">

<div class="
form-group">

<label>

Email

</label>

<input
type="text"
class="
form-control"
value="<?= html_escape(
$message
->email
) ?>"
readonly>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="
form-group">

<label>

WhatsApp

</label>

<input
type="text"
class="
form-control"
value="<?= html_escape(
$message
->whatsapp
) ?>"
readonly>

</div>

</div>

<div class="col-md-6">

<div class="
form-group">

<label>

Jenis Pesan

</label>

<input
type="text"
class="
form-control"
value="<?= html_escape(
$message
->jenis
) ?>"
readonly>

</div>

</div>

</div>

<div class="
form-group">

<label>

Tanggal Kirim

</label>

<input
type="text"
class="
form-control"
value="<?= date(
'd F Y H:i',
strtotime(
$message
->created_at
)
) ?>"
readonly>

</div>

<div class="
form-group">

<label>

Isi Pesan

</label>

<textarea
class="
form-control"
rows="8"
readonly><?= html_escape(
$message
->pesan
) ?></textarea>

</div>

<hr>

<div class="
d-flex
flex-wrap
gap-2">

<a href="
https://wa.me/62<?= preg_replace(
'/[^0-9]/',
'',
ltrim(
$message
->whatsapp,
'0'
)
) ?>?text=Halo%20<?= urlencode(
$message
->nama
) ?>,%20terima%20kasih%20atas%20pesan%20Anda%20di%20Nazmu%20Blog."
target="_blank"
class="
btn btn-success
mr-2">

<i class="
fab fa-whatsapp">
</i>

Balas WhatsApp

</a>

<?php if(
$message
->is_read
== 0
): ?>

<a href="<?= base_url(
'admin/messages/mark_read/'
.
$message
->id
) ?>"
class="
btn btn-primary
mr-2">

<i class="
fas fa-check">
</i>

Tandai Dibaca

</a>

<?php else: ?>

<a href="<?= base_url(
'admin/messages/mark_unread/'
.
$message
->id
) ?>"
class="
btn btn-warning
mr-2">

<i class="
fas fa-undo">
</i>

Tandai Belum Dibaca

</a>

<?php endif; ?>

<a href="<?= base_url(
'admin/messages/delete/'
.
$message
->id
) ?>"
onclick="
return confirm(
'Yakin ingin menghapus pesan ini?'
)"
class="
btn btn-danger">

<i class="
fas fa-trash">
</i>

Hapus Pesan

</a>

</div>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>