<?php $this->load->view(
'admin/layout/header'
); ?>

<?php $this->load->view(
'admin/layout/navbar'
); ?>

<?php $this->load->view(
'admin/layout/sidebar'
); ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>
                        Donate Settings
                    </h1>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <!-- ALERT -->
            <?php if(
                $this->session
                ->flashdata(
                    'success'
                )
            ): ?>

                <div class="alert
                            alert-success
                            alert-dismissible
                            fade show">

                    <i class="fas fa-check-circle mr-1"></i>

                    <?= $this->session
                    ->flashdata(
                        'success'
                    ) ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>
                            &times;
                        </span>

                    </button>

                </div>

            <?php endif; ?>

            <form action="<?= base_url(
                'admin/donate/update'
            ) ?>"
            method="POST"
            enctype="multipart/form-data">
            <input type="hidden"
name="<?= $this->security->get_csrf_token_name(); ?>"
value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row">

                    <!-- LEFT -->
                    <div class="col-lg-8">

                        <div class="card
                                    border-0
                                    shadow-sm
                                    rounded-lg">

                            <div class="card-header
                                        bg-white">

                                <h5 class="mb-0">

                                    Pengaturan Donate

                                </h5>

                            </div>

                            <div class="card-body">

                                <!-- STATUS -->
                                <div class="form-group">

                                    <div class="custom-control
                                                custom-switch">

                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="is_active"
                                               name="is_active"
                                               <?= $donate->is_active
                                               ? 'checked'
                                               : '' ?>>

                                        <label class="custom-control-label"
                                               for="is_active">

                                            Aktifkan Donate

                                        </label>

                                    </div>

                                </div>

                                <!-- TITLE -->
                                <div class="form-group">

                                    <label>

                                        Judul Popup

                                    </label>

                                    <input type="text"
                                           name="title"
                                           class="form-control"
                                           value="<?= html_escape(
                                               $donate->title
                                           ) ?>">

                                </div>

                                <!-- DESCRIPTION -->
                                <div class="form-group">

                                    <label>

                                        Deskripsi

                                    </label>

                                    <textarea
                                    name="description"
                                    rows="5"
                                    class="form-control"><?= html_escape(
                                        $donate->description
                                    ) ?></textarea>

                                </div>

                                <!-- SAWERIA -->
                                <div class="form-group">

                                    <label>

                                        URL Saweria

                                    </label>

                                    <input type="url"
                                           name="saweria_url"
                                           class="form-control"
                                           placeholder="https://saweria.co/username"
                                           value="<?= html_escape(
                                               $donate->saweria_url
                                           ) ?>">

                                </div>

                                <hr>

                                <h5 class="mb-3">

                                    Informasi Bank

                                </h5>

                                <!-- BANK -->
                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>

                                                Nama Bank

                                            </label>

                                            <input type="text"
                                                   name="bank_name"
                                                   class="form-control"
                                                   placeholder="Bank Jago"
                                                   value="<?= html_escape(
                                                       $donate->bank_name
                                                   ) ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>

                                                Atas Nama

                                            </label>

                                            <input type="text"
                                                   name="account_name"
                                                   class="form-control"
                                                   value="<?= html_escape(
                                                       $donate->account_name
                                                   ) ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label>

                                                No Rekening

                                            </label>

                                            <input type="text"
                                                   name="account_number"
                                                   class="form-control"
                                                   value="<?= html_escape(
                                                       $donate->account_number
                                                   ) ?>">

                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <h5 class="mb-3">

                                    Popup Settings

                                </h5>

                                <div class="row">

                                    <!-- DELAY -->
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Delay Popup (ms)

                                            </label>

                                            <input type="number"
                                                   name="popup_delay"
                                                   class="form-control"
                                                   value="<?= $donate->popup_delay ?>">

                                            <small class="text-muted">

                                                5000 = 5 detik

                                            </small>

                                        </div>

                                    </div>

                                    <!-- INTERVAL -->
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Interval Muncul (hari)

                                            </label>

                                            <input type="number"
                                                   name="popup_interval"
                                                   class="form-control"
                                                   value="<?= $donate->popup_interval ?>">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-4">

                        <!-- QRIS -->
                        <div class="card
                                    border-0
                                    shadow-sm
                                    rounded-lg">

                            <div class="card-header
                                        bg-white">

                                <h5 class="mb-0">

                                    QRIS Donate

                                </h5>

                            </div>

                            <div class="card-body
                                        text-center">

                                <?php if(
                                    !empty(
                                        $donate->qris_image
                                    )
                                ): ?>

                                    <img src="<?= base_url(
                                        'uploads/donate/' .
                                        $donate->qris_image
                                    ) ?>"
                                    class="img-fluid
                                           rounded
                                           shadow-sm
                                           mb-3"
                                    style="max-height:260px;">

                                <?php endif; ?>

                                <div class="form-group
                                            text-left">

                                    <label>

                                        Upload QRIS

                                    </label>

                                    <input type="file"
                                           name="qris_image"
                                           class="form-control-file">

                                    <small class="text-muted">

                                        JPG, PNG, WEBP
                                        max 4MB

                                    </small>

                                </div>

                            </div>

                        </div>

                        <!-- SAVE -->
                        <button type="submit"
                                class="btn
                                       btn-primary
                                       btn-lg
                                       btn-block
                                       shadow-sm">

                            <i class="fas fa-save mr-1"></i>

                            Simpan Pengaturan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </section>

</div>
<?php $this->load->view(
'admin/layout/footer'
); ?>