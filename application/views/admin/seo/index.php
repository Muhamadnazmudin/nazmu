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

<h1>

SEO Management

</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm">

<div class="card-body">

<form action="<?= base_url(
'admin/seo/update'
) ?>"
method="POST">

<input type="hidden"
name="<?= $this->security
->get_csrf_token_name(); ?>"
value="<?= $this->security
->get_csrf_hash(); ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Google Verification

</label>

<textarea
name="google_verification"
class="form-control"
rows="4"
placeholder="Paste verification code dari Google Search Console"><?= html_escape(
$setting->google_verification
) ?></textarea>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Google Analytics ID

</label>

<input type="text"
name="google_analytics"
class="form-control"
placeholder="G-XXXXXXXX"
value="<?= html_escape(
$setting->google_analytics
) ?>">

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Google Tag Manager

</label>

<input type="text"
name="google_tag_manager"
class="form-control"
placeholder="GTM-XXXXXXX"
value="<?= html_escape(
$setting->google_tag_manager
) ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Robots Index

</label>

<select
name="robots_index"
class="form-control">

<option value="index,follow"
<?= $setting
->robots_index
==
'index,follow'
? 'selected'
: '' ?>>

Index Website

</option>

<option value="noindex,nofollow"
<?= $setting
->robots_index
==
'noindex,nofollow'
? 'selected'
: '' ?>>

No Index

</option>

</select>

</div>

</div>

</div>

<div class="form-group">

<label>

Header Script

</label>

<textarea
name="header_script"
class="form-control"
rows="5"><?= html_escape(
$setting->header_script
) ?></textarea>

</div>

<div class="form-group">

<label>

Footer Script

</label>

<textarea
name="footer_script"
class="form-control"
rows="5"><?= html_escape(
$setting->footer_script
) ?></textarea>

</div>

<div class="alert
alert-info">

<strong>

Sitemap URL:

</strong>

<br>

<?= base_url(
'sitemap.xml'
) ?>

</div>

<button type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan SEO

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