<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Settings
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
            redirect('login');
        }

        $this->load->model(
            'Setting_model'
        );

        $this->load->model(
            'Media_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Pengaturan Website';

        $data['setting'] =
        $this->Setting_model
        ->get();

        $data['media'] =
        $this->Media_model
        ->get_all();

        $this->load->view(
            'admin/settings/index',
            $data
        );
    }

    public function update()
    {
        $data = [

        'site_name' =>
        $this->input
        ->post(
            'site_name'
        ),

        'tagline' =>
        $this->input
        ->post(
            'tagline'
        ),

        'site_description' =>
        $this->input
        ->post(
            'site_description'
        ),

        'logo' =>
        $this->input
        ->post(
            'logo'
        ),

        'favicon' =>
        $this->input
        ->post(
            'favicon'
        ),

        'og_image' =>
        $this->input
        ->post(
            'og_image'
        ),
    
        'email' =>
        $this->input
        ->post(
            'email'
        ),

        'whatsapp' =>
        $this->input
        ->post(
            'whatsapp'
        ),

        'address' =>
        $this->input
        ->post(
            'address'
        ),
        'maps_embed' =>
$this->input
->post(
    'maps_embed'
),

        'meta_title' =>
        $this->input
        ->post(
            'meta_title'
        ),

        'meta_description' =>
        $this->input
        ->post(
            'meta_description'
        ),

        'meta_keywords' =>
        $this->input
        ->post(
            'meta_keywords'
        ),

        'facebook' =>
        $this->input
        ->post(
            'facebook'
        ),

        'instagram' =>
        $this->input
        ->post(
            'instagram'
        ),

        'youtube' =>
        $this->input
        ->post(
            'youtube'
        ),

        'tiktok' =>
        $this->input
        ->post(
            'tiktok'
        ),

        'twitter' =>
        $this->input
        ->post(
            'twitter'
        ),

        'linkedin' =>
        $this->input
        ->post(
            'linkedin'
        ),

        'footer_text' =>
        $this->input
        ->post(
            'footer_text'
        ),

        'copyright' =>
        $this->input
        ->post(
            'copyright'
        ),

        'google_analytics' =>
        $this->input
        ->post(
            'google_analytics'
        ),

        'facebook_pixel' =>
        $this->input
        ->post(
            'facebook_pixel'
        ),

        'header_script' =>
        $this->input
        ->post(
            'header_script'
        ),

        'footer_script' =>
        $this->input
        ->post(
            'footer_script'
        ),
        'active_theme' =>
$this->input
->post(
'active_theme'
)

        ];

        $this->Setting_model
        ->update($data);

        $this->session
        ->set_flashdata(
            'success',
            'Pengaturan berhasil diperbarui'
        );

        redirect(
            'admin/settings'
        );
    }
}