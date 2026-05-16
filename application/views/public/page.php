<?php $this->load->view(
'public/layout/header'
); ?>

<?php $this->load->view(
'public/layout/navbar'
); ?>

<!-- HERO -->
<section class="article-hero">

    <div class="container text-center">

        <span class="hero-badge">
            📄 Halaman
        </span>

        <h1 class="hero-title">

            <?= $page->title ?>

        </h1>

        <p class="hero-subtitle">

            Informasi lengkap mengenai
            <?= $page->title ?>

        </p>

    </div>

</section>

<!-- CONTENT -->
<div class="content-section">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-lg-5 p-4">

                    <div class="page-content">

                        <?= $page->content ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<style>
.page-content{
	font-size:18px;
	line-height:1.9;
	color:inherit;
}

.page-content img{
	max-width:100%;
	border-radius:18px;
	margin:20px 0;
}

.page-content h2,
.page-content h3,
.page-content h4{
	margin-top:30px;
	margin-bottom:16px;
	font-weight:700;
}

.page-content p{
	margin-bottom:18px;
}

.page-content ul,
.page-content ol{
	padding-left:20px;
	margin-bottom:20px;
}

.page-content blockquote{
	padding:20px;
	border-left:4px solid
	var(--primary,#2563eb);

	background:
	rgba(0,0,0,.03);

	border-radius:14px;
	margin:24px 0;
}
</style>

<?php $this->load->view(
'public/layout/footer'
); ?>