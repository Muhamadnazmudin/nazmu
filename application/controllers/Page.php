<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Page
extends MY_Controller
{
    public function view(
        $slug = null
    ){
        $page =
        $this->db
        ->where(
            'slug',
            $slug
        )
        ->where(
            'status',
            1
        )
        ->get(
            'pages'
        )
        ->row();

        if(
        !$page
        ){
            show_404();
        }

        $data['title'] =
        $page->title;

        $data['page'] =
        $page;

        $this->load->view(
        'public/page',
        $data
        );
    }
}