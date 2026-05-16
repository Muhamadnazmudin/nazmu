<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>

                Activity Logs

            </h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">
            <div class="row mb-3">

    <div class="col-md-12 text-right">

        <a href="<?= base_url(
            'admin/logs/reset'
        ) ?>"
        class="btn btn-danger"
        onclick="return confirm(
        'Yakin ingin menghapus semua activity logs?'
        )">

            <i class="fas fa-trash-alt mr-1"></i>

            Reset Logs

        </a>

    </div>

</div>
           
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
<div class="card">

                <div class="card-body table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>
                                    User
                                </th>

                                <th>
                                    Module
                                </th>

                                <th>
                                    Aktivitas
                                </th>

                                <th>
                                    IP
                                </th>

                                <th>
                                    Tanggal
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach(
                                $logs
                                as $row
                            ): ?>

                            <tr>

                                <td>

                                    <?= $row->user_name ?>

                                </td>

                                <td>

                                    <?= $row->module ?>

                                </td>

                                <td>

                                    <?= $row->activity ?>

                                </td>

                                <td>

                                    <?= $row->ip_address ?>

                                </td>

                                <td>

                                    <?= date(
                                        'd M Y H:i',
                                        strtotime(
                                            $row->created_at
                                        )
                                    ) ?>

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

<?php $this->load->view('admin/layout/footer'); ?>