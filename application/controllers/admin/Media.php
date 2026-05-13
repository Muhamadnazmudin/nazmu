<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Media extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session
        ->userdata('logged_in'))
        {
            redirect('login');
        }

        $this->load->model(
            'Media_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Media Library';

        $data['media'] =
        $this->Media_model
        ->get_all();

        $this->load->view(
            'admin/media/index',
            $data
        );
    }

    public function upload()
    {
        $config['upload_path'] =
        './uploads/media/';

        $config['allowed_types'] =
        'jpg|jpeg|png|webp|gif';

        $config['encrypt_name']
        = TRUE;

        $this->load->library(
            'upload',
            $config
        );

        if(
        $this->upload
        ->do_upload('media')
        )
        {
            $upload =
            $this->upload
            ->data();

            $data = [

            'file_name' =>
            $upload['file_name'],

            'file_type' =>
            $upload['file_type'],

            'file_size' =>
            $upload['file_size']

            ];

            $this->Media_model
            ->insert($data);

            $this->session
            ->set_flashdata(
            'success',
            'Media berhasil upload'
            );
        }

        redirect('admin/media');
    }

    public function delete($id)
    {
        $media =
        $this->Media_model
        ->get_by_id($id);

        if($media){

            @unlink(
            './uploads/media/' .
            $media->file_name
            );

            $this->Media_model
            ->delete($id);
        }

        redirect('admin/media');
    }
}