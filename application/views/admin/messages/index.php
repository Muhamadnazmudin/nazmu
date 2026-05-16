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

Pesan Kontak

</h1>

<span class="
badge
badge-danger">

<?= $unread_count ?>

Belum Dibaca

</span>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(
$this->session
->flashdata(
'success'
)
): ?>

<div class="
alert
alert-success
alert-dismissible
fade show">

<?= $this->session
->flashdata(
'success'
); ?>

<button
type="button"
class="close"
data-dismiss="alert">

<span>
&times;
</span>

</button>

</div>

<?php endif; ?>

<?php if(
$this->session
->flashdata(
'error'
)
): ?>

<div class="
alert
alert-danger
alert-dismissible
fade show">

<?= $this->session
->flashdata(
'error'
); ?>

<button
type="button"
class="close"
data-dismiss="alert">

<span>
&times;
</span>

</button>

</div>

<?php endif; ?>

<div class="
card
shadow-sm">

<div class="card-header">

<form
method="GET"
action="<?= base_url(
'admin/messages'
) ?>">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="keyword"
class="
form-control"
placeholder="
Cari nama,
email,
WA,
atau isi pesan..."
value="<?= html_escape(
$this->input
->get(
'keyword'
)
) ?>">

</div>

<div class="col-md-2">

<button
type="submit"
class="
btn btn-primary
btn-block">

<i class="
fas fa-search">
</i>

Cari

</button>

</div>

</div>

</form>

</div>

<div class="card-body">

<form
method="POST"
action="<?= base_url(
'admin/messages/bulk_delete'
) ?>">

<input
type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<div class="
table-responsive">

<table class="
table
table-hover
table-bordered">

<thead
class="thead-light">

<tr>

<th width="40">

<input
type="checkbox"
id="checkAll">

</th>

<th>Status</th>
<th>Nama</th>
<th>WhatsApp</th>
<th>Jenis</th>
<th>Pesan</th>
<th>Tanggal</th>
<th width="220">
Aksi
</th>

</tr>

</thead>

<tbody>

<?php if(
!empty(
$messages
)
): ?>

<?php foreach(
$messages
as $row
): ?>

<tr class="
<?= $row
->is_read == 0
? 'table-warning'
: '' ?>">

<td>

<input
type="checkbox"
name="ids[]"
value="<?= $row
->id ?>">

</td>

<td>

<?php if(
$row->is_read
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

</td>

<td>

<strong>

<?= html_escape(
$row->nama
) ?>

</strong>

<br>

<small
class="
text-muted">

<?= html_escape(
$row->email
) ?>

</small>

</td>

<td>

<a href="
https://wa.me/62<?= preg_replace(
'/[^0-9]/',
'',
ltrim(
$row
->whatsapp,
'0'
)
) ?>"
target="_blank">

<?= html_escape(
$row
->whatsapp
) ?>

</a>

</td>

<td>

<span class="
badge
badge-info">

<?= html_escape(
$row
->jenis
) ?>

</span>

</td>

<td>

<?= character_limiter(
strip_tags(
$row
->pesan
),
60
); ?>

</td>

<td>

<?= date(
'd M Y H:i',
strtotime(
$row
->created_at
)
); ?>

</td>

<td>

<a href="<?= base_url(
'admin/messages/detail/'
.
$row->id
) ?>"
class="
btn btn-sm
btn-info">

<i class="
fas fa-eye">
</i>

Detail

</a>

<?php if(
$row->is_read
== 0
): ?>

<a href="<?= base_url(
'admin/messages/mark_read/'
.
$row->id
) ?>"
class="
btn btn-sm
btn-success">

<i class="
fas fa-check">
</i>

Read

</a>

<?php else: ?>

<a href="<?= base_url(
'admin/messages/mark_unread/'
.
$row->id
) ?>"
class="
btn btn-sm
btn-warning">

<i class="
fas fa-undo">
</i>

Unread

</a>

<?php endif; ?>

<a href="<?= base_url(
'admin/messages/delete/'
.
$row->id
) ?>"
onclick="
return confirm(
'Hapus pesan ini?'
)"
class="
btn btn-sm
btn-danger">

<i class="
fas fa-trash">
</i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="8"
class="
text-center
text-muted">

Belum ada pesan masuk

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

<button
type="submit"
class="
btn btn-danger
mt-3"
onclick="
return confirm(
'Hapus pesan terpilih?'
)">

<i class="
fas fa-trash">
</i>

Hapus Terpilih

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<script>

document
.getElementById(
'checkAll'
)
.addEventListener(
'change',
function(){

const checks =
document
.querySelectorAll(
'input[name="ids[]"]'
);

checks.forEach(
checkbox => {

checkbox.checked =
this.checked;

});

});
</script>

<?php $this->load->view(
'admin/layout/footer'
); ?>