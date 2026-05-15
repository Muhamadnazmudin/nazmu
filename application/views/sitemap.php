<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

<!-- HOMEPAGE -->
<url>

<loc>

<?= base_url() ?>

</loc>

<changefreq>

daily

</changefreq>

<priority>

1.0

</priority>

</url>

<!-- ARTICLES -->
<?php foreach(
$posts as $post
): ?>

<url>

<loc>

<?= base_url(
'blog/' .
$post->slug
) ?>

</loc>

<lastmod>

<?= date(
'c',
strtotime(
$post->updated_at
??
$post->published_at
)
) ?>

</lastmod>

<changefreq>

weekly

</changefreq>

<priority>

0.8

</priority>

</url>

<?php endforeach; ?>

<!-- CATEGORIES -->
<?php foreach(
$categories as $cat
): ?>

<url>

<loc>

<?= base_url(
'category/' .
$cat->slug
) ?>

</loc>

<changefreq>

weekly

</changefreq>

<priority>

0.7

</priority>

</url>

<?php endforeach; ?>

</urlset>