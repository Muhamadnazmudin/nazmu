<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

<?php if(
!empty($title)
): ?>

<?= $title ?> |
<?= $setting->site_name ?>

<?php else: ?>

<?= $setting->site_name ?>

<?php endif; ?>

</title>

<!-- FAVICON -->
<?php if(
!empty(
$setting->favicon
)
): ?>

<link rel="icon"
type="image/png"
href="<?= base_url(
'uploads/media/' .
$setting->favicon
) ?>">

<?php else: ?>

<link rel="icon"
href="<?= base_url(
'assets/admin/dist/img/AdminLTELogo.png'
) ?>">

<?php endif; ?>

<!-- GOOGLE FONT -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- FONT AWESOME -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/fontawesome-free/css/all.min.css'
) ?>">

<!-- TEMPUSDOMINUS -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'
) ?>">

<!-- ICHECK -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css'
) ?>">

<!-- JQV MAP -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/jqvmap/jqvmap.min.css'
) ?>">

<!-- ADMINLTE -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/dist/css/adminlte.min.css'
) ?>">

<!-- OVERLAY -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
) ?>">

<!-- DATERANGE -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/daterangepicker/daterangepicker.css'
) ?>">

<!-- SUMMERNOTE -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/summernote/summernote-bs4.min.css'
) ?>">

<!-- DATATABLE -->
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<!-- ADMIN THEME -->
<link rel="stylesheet"
href="<?= base_url(
'assets/themes/' .
($setting->active_theme
?? 'default') .
'/admin.css'
) ?>">
<style>

/* BODY */
body{
font-family:
'Source Sans Pro',
sans-serif;
}

/* SIDEBAR BRAND */
.brand-link{
height:auto;
min-height:76px;
display:flex;
align-items:center;
padding:14px 18px;
border-bottom:
1px solid rgba(
255,255,255,.08
);
overflow:hidden;
}

/* LOGO */
.brand-logo{
width:auto;
height:46px;
max-width:55px;
object-fit:contain;
margin-right:14px;
flex-shrink:0;
}

/* TITLE */
.brand-title{
font-size:18px;
font-weight:700;
line-height:1.2;
color:#fff;
margin:0;
}

.brand-subtitle{
font-size:12px;
color:#adb5bd;
display:block;
margin-top:2px;
line-height:1.2;
}

/* USER PANEL */
.user-panel{
border-top:
1px solid rgba(
255,255,255,.06
);
border-bottom:
1px solid rgba(
255,255,255,.06
);
padding-top:16px;
padding-bottom:16px;
}

/* SIDEBAR */
.sidebar{
scrollbar-width:thin;
}

/* NAV */
.nav-sidebar .nav-link{
border-radius:10px;
margin-bottom:4px;
}

.nav-sidebar
.nav-link.active{
box-shadow:
0 4px 12px
rgba(
0,123,255,.25
);
}

/* MOBILE */
@media(max-width:768px){

.brand-logo{
height:40px;
max-width:48px;
}

.brand-title{
font-size:16px;
}

.brand-subtitle{
font-size:11px;
}

}

</style>

<!-- CUSTOM HEADER SCRIPT -->
<?php if(
!empty(
$setting->header_script
)
): ?>

<?= $setting->header_script ?>

<?php endif; ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">