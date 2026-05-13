<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class MY_Controller
extends CI_Controller
{
    public $setting;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Setting_model'
        );

        $this->load->model(
            'Menu_model'
        );

        $this->setting =
        $this->Setting_model
        ->get();

        $menus =
        $this->Menu_model
        ->get_active();

        $this->load->vars([
            'setting' =>
            $this->setting,

            'menus' =>
            $menus
        ]);
    }
}