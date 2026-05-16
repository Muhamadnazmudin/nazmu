<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>
                        Backup Database
                    </h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <?php if(
                $this->session
                ->flashdata(
                    'success'
                )
            ): ?>

            <div class="alert alert-success alert-dismissible fade show">

                <button type="button"
                        class="close"
                        data-dismiss="alert">

                    &times;

                </button>

                <?= $this->session
                ->flashdata(
                    'success'
                ) ?>

            </div>

            <?php endif; ?>

            <?php if(
                $this->session
                ->flashdata(
                    'error'
                )
            ): ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <button type="button"
                        class="close"
                        data-dismiss="alert">

                    &times;

                </button>

                <?= $this->session
                ->flashdata(
                    'error'
                ) ?>

            </div>

            <?php endif; ?>

            <div class="row">

                <!-- BACKUP -->
                <div class="col-md-6">

                    <div class="card card-primary card-outline">

                        <div class="card-header">

                            <h3 class="card-title">

                                Backup Database

                            </h3>

                        </div>

                        <div class="card-body text-center">

                            <i class="fas fa-database fa-4x text-primary mb-3"></i>

                            <p class="text-muted">

                                Buat backup database
                                terbaru website.

                            </p>

                            <a href="<?= base_url(
                                'admin/backup/create'
                            ) ?>"
                               class="btn btn-primary btn-lg">

                                <i class="fas fa-download mr-1"></i>

                                Backup Sekarang

                            </a>

                        </div>

                    </div>

                </div>

                <!-- RESTORE -->
                <div class="col-md-6">

                    <div class="card card-danger card-outline">

                        <div class="card-header">

                            <h3 class="card-title">

                                Restore Database

                            </h3>

                        </div>

                        <div class="card-body">

                            <div class="alert alert-warning">

                                <i class="fas fa-exclamation-triangle"></i>

                                Restore akan menimpa
                                database saat ini.

                            </div>

                            <form action="<?= base_url(
                                'admin/backup/restore'
                            ) ?>"
                            method="POST"
                            enctype="multipart/form-data">

                                <div class="form-group">

                                    <label>

                                        Upload File SQL

                                    </label>

                                    <div class="custom-file">

                                        <input type="file"
                                               name="file"
                                               class="custom-file-input"
                                               accept=".sql"
                                               required>

                                        <label class="custom-file-label">

                                            Pilih file backup...

                                        </label>

                                    </div>

                                </div>

                                <button type="submit"
                                        class="btn btn-danger btn-block"
                                        onclick="return confirm(
                                        'Yakin ingin restore database? Semua data saat ini akan ditimpa!'
                                        )">

                                    <i class="fas fa-upload mr-1"></i>

                                    Restore Database

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <!-- HISTORY -->
            <div class="card shadow-sm">

                <div class="card-header">

                    <h3 class="card-title">

                        Riwayat Backup

                    </h3>

                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">

                        <thead>

                            <tr>

                                <th width="5%">
                                    #
                                </th>

                                <th>
                                    Nama File
                                </th>

                                <th>
                                    Ukuran
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th width="20%">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if(
                                empty(
                                    $backups
                                )
                            ): ?>

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted">

                                    Belum ada backup database.

                                </td>

                            </tr>

                            <?php endif; ?>

                            <?php
                            $no = 1;

                            foreach(
                                $backups
                                as $row
                            ):
                            ?>

                            <tr>

                                <td>

                                    <?= $no++ ?>

                                </td>

                                <td>

                                    <i class="fas fa-file-alt text-success mr-1"></i>

                                    <?= $row->file_name ?>

                                </td>

                                <td>

                                    <?= $row->file_size ?>

                                </td>

                                <td>

                                    <?= date(
                                        'd M Y H:i',
                                        strtotime(
                                            $row->created_at
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <a href="<?= base_url(
                                        'admin/backup/download/' .
                                        $row->file_name
                                    ) ?>"
                                    class="btn btn-success btn-sm">

                                        <i class="fas fa-download"></i>

                                    </a>

                                    <a href="<?= base_url(
                                        'admin/backup/delete/' .
                                        $row->id
                                    ) ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm(
                                    'Hapus backup ini?'
                                    )">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </td>

                            </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<script>

$(function(){

    bsCustomFileInput.init();

});

</script>


<?php $this->load->view('admin/layout/footer'); ?>