<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Ads
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
        'Ads Management';

        $data['setting'] =
        $this->Setting_model
        ->get();

        $this->load->view(
        'admin/ads/index',
        $data
        );
    }

    public function update()
    {
        $data = [

            'adsense_auto' =>
            $this->input->post(
            'adsense_auto'
            ),

            'ads_header' =>
            $this->input->post(
            'ads_header'
            ),

            'ads_sidebar' =>
            $this->input->post(
            'ads_sidebar'
            ),

            'ads_article' =>
            $this->input->post(
            'ads_article'
            ),

            'ads_footer' =>
            $this->input->post(
            'ads_footer'
            ),

            'ads_status' =>
            $this->input->post(
            'ads_status'
            ),

            'updated_at' =>
            date(
            'Y-m-d H:i:s'
            )
        ];

        $this->Setting_model
        ->update(
        $data
        );

        $this->session
        ->set_flashdata(
        'success',
        'Pengaturan Ads berhasil disimpan'
        );

        redirect(
        'admin/ads'
        );
    }
}