<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Seo
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
            'auth'
            );
        }

        $this->load->model(
        'Setting_model'
        );
    }

    public function index()
{
    $data['title'] =
    'SEO Management';

    $data['setting'] =
    $this->Setting_model
    ->get();

    $this->load->view(
    'admin/seo/index',
    $data
    );
}

    public function update()
    {
        $data = [

            'google_verification' =>
            $this->input->post(
            'google_verification'
            ),

            'google_analytics' =>
            $this->input->post(
            'google_analytics'
            ),

            'google_tag_manager' =>
            $this->input->post(
            'google_tag_manager'
            ),

            'robots_index' =>
            $this->input->post(
            'robots_index'
            ),

            'header_script' =>
            $this->input->post(
            'header_script'
            ),

            'footer_script' =>
            $this->input->post(
            'footer_script'
            ),

            'updated_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        $this->db
        ->where(
        'id',
        1
        )
        ->update(
        'settings',
        $data
        );

        $this->session
        ->set_flashdata(
        'success',
        'SEO berhasil diupdate'
        );

        redirect(
        'admin/seo'
        );
    }
}