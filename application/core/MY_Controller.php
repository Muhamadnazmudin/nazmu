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

        $this->setting =
        $this->Setting_model
        ->get();

        $this->load->vars([
            'setting' =>
            $this->setting
        ]);
    }
}