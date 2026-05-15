<?php $this->load->view('public/layout/header'); ?>
<?php $this->load->view('public/layout/navbar'); ?>

<div class="error-hero">

    <!-- floating blur -->
    <div class="blur blur-1"></div>
    <div class="blur blur-2"></div>

    <div class="container">

        <div class="row
                    justify-content-center
                    align-items-center
                    min-vh-75">

            <div class="col-lg-7">

                <div class="error-card">

                    <!-- ICON -->
                    <div class="error-icon-wrap">

                        <div class="error-icon">

                            <i class="fas fa-unlink"></i>

                        </div>

                    </div>

                    <!-- 404 -->
                    <div class="error-code">

                        404

                    </div>

                    <!-- TITLE -->
                    <h1 class="error-title">

                        Halaman Tidak Ditemukan

                    </h1>

                    <!-- DESC -->
                    <p class="error-desc">

                        Oops... halaman yang Anda cari
                        tidak tersedia, sudah dipindahkan,
                        atau URL yang dimasukkan salah.

                    </p>

                    <!-- BUTTON -->
                    <div class="error-action">

                        <a href="<?= base_url(); ?>"
                           class="btn-home">

                            <i class="fas fa-home"></i>

                            Kembali ke Beranda

                        </a>

                        <button
                            onclick="history.back()"
                            class="btn-back">

                            <i class="fas fa-arrow-left"></i>

                            Halaman Sebelumnya

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.error-hero{
position:relative;
overflow:hidden;
padding:
100px 0;
min-height:
calc(100vh - 140px);
display:flex;
align-items:center;
background:
linear-gradient(
135deg,
#f8fafc,
#eef2ff
);
}

.min-vh-75{
min-height:75vh;
}

.blur{
position:absolute;
border-radius:50%;
filter:blur(80px);
opacity:.35;
z-index:0;
}

.blur-1{
width:350px;
height:350px;
background:#7c3aed;
top:-100px;
left:-120px;
}

.blur-2{
width:300px;
height:300px;
background:#06b6d4;
bottom:-80px;
right:-80px;
}

.error-card{
position:relative;
z-index:2;
background:
rgba(255,255,255,.7);
backdrop-filter:
blur(20px);
-webkit-backdrop-filter:
blur(20px);
border:
1px solid
rgba(255,255,255,.4);
border-radius:40px;
padding:70px 50px;
text-align:center;
box-shadow:
0 25px 60px
rgba(15,23,42,.08);
}

.error-icon-wrap{
margin-bottom:25px;
}

.error-icon{
width:130px;
height:130px;
margin:auto;
border-radius:35px;
background:
linear-gradient(
135deg,
#7c3aed,
#2563eb
);
display:flex;
align-items:center;
justify-content:center;
box-shadow:
0 20px 50px
rgba(124,58,237,.3);
animation:
floatIcon
3s ease-in-out infinite;
}

.error-icon i{
font-size:54px;
color:#fff;
}

.error-code{
font-size:110px;
font-weight:800;
line-height:1;
background:
linear-gradient(
135deg,
#7c3aed,
#2563eb
);
-webkit-background-clip:text;
-webkit-text-fill-color:
transparent;
margin-bottom:15px;
}

.error-title{
font-size:42px;
font-weight:700;
color:#0f172a;
margin-bottom:18px;
}

.error-desc{
font-size:18px;
line-height:1.9;
color:#64748b;
max-width:650px;
margin:
0 auto 40px;
}

.error-action{
display:flex;
justify-content:center;
gap:14px;
flex-wrap:wrap;
}

.btn-home{
background:
linear-gradient(
135deg,
#4f46e5,
#7c3aed
);
color:#fff;
padding:
16px 30px;
border-radius:999px;
font-weight:600;
text-decoration:none;
box-shadow:
0 15px 35px
rgba(79,70,229,.25);
transition:.3s;
}

.btn-home:hover{
transform:
translateY(-3px);
color:#fff;
box-shadow:
0 20px 45px
rgba(79,70,229,.35);
}

.btn-back{
border:none;
background:#fff;
padding:
16px 30px;
border-radius:999px;
font-weight:600;
color:#334155;
box-shadow:
0 12px 30px
rgba(15,23,42,.08);
transition:.3s;
}

.btn-back:hover{
transform:
translateY(-3px);
}

@keyframes floatIcon{

0%,100%{
transform:
translateY(0);
}

50%{
transform:
translateY(-10px);
}

}

@media(max-width:768px){

.error-card{
padding:
50px 25px;
border-radius:28px;
}

.error-code{
font-size:78px;
}

.error-title{
font-size:30px;
}

.error-desc{
font-size:16px;
}

.error-icon{
width:100px;
height:100px;
}

.error-icon i{
font-size:42px;
}

}

</style>

<?php $this->load->view('public/layout/footer'); ?>