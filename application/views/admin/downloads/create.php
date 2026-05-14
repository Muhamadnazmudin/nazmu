<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>
                        Tambah File Download
                    </h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('admin/downloads') ?>"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <?php if($this->session->flashdata('error')): ?>

                <div class="alert alert-danger">

                    <?= $this->session->flashdata('error'); ?>

                </div>

            <?php endif; ?>

            <form action="<?= base_url('admin/downloads/store') ?>"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="row">

                    <!-- LEFT -->
                    <div class="col-md-8">

                        <div class="card card-primary shadow-sm">

                            <div class="card-header">
                                <h3 class="card-title">
                                    Informasi File
                                </h3>
                            </div>

                            <div class="card-body">

                                <!-- TITLE -->
                                <div class="form-group">

                                    <label>
                                        Judul File
                                    </label>

                                    <input type="text"
                                           name="title"
                                           class="form-control"
                                           required>

                                </div>

                                <!-- CATEGORY -->
                                <div class="form-group">

                                    <label>
                                        Kategori
                                    </label>

                                    <select name="category_id"
                                            class="form-control">

                                        <option value="">
                                            -- Pilih Kategori --
                                        </option>

                                        <?php foreach($categories as $cat): ?>

                                            <option value="<?= $cat->id ?>">

                                                <?= $cat->name ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <!-- SOURCE -->
                                <div class="form-group">

                                    <label>
                                        Sumber File
                                    </label>

                                    <select
                                        name="file_source"
                                        id="file_source"
                                        class="form-control"
                                        required>

                                        <option value="server">
                                            Upload ke Server
                                        </option>

                                        <option value="external">
                                            Google Drive / External Link
                                        </option>

                                    </select>

                                </div>

                                <!-- SERVER -->
                                <div id="serverUpload">

                                    <div class="form-group">

                                        <label>
                                            Upload File
                                        </label>

                                        <div class="custom-file">

                                            <input type="file"
                                                   name="file"
                                                   class="custom-file-input"
                                                   id="fileInput">

                                            <label class="custom-file-label">

                                                Pilih file

                                            </label>

                                        </div>

                                        <small class="text-muted">

                                            Allowed:
                                            PDF, DOC, XLS,
                                            PPT, ZIP, JPG,
                                            PNG, WEBP,
                                            MP4, MP3

                                        </small>

                                    </div>

                                </div>

                                <!-- EXTERNAL -->
                                <div id="externalUpload"
                                     style="display:none;">

                                    <div class="form-group">

                                        <label>
                                            External URL
                                        </label>

                                        <input type="url"
                                               name="external_url"
                                               class="form-control"
                                               placeholder="https://drive.google.com/...">

                                        <small class="text-muted">

                                            Tempel link Google Drive,
                                            Dropbox, OneDrive,
                                            CDN, dll.

                                        </small>

                                    </div>

                                </div>

                                <!-- DESCRIPTION -->
                                <div class="form-group">

                                    <label>
                                        Deskripsi
                                    </label>

                                    <textarea
                                        name="description"
                                        rows="5"
                                        class="form-control"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- RIGHT -->
                    <div class="col-md-4">

                        <!-- STATUS -->
                        <div class="card card-outline card-primary">

                            <div class="card-header">
                                <h3 class="card-title">
                                    Publish
                                </h3>
                            </div>

                            <div class="card-body">

                                <div class="form-group">

                                    <label>
                                        Status
                                    </label>

                                    <select name="status"
                                            class="form-control">

                                        <option value="publish">
                                            Publish
                                        </option>

                                        <option value="draft">
                                            Draft
                                        </option>

                                    </select>

                                </div>

                                <button type="submit"
                                        class="btn btn-primary btn-block">

                                    <i class="fas fa-save"></i>
                                    Simpan File

                                </button>

                            </div>

                        </div>

                        <!-- HELP -->
                        <div class="card">

                            <div class="card-header">

                                <strong>
                                    Tips
                                </strong>

                            </div>

                            <div class="card-body small text-muted">

                                <ul class="pl-3 mb-0">

                                    <li>
                                        Gunakan upload server
                                        untuk file kecil
                                    </li>

                                    <li>
                                        Gunakan Google Drive
                                        untuk video besar
                                    </li>

                                    <li>
                                        File MP4 besar lebih baik
                                        external link
                                    </li>

                                    <li>
                                        Draft tidak tampil
                                        di public
                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>

</div>


<script>
$(function(){

    $('#file_source').change(function(){

        let val = $(this).val();

        if(val === 'server'){

            $('#serverUpload').show();
            $('#externalUpload').hide();

        }else{

            $('#serverUpload').hide();
            $('#externalUpload').show();

        }

    });


    $('.custom-file-input').on(
        'change',
        function(){

            let fileName =
                $(this).val()
                .split('\\')
                .pop();

            $(this)
            .next('.custom-file-label')
            .html(fileName);

        }
    );

});
</script>
<?php $this->load->view('admin/layout/footer'); ?>