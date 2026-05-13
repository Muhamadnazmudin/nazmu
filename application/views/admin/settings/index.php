<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<h1>

Pengaturan Website

</h1>

<button type="submit"
form="settingForm"
class="btn btn-primary shadow-sm">

<i class="fas fa-save"></i>

Simpan Pengaturan

</button>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(
$this->session->flashdata(
'success'
)): ?>

<div class="alert alert-success alert-dismissible fade show">

<i class="fas fa-check-circle"></i>

<?= $this->session->flashdata(
'success'
) ?>

<button type="button"
class="close"
data-dismiss="alert">

<span>&times;</span>

</button>

</div>

<?php endif; ?>

<form id="settingForm"
action="<?= base_url(
'admin/settings/update'
) ?>"
method="POST">

<div class="card shadow-sm border-0">

<div class="card-header p-0">

<ul class="nav nav-tabs"
id="settingTabs">

<li class="nav-item">
<a class="nav-link active"
data-toggle="tab"
href="#general">

General

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#branding">

Branding

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#seo">

SEO

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#contact">

Contact

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#social">

Social

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#footer">

Footer

</a>
</li>

<li class="nav-item">
<a class="nav-link"
data-toggle="tab"
href="#scripts">

Scripts

</a>
</li>

</ul>

</div>

<div class="card-body p-4">

<div class="tab-content">

<!-- GENERAL -->
<div class="tab-pane fade show active"
id="general">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Website</label>

<input type="text"
name="site_name"
class="form-control"
value="<?= $setting->site_name ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Tagline</label>

<input type="text"
name="tagline"
class="form-control"
value="<?= $setting->tagline ?>">

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Website</label>

<textarea name="site_description"
class="form-control"
rows="4"><?= $setting->site_description ?></textarea>

</div>

</div>

<!-- BRANDING -->
<div class="tab-pane fade"
id="branding">

<!-- THEME -->
<div class="card shadow-sm mb-4 border-0">

<div class="card-header bg-white">

<h5 class="mb-0">

Tema Website

</h5>

</div>

<div class="card-body">

<div class="row align-items-end">

<div class="col-md-6">

<div class="form-group mb-0">

<label>

Pilih Tema

</label>

<select
name="active_theme"
class="form-control">

<option value="default"
<?= (
$setting->active_theme
?? 'default'
) == 'default'
? 'selected'
: '' ?>>

Default (Current UI)

</option>

<option value="modern"
<?= (
$setting->active_theme
?? ''
) == 'modern'
? 'selected'
: '' ?>>

Modern

</option>

<option value="school"
<?= (
$setting->active_theme
?? ''
) == 'school'
? 'selected'
: '' ?>>

School

</option>

<option value="dark"
<?= (
$setting->active_theme
?? ''
) == 'dark'
? 'selected'
: '' ?>>

Dark Mode

</option>

</select>

<small class="text-muted">

Mengubah tampilan
admin dan website secara global

</small>

</div>

</div>

<div class="col-md-6">

<div class="alert
alert-info mb-0">

<i class="fas fa-palette"></i>

Tema saat ini:

<strong>

<?= ucfirst(
$setting->active_theme
?? 'default'
) ?>

</strong>

</div>

</div>

</div>

</div>

</div>

<!-- MEDIA BRANDING -->
<div class="row">

<?php
$images = [
'logo' => 'Logo Website',
'favicon' => 'Favicon',
'og_image' => 'OG Image'
];
?>

<?php foreach(
$images as $field => $label
): ?>

<div class="col-md-4">

<div class="card border shadow-sm">

<div class="card-body text-center">

<h5>

<?= $label ?>

</h5>

<img id="<?= $field ?>Preview"
src="<?= !empty(
$setting->$field
)
? base_url(
'uploads/media/' .
$setting->$field
)
: 'https://placehold.co/300x180?text=No+Image' ?>"
style="
width:100%;
height:180px;
object-fit:contain;
border-radius:12px;
background:#f8f9fa;
padding:10px;
margin-bottom:15px;
">

<input type="hidden"
name="<?= $field ?>"
id="<?= $field ?>"
value="<?= $setting->$field ?>">

<button type="button"
class="btn btn-primary btn-block"
onclick="openMediaModal(
'<?= $field ?>'
)">

Pilih Media

