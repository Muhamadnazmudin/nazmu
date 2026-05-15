<aside class="main-sidebar sidebar-dark-primary elevation-4">

<!-- BRAND -->
<a href="<?= base_url('admin') ?>"
class="brand-link">

<?php if(
!empty(
$setting->logo
)
): ?>

<img src="<?= base_url(
'uploads/media/' .
$setting->logo
) ?>"
alt="Logo"
class="brand-logo">

<?php endif; ?>

<div class="brand-content">

<div class="brand-title">

<?= $setting->site_name ?>

</div>

<small class="brand-subtitle">

<?= $setting->tagline ?>

</small>

</div>

</a>

<div class="sidebar">

<!-- USER PANEL -->
<div class="user-panel d-flex">

<div class="image">

<?php if(
!empty(
$this->session
->userdata(
'photo'
)
)
): ?>

<img src="<?= base_url(
'uploads/users/' .
$this->session
->userdata(
'photo'
)
) ?>"
class="img-circle elevation-2"
style="
width:45px;
height:45px;
object-fit:cover;
"
alt="User Image">

<?php else: ?>

<img src="<?= base_url(
'assets/admin/dist/img/user2-160x160.jpg'
) ?>"
class="img-circle elevation-2"
alt="User Image">

<?php endif; ?>

</div>

<div class="info">

<div class="user-name">

<?= $this->session
->userdata('nama'); ?>

</div>

<small class="text-muted">

Administrator

</small>

</div>

</div>

<!-- SIDEBAR MENU -->
<nav class="mt-3">

<ul class="nav nav-pills nav-sidebar flex-column"
    data-widget="treeview"
    role="menu"
    data-accordion="false">

    <!-- DASHBOARD -->
    <li class="nav-item">
        <a href="<?= base_url('admin') ?>"
           class="nav-link <?= uri_string() == 'admin' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <!-- BLOG -->
    <li class="nav-header">
        BLOG MANAGEMENT
    </li>

    <li class="nav-item has-treeview
        <?= strpos(uri_string(), 'admin/posts') !== false ? 'menu-open' : '' ?>">

        <a href="#"
           class="nav-link
           <?= strpos(uri_string(), 'admin/posts') !== false ? 'active' : '' ?>">

            <i class="nav-icon fas fa-newspaper"></i>

            <p>
                Artikel
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="<?= base_url('admin/posts') ?>"
                   class="nav-link <?= uri_string() == 'admin/posts' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Semua Artikel</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/posts/create') ?>"
                   class="nav-link <?= uri_string() == 'admin/posts/create' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Artikel</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/posts/draft') ?>"
                   class="nav-link <?= uri_string() == 'admin/posts/draft' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Draft Artikel</p>
                </a>
            </li>

        </ul>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/categories') ?>"
           class="nav-link <?= uri_string() == 'admin/categories' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>Kategori</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/tags') ?>"
           class="nav-link <?= uri_string() == 'admin/tags' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tags"></i>
            <p>Tags</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/comments') ?>"
           class="nav-link <?= uri_string() == 'admin/comments' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-comments"></i>
            <p>Komentar</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/media') ?>"
           class="nav-link <?= uri_string() == 'admin/media' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-photo-video"></i>
            <p>Media Library</p>
        </a>
    </li>
    <!-- DOWNLOAD CENTER -->
<li class="nav-header">
    DOWNLOAD CENTER
</li>

<li class="nav-item has-treeview
<?= strpos(uri_string(), 'admin/downloads') !== false
|| strpos(uri_string(), 'admin/download_categories') !== false
? 'menu-open'
: '' ?>">

    <a href="#"
       class="nav-link
       <?= strpos(uri_string(), 'admin/downloads') !== false
       || strpos(uri_string(), 'admin/download_categories') !== false
       ? 'active'
       : '' ?>">

        <i class="nav-icon fas fa-download"></i>

        <p>
            Download Center
            <i class="right fas fa-angle-left"></i>
        </p>

    </a>

    <ul class="nav nav-treeview">

        <!-- Semua File -->
        <li class="nav-item">

            <a href="<?= base_url('admin/downloads') ?>"
               class="nav-link
               <?= uri_string() == 'admin/downloads'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Semua File
                </p>

            </a>

        </li>

        <!-- Tambah File -->
        <li class="nav-item">

            <a href="<?= base_url('admin/downloads/create') ?>"
               class="nav-link
               <?= uri_string() == 'admin/downloads/create'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Tambah File
                </p>

            </a>

        </li>

        <!-- Kategori -->
        <li class="nav-item">

            <a href="<?= base_url('admin/download_categories') ?>"
               class="nav-link
               <?= uri_string() == 'admin/download_categories'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Kategori Download
                </p>

            </a>

        </li>

    </ul>

</li>
<!-- TUTORIAL -->
<li class="nav-header">
    TUTORIAL CENTER
</li>

