<?php
defined('BASEPATH')
OR exit(
'No direct script access allowed'
);

class Donate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // cek login
        if(
            !$this->session
            ->userdata('logged_in')
        ){
            redirect('auth');
        }

        $this->load->database();
        $this->load->helper([
            'url',
            'form'
        ]);
    }

    /**
     * HALAMAN DONATE
     */
    public function index()
    {
        $donate =
        $this->db
        ->get('donate')
        ->row();

        // jika belum ada row
        if(!$donate){

            $this->db->insert(
                'donate',
                [
                    'title' =>
                    'Dukung Nazmu',

                    'description' =>
                    'Kalau aplikasi ini membantu, boleh traktir kopi ☕',

                    'is_active' => 1,

                    'popup_delay' =>
                    5000,

                    'popup_interval' =>
                    7
                ]
            );

            $donate =
            $this->db
            ->get('donate')
            ->row();
        }

        $data = [
            'title' =>
            'Donate Settings',

            'donate' =>
            $donate
        ];

        $this->load->view(
            'admin/layout/header',
            $data
        );

        $this->load->view(
            'admin/layout/sidebar',
            $data
        );

        $this->load->view(
            'admin/donate/index',
            $data
        );

        $this->load->view(
            'admin/layout/footer'
        );
    }

    /**
     * UPDATE DONATE
     */
    public function update()
    {
        $donate =
        $this->db
        ->get('donate')
        ->row();

        if(!$donate){
            show_404();
        }

        $qrisImage =
        $donate->qris_image;

        /**
         * UPLOAD QRIS
         */
        if(
            !empty(
                $_FILES[
                'qris_image'
                ]['name']
            )
        ){

            $config[
                'upload_path'
            ] =
            './uploads/donate/';

            $config[
                'allowed_types'
            ] =
            'jpg|jpeg|png|webp';

            $config[
                'max_size'
            ] = 4096;

            $config[
                'encrypt_name'
            ] = true;

            // buat folder jika belum ada
            if(
                !is_dir(
                    './uploads/donate/'
                )
            ){
                mkdir(
                    './uploads/donate/',
                    0777,
                    true
                );
            }

            $this->load
            ->library(
                'upload',
                $config
            );

            if(
                $this->upload
                ->do_upload(
                    'qris_image'
                )
            ){

                $uploadData =
                $this->upload
                ->data();

                $qrisImage =
                $uploadData[
                    'file_name'
                ];

                // hapus file lama
                if(
                    !empty(
                        $donate
                        ->qris_image
                    )
                ){

                    $oldFile =
                    './uploads/donate/' .
                    $donate
                    ->qris_image;

                    if(
                        file_exists(
                            $oldFile
                        )
                    ){
                        unlink(
                            $oldFile
                        );
                    }
                }

            }
        }

        $updateData = [

            'is_active' =>
            $this->input
            ->post(
                'is_active'
            )
            ? 1
            : 0,

            'title' =>
            htmlspecialchars(
                $this->input
                ->post(
                    'title'
                )
            ),

            'description' =>
            $this->input
            ->post(
                'description'
            ),

            'saweria_url' =>
            htmlspecialchars(
                $this->input
                ->post(
                    'saweria_url'
                )
            ),

            'bank_name' =>
            htmlspecialchars(
                $this->input
                ->post(
                    'bank_name'
                )
            ),

            'account_name' =>
            htmlspecialchars(
                $this->input
                ->post(
                    'account_name'
                )
            ),

            'account_number' =>
            htmlspecialchars(
                $this->input
                ->post(
                    'account_number'
                )
            ),

            'popup_delay' =>
            (int)
            $this->input
            ->post(
                'popup_delay'
            ),

            'popup_interval' =>
            (int)
            $this->input
            ->post(
                'popup_interval'
            ),

            'qris_image' =>
            $qrisImage
        ];

        $this->db
        ->where(
            'id',
            $donate->id
        );

        $this->db
        ->update(
            'donate',
            $updateData
        );

        $this->session
        ->set_flashdata(
            'success',
            'Pengaturan donate berhasil disimpan.'
        );

        redirect(
            'admin/donate'
        );
    }
}