</button>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<!-- SEO -->
<div class="tab-pane fade"
id="seo">

<div class="form-group">

<label>Meta Title</label>

<input type="text"
name="meta_title"
class="form-control"
value="<?= $setting->meta_title ?>">

</div>

<div class="form-group">

<label>Meta Description</label>

<textarea name="meta_description"
class="form-control"
rows="4"><?= $setting->meta_description ?></textarea>

</div>

<div class="form-group">

<label>Meta Keywords</label>

<textarea name="meta_keywords"
class="form-control"
rows="3"><?= $setting->meta_keywords ?></textarea>

</div>

</div>

<!-- CONTACT -->
<div class="tab-pane fade"
id="contact">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?= $setting->email ?>">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>WhatsApp</label>

<input type="text"
name="whatsapp"
class="form-control"
value="<?= $setting->whatsapp ?>">

</div>

</div>

</div>

<div class="form-group">

<label>Alamat</label>

<textarea name="address"
class="form-control"
rows="3"><?= $setting->address ?></textarea>

</div>

<div class="form-group">

<label>Google Maps Embed</label>

<textarea name="maps_embed"
class="form-control"
rows="5"><?= $setting->maps_embed ?></textarea>

</div>

</div>

<!-- SOCIAL -->
<div class="tab-pane fade"
id="social">

<?php
$socials = [
'facebook',
'instagram',
'youtube',
'tiktok',
'twitter',
'linkedin'
];
?>

<div class="row">

<?php foreach(
$socials as $social
): ?>

<div class="col-md-6">

<div class="form-group">

<label>
<?= ucfirst($social) ?>
</label>

<input type="text"
name="<?= $social ?>"
class="form-control"
value="<?= $setting->$social ?>">

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<!-- FOOTER -->
<div class="tab-pane fade"
id="footer">

<div class="form-group">

<label>Footer Text</label>

<textarea name="footer_text"
class="form-control"
rows="4"><?= $setting->footer_text ?></textarea>

</div>

<div class="form-group">

<label>Copyright</label>

<input type="text"
name="copyright"
class="form-control"
value="<?= $setting->copyright ?>">

</div>

</div>

<!-- SCRIPTS -->
<div class="tab-pane fade"
id="scripts">

<div class="form-group">

<label>Google Analytics</label>

<textarea name="google_analytics"
class="form-control"
rows="5"><?= $setting->google_analytics ?></textarea>

</div>

<div class="form-group">

<label>Facebook Pixel</label>

<textarea name="facebook_pixel"
class="form-control"
rows="5"><?= $setting->facebook_pixel ?></textarea>

</div>

<div class="form-group">

<label>Header Script</label>

<textarea name="header_script"
class="form-control"
rows="5"><?= $setting->header_script ?></textarea>

</div>

<div class="form-group">

<label>Footer Script</label>

<textarea name="footer_script"
class="form-control"
rows="5"><?= $setting->footer_script ?></textarea>

</div>

</div>

</div>

</div>

</div>

</form>

</div>

</section>

</div>

<!-- MEDIA MODAL -->
<div class="modal fade"
id="mediaModal">

<div class="modal-dialog modal-xl">

<div class="modal-content">

<div class="modal-header">

<h5>

Pilih Media

</h5>

<button type="button"
class="close"
data-dismiss="modal">

<span>&times;</span>

</button>

</div>

<div class="modal-body">

<div class="row">

<?php foreach(
$media as $m
): ?>

<div class="col-md-2 mb-3">

<div class="card media-item shadow-sm"
style="
cursor:pointer;
border-radius:12px;
overflow:hidden;
"
onclick="selectMedia(
'<?= $m->file_name ?>'
)">

<img src="<?= base_url(
'uploads/media/'.
$m->file_name
) ?>"
style="
width:100%;
height:120px;
object-fit:cover;
">

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</div>

</div>

</div>

<?php $this->load->view('admin/layout/footer'); ?>

<script>

let selectedField = '';

function openMediaModal(field)
{
    selectedField = field;

    $('#mediaModal')
    .modal('show');
}

function selectMedia(file)
{
    $('#' + selectedField)
    .val(file);

    $('#' + selectedField + 'Preview')
    .attr(
        'src',
        '<?= base_url('uploads/media/') ?>' + file
    );

    $('#mediaModal')
    .modal('hide');
}

</script>