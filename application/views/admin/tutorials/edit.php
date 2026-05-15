<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between">

            <h1>

                Edit Tutorial

            </h1>

            <a href="<?= base_url(
                'admin/tutorials'
            ) ?>"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <div class="card">

            <div class="card-body">

                <form action="<?= base_url(
                    'admin/tutorials/update/' .
                    $tutorial->id
                ) ?>"
                      method="POST">

                    <input type="hidden"
                           name="<?= $this->security
                                ->get_csrf_token_name(); ?>"
                           value="<?= $this->security
                                ->get_csrf_hash(); ?>">

                    <!-- TITLE -->
                    <div class="form-group">

                        <label>

                            Judul Tutorial

                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               value="<?= html_escape(
                                    $tutorial->title
                               ); ?>"
                               required>

                    </div>

                    <!-- VIDEO URL -->
                    <div class="form-group">

                        <label>

                            URL Video

                        </label>

                        <input type="url"
                               name="video_url"
                               class="form-control"
                               value="<?= html_escape(
                                    $tutorial->video_url
                               ); ?>"
                               required>

                        <small class="text-muted">

                            Support:
                            YouTube,
                            TikTok,
                            Vimeo,
                            dll.

                        </small>

                    </div>

                    <!-- THUMBNAIL -->
                    <div class="form-group">

                        <label>

                            Thumbnail URL
                            (Opsional)

                        </label>

                        <input type="text"
                               name="thumbnail"
                               class="form-control"
                               value="<?= html_escape(
                                    $tutorial->thumbnail
                               ); ?>">

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
                                $tutorial->description
                            ); ?></textarea>

                    </div>

                    <!-- STATUS -->
                    <div class="form-group">

                        <label>

                            Status

                        </label>

                        <select name="status"
                                class="form-control">

                            <option value="published"
                                <?= $tutorial->status
                                    == 'published'
                                    ? 'selected'
                                    : ''; ?>>

                                Published

                            </option>

                            <option value="draft"
                                <?= $tutorial->status
                                    == 'draft'
                                    ? 'selected'
                                    : ''; ?>>

                                Draft

                            </option>

                        </select>

                    </div>

                    <!-- FEATURED -->
                    <div class="form-group">

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   name="is_featured"
                                   value="1"
                                   class="custom-control-input"
                                   id="featured"
                                   <?= $tutorial->is_featured
                                        ? 'checked'
                                        : ''; ?>>

                            <label class="custom-control-label"
                                   for="featured">

                                Jadikan Tutorial Unggulan

                            </label>

                        </div>

                    </div>

                    <!-- SORT ORDER -->
                    <div class="form-group">

                        <label>

                            Urutan Tampil

                        </label>

                        <input type="number"
                               name="sort_order"
                               class="form-control"
                               value="<?= (int)
                                    $tutorial->sort_order; ?>">

                    </div>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Update Tutorial

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

</div>

<?php $this->load->view('admin/layout/footer'); ?>