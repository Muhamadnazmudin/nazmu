<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>


<div class="container py-5">

<div class="row
justify-content-center">

<div class="col-lg-8">

<div class="
card
shadow-sm
border-0">

<div class="
card-body
p-4">

<div class="
text-center
mb-4">

<h2
class="
font-weight-bold">

Pusat Permintaan
& Saran

</h2>

<p
class="
text-muted
mb-0">

Punya request tutorial,
permintaan file,
saran website,
atau laporan error?

Silakan kirim pesan Anda.

</p>

</div>

<?php if(
$this->session
->flashdata(
'success'
)
): ?>

<div class="
custom-alert
success-alert">

<div class="
alert-icon">

<i class="
fas fa-check-circle">
</i>

</div>

<div class="
alert-content">

<strong>

Berhasil!

</strong>

<p class="mb-0">

<?= $this->session
->flashdata(
'success'
); ?>

</p>

</div>

<button
class="
alert-close"
onclick="
this.parentElement.remove()
">

×

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
custom-alert
error-alert">

<div class="
alert-icon">

<i class="
fas fa-times-circle">
</i>

</div>

<div class="
alert-content">

<strong>

Oops!

</strong>

<p class="mb-0">

<?= strip_tags(
$this->session
->flashdata(
'error'
)
); ?>

</p>

</div>

<button
class="
alert-close"
onclick="
this.parentElement.remove()
">

×

</button>

</div>

<?php endif; ?>

<form
action="<?= base_url(
'kontak/send'
) ?>"
method="POST">

<!-- CSRF -->
<input
type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<div class="row">

<div class="col-md-6">

<div class="
form-group">

<label>

Nama Lengkap

</label>

<input
type="text"
name="nama"
class="
form-control"
placeholder="
Masukkan nama"
required
value="<?= set_value(
'nama'
) ?>">

</div>

</div>

<div class="col-md-6">

<div class="
form-group">

<label>

Email

</label>

<input
type="email"
name="email"
class="
form-control"
placeholder="
Masukkan email"
required
value="<?= set_value(
'email'
) ?>">

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="
form-group">

<label>

Nomor WhatsApp

</label>

<input
type="text"
name="whatsapp"
class="
form-control"
placeholder="
08xxxxxxxxxx"
required
value="<?= set_value(
'whatsapp'
) ?>">

</div>

</div>

<div class="col-md-6">

<div class="
form-group">

<label>

Jenis Pesan

</label>

<select
name="jenis"
class="
form-control"
required>

<option value="">

-- Pilih Jenis --

</option>

<option value="
Saran">

Saran Website

</option>

<option value="
Permintaan Tutorial">

Permintaan Tutorial

</option>

<option value="
Request File">

Request File

</option>

<option value="
Laporan Error">

Laporan Error

</option>

<option value="
Lainnya">

Lainnya

</option>

</select>

</div>

</div>

</div>

<div class="
form-group">

<label>

Isi Pesan /
Permintaan

</label>

<textarea
name="pesan"
class="
form-control"
rows="6"
placeholder="
Tulis pesan,
permintaan tutorial,
request file,
atau saran Anda..."
required><?= set_value(
'pesan'
) ?></textarea>

</div>

<div class="
text-center
mt-4">

<button
type="submit"
class="
btn
btn-primary
btn-lg
px-5">

<i class="
fas fa-paper-plane">
</i>

Kirim Pesan

</button>

</div>

</form>

</div>

</div>

<div class="
text-center
mt-4
text-muted">

<small>

Kami akan membaca
setiap pesan yang masuk.
Terima kasih atas
dukungan Anda 🙌

</small>

</div>

</div>

</div>

</div>

<style>

.card{
border-radius:20px;
}

.form-control{
border-radius:12px;
min-height:46px;
}

textarea.form-control{
min-height:140px;
}

.btn-primary{
border-radius:12px;
}
.custom-alert{
display:flex;
align-items:flex-start;
gap:16px;
padding:18px 20px;
border-radius:18px;
margin-bottom:24px;
position:relative;
animation:fadeIn .3s ease;
box-shadow:
0 8px 30px
rgba(0,0,0,.05);
}

.success-alert{
background:
linear-gradient(
135deg,
#e8fff2,
#d8f8e7
);
border:
1px solid
#b9ebc8;
color:#1f7a45;
}

.error-alert{
background:
linear-gradient(
135deg,
#fff1f1,
#ffe2e2
);
border:
1px solid
#ffcaca;
color:#c0392b;
}

.alert-icon{
font-size:26px;
line-height:1;
margin-top:2px;
}

.alert-content strong{
display:block;
font-size:16px;
margin-bottom:4px;
}

.alert-content p{
font-size:14px;
opacity:.9;
}

.alert-close{
position:absolute;
right:14px;
top:14px;
border:none;
background:none;
font-size:22px;
cursor:pointer;
opacity:.5;
transition:.2s;
}

.alert-close:hover{
opacity:1;
transform:scale(1.1);
}

@keyframes fadeIn{
from{
opacity:0;
transform:
translateY(-10px);
}
to{
opacity:1;
transform:
translateY(0);
}
}
</style>

<?php $this->load->view('public/layout/footer'); ?>