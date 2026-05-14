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

        /*
        |--------------------------------------------------------------------------
        | Load Models
        |--------------------------------------------------------------------------
        */
        $this->load->model(
            'Setting_model'
        );

        $this->load->model(
            'Menu_model'
        );

        $this->load->model(
            'Category_model'
        );


        /*
        |--------------------------------------------------------------------------
        | Website Setting
        |--------------------------------------------------------------------------
        */
        $this->setting =
        $this->Setting_model
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Dynamic Menu
        |--------------------------------------------------------------------------
        */
        $menus =
        $this->Menu_model
        ->get_active();


        /*
        |--------------------------------------------------------------------------
        | Blog Categories
        |--------------------------------------------------------------------------
        */
        $blog_categories =
        $this->Category_model
        ->get_all();


        /*
        |--------------------------------------------------------------------------
        | Global Variables
        |--------------------------------------------------------------------------
        */
        $this->load->vars([

            'setting' =>
            $this->setting,

            'menus' =>
            $menus,

            'blog_categories' =>
            $blog_categories

        ]);
    }
}