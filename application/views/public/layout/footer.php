<footer class="footer-modern">

<div class="container">

<div class="row gy-4">

<!-- ABOUT -->
<div class="col-lg-5 col-md-6">

<div class="footer-brand-wrap d-flex align-items-center mb-3">

<?php if(
!empty($setting->logo)
): ?>

<img src="<?= base_url(
'uploads/media/' .
$setting->logo
) ?>"
alt="Logo"
style="
height:50px;
width:auto;
object-fit:contain;
margin-right:15px;
">

<?php endif; ?>

<div>

<h4 class="footer-title mb-1">

<?= $setting->site_name
?? 'Nazmu Blog' ?>

</h4>

<p class="mb-0 text-muted">

<?= $setting->tagline
?? 'Website Modern' ?>

</p>

</div>

</div>

<p class="footer-text">

<?= !empty(
$setting->site_description
)
? $setting->site_description
: 'Blog personal berisi artikel, tutorial, insight dan berbagai hal menarik lainnya.' ?>

</p>

</div>

<!-- MENU -->
<div class="col-lg-3 col-md-6">

<h5 class="footer-heading">

Menu

</h5>

<ul class="footer-links">

<li>
<a href="<?= base_url() ?>">
Home
</a>
</li>

<li>
<a href="<?= base_url('articles') ?>">
Artikel
</a>
</li>

<li>
<a href="<?= base_url('search') ?>">
Pencarian
</a>
</li>

</ul>



</ul>

</div>

<!-- CONTACT -->
<div class="col-lg-4">

<h5 class="footer-heading">

Hubungi Kami

</h5>

<ul class="list-unstyled text-muted">

<?php if(
!empty(
$setting->whatsapp
)
): ?>

<li class="mb-2">

<i class="bi bi-whatsapp"></i>

<?= $setting->whatsapp ?>

</li>

<?php endif; ?>

<?php if(
!empty(
$setting->email
)
): ?>

<li class="mb-2">

<i class="bi bi-envelope"></i>

<?= $setting->email ?>

</li>

<?php endif; ?>

<?php if(
!empty(
$setting->address
)
): ?>

<li>

<i class="bi bi-geo-alt"></i>

<?= $setting->address ?>

</li>

<?php endif; ?>

</ul>

<!-- SOCIAL -->
<div class="social-links mt-3">

<?php if(
!empty(
$setting->facebook
)
): ?>

<a href="<?= $setting->facebook ?>"
target="_blank">

<i class="bi bi-facebook"></i>

</a>

<?php endif; ?>

<?php if(
!empty(
$setting->instagram
)
): ?>

<a href="<?= $setting->instagram ?>"
target="_blank">

<i class="bi bi-instagram"></i>

</a>

<?php endif; ?>

<?php if(
!empty(
$setting->youtube
)
): ?>

<a href="<?= $setting->youtube ?>"
target="_blank">

<i class="bi bi-youtube"></i>

</a>

<?php endif; ?>

<?php if(
!empty(
$setting->twitter
)
): ?>

<a href="<?= $setting->twitter ?>"
target="_blank">

<i class="bi bi-twitter-x"></i>

</a>

<?php endif; ?>

<?php if(
!empty(
$setting->linkedin
)
): ?>

<a href="<?= $setting->linkedin ?>"
target="_blank">

<i class="bi bi-linkedin"></i>

</a>

<?php endif; ?>

</div>

</div>

</div>
<?php if(
!empty(
$setting->maps_embed
)
): ?>

<div class="mt-4">

<iframe
src="<?= trim(
$setting->maps_embed
) ?>"
width="100%"
height="220"
style="
border:0;
border-radius:16px;
overflow:hidden;
"
allowfullscreen=""
loading="lazy"
referrerpolicy="no-referrer-when-downgrade">
</iframe>

</div>

<?php endif; ?>
<hr class="my-4">

<div class="text-center footer-copy">

<?= !empty(
$setting->copyright
)
? $setting->copyright
: '© '.date('Y').' Nazmu Blog' ?>

</div>

</div>

</footer>

<!-- FOOTER SCRIPT -->
<?php if(
!empty(
$setting->footer_script
)
): ?>

<?= $setting->footer_script ?>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(
'assets/public/js/scripts.js'
) ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>