<li class="nav-item has-treeview
<?= strpos(
    uri_string(),
    'admin/tutorials'
) !== false
? 'menu-open'
: '' ?>">

    <a href="#"
       class="nav-link
       <?= strpos(
            uri_string(),
            'admin/tutorials'
       ) !== false
       ? 'active'
       : '' ?>">

        <i class="nav-icon fas fa-video"></i>

        <p>

            Tutorial

            <i class="right fas fa-angle-left"></i>

        </p>

    </a>

    <ul class="nav nav-treeview">

        <!-- Semua Tutorial -->
        <li class="nav-item">

            <a href="<?= base_url(
                'admin/tutorials'
            ) ?>"
               class="nav-link
               <?= uri_string()
               == 'admin/tutorials'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                    Semua Tutorial

                </p>

            </a>

        </li>

        <!-- Tambah Tutorial -->
        <li class="nav-item">

            <a href="<?= base_url(
                'admin/tutorials/create'
            ) ?>"
               class="nav-link
               <?= uri_string()
               == 'admin/tutorials/create'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                    Tambah Tutorial

                </p>

            </a>

        </li>

    </ul>

</li>
    <!-- CONTENT -->
    <li class="nav-header">
        CONTENT MANAGEMENT
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/pages') ?>"
           class="nav-link <?= uri_string() == 'admin/pages' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Halaman</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/menu') ?>"
           class="nav-link <?= uri_string() == 'admin/menu' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-bars"></i>
            <p>Menu Navigasi</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/sliders') ?>"
           class="nav-link <?= uri_string() == 'admin/sliders' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-images"></i>
            <p>Banner / Slider</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/seo') ?>"
           class="nav-link <?= uri_string() == 'admin/seo' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-search"></i>
            <p>SEO Management</p>
        </a>
    </li>


    <!-- USER -->
    <li class="nav-header">
        USER MANAGEMENT
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/users') ?>"
           class="nav-link <?= uri_string() == 'admin/users' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Manajemen User</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/profile') ?>"
           class="nav-link <?= uri_string() == 'admin/profile' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-circle"></i>
            <p>Profile Saya</p>
        </a>
    </li>


    <!-- TOOLS -->
    <li class="nav-header">
        TOOLS
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/messages') ?>"
           class="nav-link <?= uri_string() == 'admin/messages' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Pesan Kontak</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/backup') ?>"
           class="nav-link <?= uri_string() == 'admin/backup' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-database"></i>
            <p>Backup Database</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/logs') ?>"
           class="nav-link <?= uri_string() == 'admin/logs' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-history"></i>
            <p>Activity Logs</p>
        </a>
    </li>
    <!-- SCRAP IJAZAH -->
<li class="nav-item has-treeview
<?= strpos(uri_string(), 'admin/scrapijazah') !== false
? 'menu-open'
: '' ?>">

    <a href="#"
       class="nav-link
       <?= strpos(uri_string(), 'admin/scrapijazah') !== false
       ? 'active'
       : '' ?>">

        <i class="nav-icon fas fa-file-pdf"></i>

        <p>
            Scrap e-Ijazah
            <i class="right fas fa-angle-left"></i>
        </p>

    </a>

    <ul class="nav nav-treeview">

        <!-- Dashboard -->
        <li class="nav-item">

            <a href="<?= base_url('admin/scrapijazah') ?>"
               class="nav-link
               <?= uri_string() == 'admin/scrapijazah'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Dashboard
                </p>

            </a>

        </li>

        <!-- Riwayat Sekolah -->
        <li class="nav-item">

            <a href="<?= base_url('admin/scrapijazah/schools') ?>"
               class="nav-link
               <?= uri_string() == 'admin/scrapijazah/schools'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Riwayat Sekolah
                </p>

            </a>

        </li>

        <!-- Log Upload -->
        <li class="nav-item">

            <a href="<?= base_url('admin/scrapijazah/logs') ?>"
               class="nav-link
               <?= uri_string() == 'admin/scrapijazah/logs'
               ? 'active'
               : '' ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>
                    Logs Penggunaan
                </p>

            </a>

        </li>

    </ul>

</li>

    <!-- SETTINGS -->
    <li class="nav-header">
        SETTINGS
    </li>

    <li class="nav-item">
        <a href="<?= base_url('admin/settings') ?>"
           class="nav-link <?= uri_string() == 'admin/settings' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Pengaturan Website</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?= base_url() ?>"
           target="_blank"
           class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>Lihat Website</p>
        </a>
    </li>

    <li class="nav-item mt-4">
        <a href="<?= base_url('auth/logout') ?>"
           class="nav-link bg-danger">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
    </li>

</ul>

</nav>

</div>

</aside>

<style>

.brand-link{
display:flex;
align-items:center;
padding:14px 18px;
min-height:74px;
overflow:hidden;
}

.brand-logo{
width:48px;
height:48px;
object-fit:contain;
margin-right:14px;
flex-shrink:0;
}

.brand-content{
overflow:hidden;
}

.brand-title{
font-size:18px;
font-weight:700;
color:#fff;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

.brand-subtitle{
font-size:11px;
color:#adb5bd;
display:block;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

.user-panel{
padding:16px;
border-top:
1px solid rgba(
255,255,255,.06
);
border-bottom:
1px solid rgba(
255,255,255,.06
);
}

.user-name{
font-weight:600;
color:#fff;
}

.nav-sidebar .nav-link{
border-radius:12px;
margin-bottom:4px;
}

.nav-sidebar
.nav-link.active{
box-shadow:
0 8px 20px
rgba(
0,123,255,.2
);
}

</style>