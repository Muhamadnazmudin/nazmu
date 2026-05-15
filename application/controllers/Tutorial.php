<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Tutorial extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Tutorial_model'
        );

        $this->load->helper(
            'text'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LIST TUTORIAL
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] =
            'Tutorial';

        $data['tutorials'] =
            $this->Tutorial_model
                ->get_published();

        $this->load->view(
            'public/tutorial/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($slug)
    {
        $tutorial =
            $this->Tutorial_model
                ->get_by_slug(
                    $slug
                );

        if(!$tutorial){

            show_404();

        }

        /*
        Increment views
        */
        $this->Tutorial_model
            ->increment_views(
                $tutorial->id
            );

        $data['title'] =
            $tutorial->title;

        $data['tutorial'] =
            $tutorial;

        $data['related'] =
            $this->Tutorial_model
                ->get_related(
                    $tutorial->id
                );

        $this->load->view(
            'public/tutorial/detail',
            $data
        );
    }
}