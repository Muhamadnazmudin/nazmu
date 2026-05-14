<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/navbar'); ?>
<?php $this->load->view('admin/layout/sidebar'); ?>
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>
                        Download Center
                    </h1>
                </div>

                <div class="col-sm-6 text-right">

                    <a href="<?= base_url('admin/downloads/create') ?>"
                       class="btn btn-primary">

                        <i class="fas fa-plus"></i>
                        Tambah File

                    </a>

                </div>

            </div>

        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <?php if($this->session->flashdata('success')): ?>

                <div class="alert alert-success">

                    <?= $this->session->flashdata('success'); ?>

                </div>

            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>

                <div class="alert alert-danger">

                    <?= $this->session->flashdata('error'); ?>

                </div>

            <?php endif; ?>

            <div class="card shadow-sm">

                <div class="card-body table-responsive">

                    <table
                        id="downloadTable"
                        class="table table-bordered table-hover">

                        <thead>

                        <tr>

                            <th width="50">
                                #
                            </th>

                            <th width="90">
                                File
                            </th>

                            <th>
                                Judul
                            </th>

                            <th>
                                Kategori
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Size
                            </th>

                            <th>
                                Download
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="160">
                                Action
                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php
                        $no = 1;
                        foreach($downloads as $row):
                        ?>

                            <tr>

                                <td>
                                    <?= $no++; ?>
                                </td>

                                <td>

                                    <?php

$ext = '-';

if(
    !empty($row->file_type)
){

    $ext =
        strtolower(
            str_replace(
                '.',
                '',
                $row->file_type
            )
        );

}elseif(
    $row->file_source
    == 'external'
){

    // Google Drive
    if(
        strpos(
            $row->file_path,
            'drive.google.com'
        ) !== false
    ){

        $ext = 'gdrive';

    }

    // Dropbox
    elseif(
        strpos(
            $row->file_path,
            'dropbox'
        ) !== false
    ){

        $ext = 'dropbox';

    }

    // OneDrive
    elseif(
        strpos(
            $row->file_path,
            'onedrive'
        ) !== false
    ){

        $ext = 'onedrive';

    }

    else{

        $ext = 'link';

    }

}
?>

                                    <?php if(in_array($ext,['jpg','jpeg','png','webp'])): ?>

                                        <img src="<?= base_url($row->file_path) ?>"
                                             style="
                                                width:60px;
                                                height:60px;
                                                object-fit:cover;
                                                border-radius:8px;
                                             ">

                                    <?php else: ?>

                                        <div class="text-center">

                                            <?php if($ext == 'gdrive'): ?>

<i class="fab fa-google-drive
fa-2x text-success"></i>

<?php elseif($ext == 'pdf'): ?>

<i class="fas fa-file-pdf
fa-2x text-danger"></i>

<?php elseif(in_array(
$ext,
['doc','docx']
)): ?>

<i class="fas fa-file-word
fa-2x text-primary"></i>

<?php elseif(in_array(
$ext,
['xls','xlsx']
)): ?>

<i class="fas fa-file-excel
fa-2x text-success"></i>

<?php elseif(in_array(
$ext,
['ppt','pptx']
)): ?>

<i class="fas fa-file-powerpoint
fa-2x text-warning"></i>

<?php elseif(
$ext == 'zip'
): ?>

<i class="fas fa-file-archive
fa-2x text-secondary"></i>

<?php else: ?>

<i class="fas fa-file
fa-2x text-primary"></i>

<?php endif; ?>

                                            <div class="small text-muted">
                                                <?= strtoupper($ext); ?>
                                            </div>

                                        </div>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <strong>
                                        <?= $row->title; ?>
                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= $row->slug; ?>

                                    </small>

                                </td>

                                <td>

                                    <?= !empty($row->category_name)
                                        ? $row->category_name
                                        : '-'; ?>

                                </td>

                                <td>

                                    <?php if($ext == 'gdrive'): ?>

    <span class="badge badge-success">

        <i class="fab fa-google-drive"></i>
        GDRIVE

    </span>

<?php elseif($ext == 'dropbox'): ?>

    <span class="badge badge-primary">

        DROPBOX

    </span>

<?php elseif($ext == 'onedrive'): ?>

    <span class="badge badge-info">

        ONEDRIVE

    </span>

<?php elseif($ext == 'link'): ?>

    <span class="badge badge-secondary">

        LINK

    </span>

<?php else: ?>

    <span class="badge badge-info">

        <?= strtoupper($ext); ?>

    </span>

<?php endif; ?>
                                </td>

                                <td>

                                    <?= $row->file_size ?: '-'; ?>

                                </td>

                                <td>

                                    <span class="badge badge-success">

                                        <?= $row->total_download; ?>

                                    </span>

                                </td>

                                <td>

                                    <?php if($row->status == 'publish'): ?>

                                        <span class="badge badge-primary">
                                            Publish
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-warning">
                                            Draft
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a href="<?= base_url('admin/downloads/edit/'.$row->id) ?>"
                                       class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <a href="<?= base_url('admin/downloads/delete/'.$row->id) ?>"
                                       class="btn btn-danger btn-sm btn-delete">

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

    $('#downloadTable').DataTable();

    $('.btn-delete').click(function(e){

        e.preventDefault();

        let url = $(this).attr('href');

        Swal.fire({
            title: 'Hapus file?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya Hapus',
            cancelButtonText: 'Batal'
        }).then((result)=>{

            if(result.isConfirmed){

                window.location.href = url;

            }

        });

    });

});
</script>

<?php $this->load->view('admin/layout/footer'); ?>