<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('cookie');
    }

    public function change($theme = 'default')
    {
        $allowed = [
            'default',
            'modern',
            'school',
            'dark'
        ];

        if(!in_array($theme, $allowed)){
            $theme = 'default';
        }

        set_cookie(
            'public_theme',
            $theme,
            60 * 60 * 24 * 30
        );

        redirect(
            $_SERVER['HTTP_REFERER']
            ?? base_url()
        );
    }

    public function reset()
    {
        delete_cookie(
            'public_theme'
        );

        redirect(
            $_SERVER['HTTP_REFERER']
            ?? base_url()
        );
    }
}