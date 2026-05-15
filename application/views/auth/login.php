<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

Login -
<?= $setting->site_name ?>

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

<?php endif; ?>

<!-- FONT AWESOME -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/plugins/fontawesome-free/css/all.min.css'
) ?>">

<!-- ADMINLTE -->
<link rel="stylesheet"
href="<?= base_url(
'assets/admin/dist/css/adminlte.min.css'
) ?>">

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

body{
font-family:
'Inter',
sans-serif;
background:
linear-gradient(
135deg,
#4f46e5,
#7c3aed
);
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
padding:20px;
}

.login-box{
width:100%;
max-width:420px;
}

.login-card{
background:#fff;
border:none;
border-radius:24px;
overflow:hidden;
box-shadow:
0 25px 50px
rgba(0,0,0,.15);
}

.login-header{
padding:40px 35px 20px;
text-align:center;
}

.login-logo{
margin-bottom:15px;
}

.login-logo img{
height:70px;
width:auto;
object-fit:contain;
}

.brand-name{
font-size:28px;
font-weight:800;
color:#111827;
margin-bottom:6px;
}

.brand-tagline{
font-size:14px;
color:#6b7280;
}

.login-body{
padding:0 35px 35px;
}

.login-title{
font-size:15px;
color:#6b7280;
text-align:center;
margin-bottom:28px;
}

.form-control{
height:52px;
border-radius:14px;
font-size:15px;
border:1px solid #e5e7eb;
padding-left:16px;
}

.input-group-text{
border-radius:0 14px 14px 0;
background:#f9fafb;
border:
1px solid #e5e7eb;
}

.form-control:focus{
box-shadow:none;
border-color:#6366f1;
}

.btn-login{
height:52px;
border:none;
border-radius:14px;
font-weight:600;
font-size:16px;
background:
linear-gradient(
135deg,
#4f46e5,
#7c3aed
);
transition:.3s;
}

.btn-login:hover{
transform:
translateY(-2px);
box-shadow:
0 10px 25px
rgba(
79,70,229,.25
);
}

.footer-text{
text-align:center;
font-size:13px;
color:#9ca3af;
margin-top:22px;
}

@media(max-width:480px){

.login-header{
padding:30px 25px 15px;
}

.login-body{
padding:
0 25px 25px;
}

.brand-name{
font-size:24px;
}

}

</style>

</head>

<body>

<div class="login-box">

<div class="card login-card">

<div class="login-header">

<div class="login-logo">

<?php if(
!empty(
$setting->logo
)
): ?>

<img src="<?= base_url(
'uploads/media/' .
$setting->logo
) ?>"
alt="Logo">

<?php endif; ?>

</div>

<h1 class="brand-name">

<?= $setting->site_name ?>

</h1>

<p class="brand-tagline">

<?= $setting->tagline ?>

</p>

</div>

<div class="login-body">

<p class="login-title">

Login untuk masuk dashboard

</p>

<?php
$csrf = [
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
];
?>

<form action="<?= base_url('auth/login') ?>" method="POST">

    <input type="hidden"
           name="<?= $csrf['name']; ?>"
           value="<?= $csrf['hash']; ?>">

    <div class="input-group mb-3">

        <input type="text"
               name="username"
               class="form-control"
               placeholder="Username"
               required>

        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-user"></i>
            </div>
        </div>

    </div>

    <div class="input-group mb-4">

        <input type="password"
               name="password"
               class="form-control"
               placeholder="Password"
               required>

        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-lock"></i>
            </div>
        </div>

    </div>

    <button type="submit"
            class="btn btn-primary btn-block btn-login">

        Masuk Dashboard

    </button>

</form>

<div class="footer-text">

© <?= date('Y') ?>
<?= $setting->site_name ?>

</div>

</div>

</div>

</div>

<script src="<?= base_url(
'assets/admin/plugins/jquery/jquery.min.js'
) ?>"></script>

<script src="<?= base_url(
'assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js'
) ?>"></script>

</body>
</html>