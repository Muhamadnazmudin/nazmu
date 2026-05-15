<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Sliders
extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(
        !$this->session
        ->userdata(
        'logged_in'
        )
        ){
            redirect(
            'login'
            );
        }

        $this->load->model(
        'Slider_model'
        );

        $this->load->helper([
            'url',
            'form'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] =
        'Banner / Slider';

        $data['sliders'] =
        $this->Slider_model
        ->get_all();

        $this->load->view(
        'admin/sliders/index',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['title'] =
        'Tambah Slider';

        $this->load->view(
        'admin/sliders/create',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $image = null;

        /*
        |----------------------------------
        | Upload Image
        |----------------------------------
        */

        if(
        !empty(
        $_FILES['image']['name']
        )
        ){

            if(
            !is_dir(
            './uploads/sliders/'
            )
            ){
                mkdir(
                './uploads/sliders/',
                0755,
                true
                );
            }

            $config['upload_path'] =
            './uploads/sliders/';

            $config['allowed_types'] =
            'jpg|jpeg|png|webp';

            $config['encrypt_name'] =
            true;

            $config['max_size'] =
            4096;

            $this->load->library(
            'upload',
            $config
            );

            if(
            !$this->upload
            ->do_upload(
            'image'
            )
            ){

                $this->session
                ->set_flashdata(
                'error',
                $this->upload
                ->display_errors()
                );

                redirect(
                'admin/sliders/create'
                );
            }

            $upload =
            $this->upload
            ->data();

            $image =
            $upload['file_name'];
        }

        $data = [

            'title' =>
            $this->input
            ->post(
            'title',
            true
            ),

            'subtitle' =>
            $this->input
            ->post(
            'subtitle',
            true
            ),

            'description' =>
            $this->input
            ->post(
            'description'
            ),

            'button_text' =>
            $this->input
            ->post(
            'button_text',
            true
            ),

            'button_link' =>
            $this->input
            ->post(
            'button_link',
            true
            ),

            'image' =>
            $image,

            'sort_order' =>
            $this->input
            ->post(
            'sort_order'
            ),

            'status' =>
            $this->input
            ->post(
            'status'
            ),

            'created_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        $this->Slider_model
        ->insert(
        $data
        );

        $this->session
        ->set_flashdata(
        'success',
        'Slider berhasil ditambahkan'
        );

        redirect(
        'admin/sliders'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $slider =
        $this->Slider_model
        ->get_by_id(
        $id
        );

        if(!$slider){
            show_404();
        }

        $data['title'] =
        'Edit Slider';

        $data['slider'] =
        $slider;

        $this->load->view(
        'admin/sliders/edit',
        $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $slider =
        $this->Slider_model
        ->get_by_id(
        $id
        );

        if(!$slider){
            show_404();
        }

        $data = [

            'title' =>
            $this->input
            ->post(
            'title',
            true
            ),

            'subtitle' =>
            $this->input
            ->post(
            'subtitle',
            true
            ),

            'description' =>
            $this->input
            ->post(
            'description'
            ),

            'button_text' =>
            $this->input
            ->post(
            'button_text',
            true
            ),

            'button_link' =>
            $this->input
            ->post(
            'button_link',
            true
            ),

            'sort_order' =>
            $this->input
            ->post(
            'sort_order'
            ),

            'status' =>
            $this->input
            ->post(
            'status'
            ),

            'updated_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        /*
        |----------------------------------
        | Replace Image
        |----------------------------------
        */

        if(
        !empty(
        $_FILES['image']['name']
        )
        ){

            $config['upload_path'] =
            './uploads/sliders/';

            $config['allowed_types'] =
            'jpg|jpeg|png|webp';

            $config['encrypt_name'] =
            true;

            $config['max_size'] =
            4096;

            $this->load->library(
            'upload',
            $config
            );

            if(
            $this->upload
            ->do_upload(
            'image'
            )
            ){

                $upload =
                $this->upload
                ->data();

                /*
                | Delete old image
                */

                if(
                !empty(
                $slider->image
                )
                &&
                file_exists(
                './uploads/sliders/' .
                $slider->image
                )
                ){
                    unlink(
                    './uploads/sliders/' .
                    $slider->image
                    );
                }

                $data['image'] =
                $upload['file_name'];
            }
        }

        $this->Slider_model
        ->update(
        $id,
        $data
        );

        $this->session
        ->set_flashdata(
        'success',
        'Slider berhasil diupdate'
        );

        redirect(
        'admin/sliders'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $slider =
        $this->Slider_model
        ->get_by_id(
        $id
        );

        if(!$slider){
            show_404();
        }

        /*
        | Delete image
        */

        if(
        !empty(
        $slider->image
        )
        &&
        file_exists(
        './uploads/sliders/' .
        $slider->image
        )
        ){
            unlink(
            './uploads/sliders/' .
            $slider->image
            );
        }

        $this->Slider_model
        ->delete(
        $id
        );

        $this->session
        ->set_flashdata(
        'success',
        'Slider berhasil dihapus'
        );

        redirect(
        'admin/sliders'
        );
    }
}