<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<!-- SEO -->
<meta name="description"
content="<?= !empty(
$meta_description
)
? $meta_description
: (
$setting->meta_description
?? $setting->site_description
?? 'Website Modern'
) ?>">

<meta name="keywords"
content="<?= $setting->meta_keywords
?? '' ?>">

<meta name="author"
content="<?= $setting->site_name ?>">

<!-- TITLE -->
<title>

<?php if(
!empty(
$meta_title
)
): ?>

<?= $meta_title ?>

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
'assets/public/assets/favicon.ico'
) ?>">

<?php endif; ?>

<!-- OPEN GRAPH -->
<meta property="og:title"
content="<?= isset($title)
? $title
: (
$setting->meta_title
?? ''
) ?>">

<meta property="og:description"
content="<?= !empty(
$meta_description
)
? $meta_description
: (
$setting->meta_description
?? ''
) ?>">

<meta property="og:type"
content="website">

<meta property="og:image"
content="<?=
!empty(
$setting->og_image
)
? base_url(
'uploads/media/' .
$setting->og_image
)
: base_url(
'assets/public/assets/default-og.jpg'
)
?>">

<meta property="og:url"
content="<?= current_url() ?>">

<!-- TWITTER CARD -->
<meta name="twitter:card"
content="summary_large_image">

<meta name="twitter:title"
content="<?= isset($title)
? $title
: (
$setting->meta_title
?? ''
) ?>">

<meta name="twitter:description"
content="<?= !empty(
$meta_description
)
? $meta_description
: (
$setting->meta_description
?? ''
) ?>">

<!-- GOOGLE FONT -->
<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- BOOTSTRAP -->
<link href="<?= base_url(
'assets/public/css/styles.css'
) ?>"
rel="stylesheet">

<!-- ICON -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- CUSTOM CSS -->
<link href="<?= base_url(
'assets/public/css/custom.css'
) ?>"
rel="stylesheet">
<!-- THEME CSS -->
<link rel="stylesheet"
href="<?= base_url(
'assets/themes/' .
($setting->active_theme
?? 'default') .
'/public.css'
) ?>">

<!-- CUSTOM HEADER SCRIPT -->
<?php if(
!empty(
$setting->header_script
)
): ?>

<?= $setting->header_script ?>

<?php endif; ?>

</head>

<body>