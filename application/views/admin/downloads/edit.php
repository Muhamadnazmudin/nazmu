<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Edit File Download</h1>
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

            <form action="<?= base_url('admin/downloads/update/'.$download->id) ?>"
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
                                           required
                                           value="<?= $download->title; ?>">

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

                                            <option value="<?= $cat->id ?>"
                                                <?= $download->category_id == $cat->id ? 'selected' : ''; ?>>

                                                <?= $cat->name ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>


                                <!-- FILE SOURCE -->
                                <div class="form-group">

                                    <label>
                                        Sumber File
                                    </label>

                                    <select name="file_source"
                                            id="file_source"
                                            class="form-control">

                                        <option value="server"
                                            <?= $download->file_source == 'server' ? 'selected' : ''; ?>>

                                            Upload Server

                                        </option>

                                        <option value="external"
                                            <?= $download->file_source == 'external' ? 'selected' : ''; ?>>

                                            Google Drive / External URL

                                        </option>

                                    </select>

                                </div>


                                <!-- CURRENT FILE -->
                                <div class="form-group">

                                    <label>
                                        File Saat Ini
                                    </label>

                                    <div class="border rounded p-3 bg-light">

                                        <?php
                                        $ext = strtolower(
                                            str_replace(
                                                '.',
                                                '',
                                                $download->file_type
                                            )
                                        );
                                        ?>

                                        <?php if(
                                            in_array(
                                                $ext,
                                                ['jpg','jpeg','png','webp']
                                            )
                                            &&
                                            !empty($download->file_path)
                                        ): ?>

                                            <img src="<?= base_url($download->file_path) ?>"
                                                 style="
                                                    width:150px;
                                                    border-radius:10px;
                                                    object-fit:cover;
                                                 ">

                                        <?php else: ?>

                                            <i class="fas fa-file fa-3x text-primary"></i>

                                            <div class="mt-2">

                                                <strong>
                                                    <?= strtoupper($ext); ?>
                                                </strong>

                                            </div>

                                        <?php endif; ?>

                                        <div class="small text-muted mt-2">

                                            <?= $download->file_size ?: '-'; ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- SERVER FILE -->
                                <div id="serverUpload">

                                    <div class="form-group">

                                        <label>
                                            Ganti File (Opsional)
                                        </label>

                                        <div class="custom-file">

                                            <input type="file"
                                                   name="file"
                                                   class="custom-file-input">

                                            <label class="custom-file-label">

                                                Pilih file baru

                                            </label>

                                        </div>

                                        <small class="text-muted">

                                            Kosongkan jika tidak ingin mengganti file.

                                        </small>

                                    </div>

                                </div>


                                <!-- EXTERNAL -->
                                <div id="externalUpload">

                                    <div class="form-group">

                                        <label>
                                            External URL
                                        </label>

                                        <input type="url"
                                               name="external_url"
                                               class="form-control"
                                               value="<?= $download->external_url; ?>"
                                               placeholder="https://drive.google.com/...">

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
                                        class="form-control"><?= $download->description; ?></textarea>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- RIGHT -->
                    <div class="col-md-4">

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

                                        <option value="publish"
                                            <?= $download->status == 'publish' ? 'selected' : ''; ?>>

                                            Publish

                                        </option>

                                        <option value="draft"
                                            <?= $download->status == 'draft' ? 'selected' : ''; ?>>

                                            Draft

                                        </option>

                                    </select>

                                </div>

                                <button type="submit"
                                        class="btn btn-primary btn-block">

                                    <i class="fas fa-save"></i>
                                    Update File

                                </button>

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

    function toggleSource(){

        let val =
            $('#file_source').val();

        if(val === 'server'){

            $('#serverUpload').show();
            $('#externalUpload').hide();

        }else{

            $('#serverUpload').hide();
            $('#externalUpload').show();

        }
    }

    toggleSource();

    $('#file_source').change(function(){

        toggleSource();

    });

    $('.custom-file-input').on(
        'change',
        function(){

            let fileName =
                $(this)
                .val()
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