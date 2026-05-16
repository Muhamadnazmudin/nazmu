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
        | Helper
        |--------------------------------------------------------------------------
        */
        $this->load->helper(
            'cookie'
        );

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
        | Theme Logic
        |--------------------------------------------------------------------------
        */

        /*
        theme default admin
        */
        $admin_theme =
            !empty(
                $this->setting
                ->public_theme
            )
            ? $this->setting
            ->public_theme
            : 'default';

        /*
        theme pilihan user
        */
        $user_theme =
            get_cookie(
                'public_theme'
            );

        /*
        whitelist theme
        */
        $allowed_themes = [

            'default',
            'modern',
            'dark',
            'school'

        ];

        /*
        priority:
        user > admin > default
        */
        if(
            !empty(
                $user_theme
            )
            &&
            in_array(
                $user_theme,
                $allowed_themes
            )
        ){

            $active_theme =
                $user_theme;

        }
        else{

            $active_theme =
                $admin_theme;

        }

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
            $blog_categories,

            'public_theme' =>
            $active_theme

        ]);
    }
}