<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<?php

$page_title =
!empty($meta_title)
? $meta_title
: (
$setting->meta_title
?? $setting->site_name
);

$page_description =
!empty(
$meta_description
)
? strip_tags(
$meta_description
)
: (
$setting->meta_description
?? $setting->site_description
?? 'Website Modern'
);

$page_image =
!empty(
$setting->og_image
)
? base_url(
'uploads/media/' .
$setting->og_image
)
: (
!empty(
$setting->logo
)
? base_url(
'uploads/media/' .
$setting->logo
)
: base_url(
'assets/public/assets/default-og.jpg'
)
);

?>

<!-- TITLE -->
<title>

<?= html_escape(
$page_title
) ?>

</title>

<!-- BASIC SEO -->
<meta name="description"
content="<?= html_escape(
$page_description
) ?>">

<meta name="keywords"
content="<?= html_escape(
$setting->meta_keywords
?? ''
) ?>">

<meta name="author"
content="<?= html_escape(
$setting->site_name
) ?>">

<!-- ROBOTS -->
<meta name="robots"
content="<?= !empty(
$setting->robots_index
)
? $setting->robots_index
: 'index,follow' ?>">

<meta name="googlebot"
content="<?= !empty(
$setting->robots_index
)
? $setting->robots_index
: 'index,follow'
?>,max-image-preview:large">

<meta name="bingbot"
content="<?= !empty(
$setting->robots_index
)
? $setting->robots_index
: 'index,follow' ?>">

<link rel="canonical"
href="<?= current_url(); ?>">

<!-- GOOGLE SEARCH CONSOLE -->
<?php if(
!empty(
$setting->google_verification
)
): ?>

<meta
name="google-site-verification"
content="<?= html_escape(
$setting->google_verification
) ?>">

<?php endif; ?>

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
<meta property="og:type"
content="website">

<meta property="og:title"
content="<?= html_escape(
$page_title
) ?>">

<meta property="og:description"
content="<?= html_escape(
$page_description
) ?>">

<meta property="og:image"
content="<?= $page_image ?>">

<meta property="og:url"
content="<?= current_url() ?>">

<meta property="og:site_name"
content="<?= html_escape(
$setting->site_name
) ?>">

<meta property="og:locale"
content="id_ID">

<!-- TWITTER CARD -->
<meta name="twitter:card"
content="summary_large_image">

<meta name="twitter:title"
content="<?= html_escape(
$page_title
) ?>">

<meta name="twitter:description"
content="<?= html_escape(
$page_description
) ?>">

<meta name="twitter:image"
content="<?= $page_image ?>">

<!-- GOOGLE ANALYTICS -->
<?php if(
!empty(
$setting->google_analytics
)
): ?>

<script async
src="https://www.googletagmanager.com/gtag/js?id=<?= $setting->google_analytics ?>">
</script>

<script>
window.dataLayer =
window.dataLayer || [];

function gtag(){
dataLayer.push(arguments);
}

gtag(
'js',
new Date()
);

gtag(
'config',
'<?= $setting->google_analytics ?>'
);
</script>

<?php endif; ?>

<!-- GOOGLE TAG MANAGER -->
<?php if(
!empty(
$setting->google_tag_manager
)
): ?>

<script>
(function(w,d,s,l,i){

w[l]=w[l]||[];

w[l].push({
'gtm.start':
new Date().getTime(),
event:'gtm.js'
});

var f =
d.getElementsByTagName(s)[0],

j =
d.createElement(s),

dl =
l != 'dataLayer'
? '&l=' + l
: '';

j.async = true;

j.src =
'https://www.googletagmanager.com/gtm.js?id='
+ i + dl;

f.parentNode
.insertBefore(
j,
f
);

})(
window,
document,
'script',
'dataLayer',
'<?= $setting->google_tag_manager ?>'
);
</script>

<?php endif; ?>

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

<!-- GOOGLE ADSENSE AUTO ADS -->
<?php if(
$setting->ads_status
==
'active'
&&
!empty(
$setting->adsense_auto
)
): ?>

<?= $setting->adsense_auto ?>

<?php endif; ?>

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