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

Ads Management

</h1>

<span class="badge
badge-info">

Google AdSense Ready

</span>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body">

<form action="<?= base_url(
'admin/ads/update'
) ?>"
method="POST">

<input type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<!-- STATUS -->
<div class="form-group">

<label>

Status Iklan

</label>

<select
name="ads_status"
class="form-control">

<option value="inactive"
<?= $setting
->ads_status
==
'inactive'
? 'selected'
: '' ?>>

Nonaktif

</option>

<option value="active"
<?= $setting
->ads_status
==
'active'
? 'selected'
: '' ?>>

Aktif

</option>

</select>

</div>

<hr>

<h5 class="mb-3">

Google Auto Ads

</h5>

<div class="form-group">

<label>

Paste Script Auto Ads

</label>

<textarea
name="adsense_auto"
class="form-control"
rows="6"
placeholder="Paste script Google AdSense Auto Ads disini"><?= html_escape(
$setting->adsense_auto
) ?></textarea>

<small class="text-muted">

Contoh:
script pagead2.googlesyndication.com

</small>

</div>

<hr>

<h5 class="mb-3">

Posisi Banner Ads

</h5>

<div class="form-group">

<label>

Header Ads

</label>

<textarea
name="ads_header"
class="form-control"
rows="5"><?= html_escape(
$setting->ads_header
) ?></textarea>

</div>

<div class="form-group">

<label>

Sidebar Ads

</label>

<textarea
name="ads_sidebar"
class="form-control"
rows="5"><?= html_escape(
$setting->ads_sidebar
) ?></textarea>

</div>

<div class="form-group">

<label>

In Article Ads

</label>

<textarea
name="ads_article"
class="form-control"
rows="5"><?= html_escape(
$setting->ads_article
) ?></textarea>

</div>

<div class="form-group">

<label>

Footer Ads

</label>

<textarea
name="ads_footer"
class="form-control"
rows="5"><?= html_escape(
$setting->ads_footer
) ?></textarea>

</div>

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan Pengaturan Ads

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php $this->load->view(
'admin/layout/footer'
); ?>