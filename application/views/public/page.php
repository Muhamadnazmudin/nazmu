<?php $this->load->view(
'public/layout/header'
); ?>

<?php $this->load->view(
'public/layout/navbar'
); ?>

<section class="py-5">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card border-0 shadow-sm">

<div class="card-body p-5">

<h1 class="fw-bold mb-4">

<?= $page->title ?>

</h1>

<div class="page-content">

<?= $page->content ?>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

<?php $this->load->view(
'public/layout/footer'
); ?>