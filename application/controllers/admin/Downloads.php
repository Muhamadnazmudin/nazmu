<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Download_model');
        $this->load->model('Download_category_model');

        $this->load->helper([
            'url',
            'form',
            'download'
        ]);
    }

    public function index()
    {
        $data['title'] = 'Download Center';

        $data['downloads'] =
            $this->Download_model->get_all();

        $this->load->view(
            'admin/downloads/index',
            $data
        );
    }

    public function create()
    {
        $data['title'] =
            'Tambah File Download';

        $data['categories'] =
            $this->Download_category_model
                ->get_all();

        $this->load->view(
            'admin/downloads/create',
            $data
        );
    }

    public function store()
    {
        $title =
            $this->input->post(
                'title',
                true
            );

        $slug = url_title(
            $title,
            '-',
            true
        );

        $file_source =
            $this->input->post(
                'file_source'
            );

        $file_path = null;
        $file_type = null;
        $file_size = null;

        /*
        |----------------------------------
        | Upload File Server
        |----------------------------------
        */
        if (
            $file_source == 'server'
            &&
            !empty($_FILES['file']['name'])
        ) {

            if (
                !is_dir(
                    './uploads/downloads/'
                )
            ) {

                mkdir(
                    './uploads/downloads/',
                    0777,
                    true
                );
            }

            $config['upload_path'] =
                './uploads/downloads/';

            $config['allowed_types'] =
                'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar|jpg|jpeg|png|webp|mp4|mp3';

            $config['encrypt_name'] =
                true;

            $config['max_size'] =
                102400;

            $this->load->library(
                'upload',
                $config
            );

            if (
                !$this->upload
                    ->do_upload('file')
            ) {

                $this->session
                    ->set_flashdata(
                        'error',
                        $this->upload
                            ->display_errors()
                    );

                redirect(
                    'admin/downloads/create'
                );
            }

            $upload =
                $this->upload->data();

            $file_path =
                'uploads/downloads/' .
                $upload['file_name'];

            $file_type =
                str_replace(
                    '.',
                    '',
                    $upload['file_ext']
                );

            $file_size =
                round(
                    (
                        $upload['file_size']
                        / 1024
                    ),
                    2
                ) . ' MB';
        }

        $data = [

            'title' =>
                $title,

            'slug' =>
                $slug,

            'description' =>
                $this->input->post(
                    'description'
                ),

            'category_id' =>
                $this->input->post(
                    'category_id'
                ),

            'file_source' =>
                $file_source,

            'file_path' =>
                $file_path,

            'external_url' =>
                $this->input->post(
                    'external_url'
                ),

            'file_type' =>
                $file_type,

            'file_size' =>
                $file_size,

            'total_download' =>
                0,

            'status' =>
                $this->input->post(
                    'status'
                ),

            'created_at' =>
                date(
                    'Y-m-d H:i:s'
                )
        ];

        $this->Download_model
            ->insert($data);

        $this->session
            ->set_flashdata(
                'success',
                'File berhasil ditambahkan'
            );

        redirect(
            'admin/downloads'
        );
    }

    public function edit($id)
    {
        $download =
            $this->Download_model
                ->get_by_id($id);

        if (!$download) {
            show_404();
        }

        $data['title'] =
            'Edit File Download';

        $data['download'] =
            $download;

        $data['categories'] =
            $this->Download_category_model
                ->get_all();

        $this->load->view(
            'admin/downloads/edit',
            $data
        );
    }

    public function update($id)
    {
        $download =
            $this->Download_model
                ->get_by_id($id);

        if (!$download) {
            show_404();
        }

        $title =
            $this->input->post(
                'title',
                true
            );

        $data = [

            'title' =>
                $title,

            'slug' =>
                url_title(
                    $title,
                    '-',
                    true
                ),

            'description' =>
                $this->input->post(
                    'description'
                ),

            'category_id' =>
                $this->input->post(
                    'category_id'
                ),

            'file_source' =>
                $this->input->post(
                    'file_source'
                ),

            'external_url' =>
                $this->input->post(
                    'external_url'
                ),

            'status' =>
                $this->input->post(
                    'status'
                ),

            'updated_at' =>
                date(
                    'Y-m-d H:i:s'
                )
        ];

        /*
        |----------------------------------
        | Replace File Upload
        |----------------------------------
        */
        if (
            !empty(
                $_FILES['file']['name']
            )
        ) {

            $config['upload_path'] =
                './uploads/downloads/';

            $config['allowed_types'] =
                'pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar|jpg|jpeg|png|webp|mp4|mp3';

            $config['encrypt_name'] =
                true;

            $config['max_size'] =
                102400;

            $this->load->library(
                'upload',
                $config
            );

            if (
                $this->upload
                    ->do_upload('file')
            ) {

                $upload =
                    $this->upload
                        ->data();

                /*
                | Delete old file
                */
                if (
                    !empty(
                        $download->file_path
                    )
                    &&
                    file_exists(
                        FCPATH .
                        $download->file_path
                    )
                ) {

                    unlink(
                        FCPATH .
                        $download->file_path
                    );
                }

                $data['file_path'] =
                    'uploads/downloads/' .
                    $upload['file_name'];

                $data['file_type'] =
                    str_replace(
                        '.',
                        '',
                        $upload['file_ext']
                    );

                $data['file_size'] =
                    round(
                        (
                            $upload['file_size']
                            / 1024
                        ),
                        2
                    ) . ' MB';
            }
        }

        $this->Download_model
            ->update(
                $id,
                $data
            );

        $this->session
            ->set_flashdata(
                'success',
                'File berhasil diupdate'
            );

        redirect(
            'admin/downloads'
        );
    }

    public function delete($id)
    {
        $download =
            $this->Download_model
                ->get_by_id($id);

        if (!$download) {
            show_404();
        }

        /*
        | Delete physical file
        */
        if (
            !empty(
                $download->file_path
            )
            &&
            file_exists(
                FCPATH .
                $download->file_path
            )
        ) {

            unlink(
                FCPATH .
                $download->file_path
            );
        }

        $this->Download_model
            ->delete($id);

        $this->session
            ->set_flashdata(
                'success',
                'File berhasil dihapus'
            );

        redirect(
            'admin/downloads'
        );
    }
}