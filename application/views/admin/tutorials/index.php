<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="d-flex justify-content-between">

            <h1>

                Tutorial

            </h1>

            <a href="<?= base_url(
                'admin/tutorials/create'
            ) ?>"
               class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Tambah Tutorial

            </a>

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

            <div class="alert alert-success">

                <?= $this->session
                    ->flashdata(
                        'success'
                    ) ?>

            </div>

        <?php endif; ?>

        <div class="card">

            <div class="card-body table-responsive">

                <table id="datatable"
                       class="table
                              table-bordered
                              table-hover">

                    <thead>

                        <tr>

                            <th width="60">

                                No

                            </th>

                            <th>

                                Judul

                            </th>

                            <th width="120">

                                Platform

                            </th>

                            <th width="100">

                                Views

                            </th>

                            <th width="120">

                                Status

                            </th>

                            <th width="120">

                                Featured

                            </th>

                            <th width="220">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if(
                            !empty(
                                $tutorials
                            )
                        ): ?>

                            <?php foreach(
                                $tutorials
                                as $key
                                =>
                                $tutorial
                            ): ?>

                                <tr>

                                    <td>

                                        <?= $key + 1 ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= $tutorial->title ?>

                                        </strong>

                                        <br>

                                        <small
                                            class="text-muted">

                                            <?= $tutorial->slug ?>

                                        </small>

                                    </td>

                                    <td>

                                        <?php if(
                                            $tutorial->video_type
                                            ==
                                            'youtube'
                                        ): ?>

                                            <span class="badge bg-danger">

                                                <i class="fab fa-youtube"></i>

                                                YouTube

                                            </span>

                                        <?php elseif(
                                            $tutorial->video_type
                                            ==
                                            'tiktok'
                                        ): ?>

                                            <span class="badge bg-dark">

                                                TikTok

                                            </span>

                                        <?php elseif(
                                            $tutorial->video_type
                                            ==
                                            'vimeo'
                                        ): ?>

                                            <span class="badge bg-info">

                                                Vimeo

                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-secondary">

                                                Other

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?= (int)
                                            $tutorial->views ?>

                                    </td>

                                    <td>

                                        <?php if(
                                            $tutorial->status
                                            ==
                                            'published'
                                        ): ?>

                                            <span class="badge bg-success">

                                                Published

                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-warning">

                                                Draft

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if(
                                            $tutorial->is_featured
                                        ): ?>

                                            <span class="badge bg-primary">

                                                Ya

                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-secondary">

                                                Tidak

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <a href="<?= base_url(
                                            'admin/tutorials/edit/' .
                                            $tutorial->id
                                        ) ?>"
                                           class="btn btn-warning btn-sm">

                                            Edit

                                        </a>

                                        <a href="<?= base_url(
                                            'admin/tutorials/delete/' .
                                            $tutorial->id
                                        ) ?>"
                                           onclick="return confirm(
                                               'Hapus tutorial ini?'
                                           )"
                                           class="btn btn-danger btn-sm">

                                            Delete

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

</div>

<?php $this->load->view('admin/layout/footer'); ?>