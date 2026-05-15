<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Sitemap
extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
        'Post_model'
        );

        $this->load->model(
        'Category_model'
        );
    }

    public function index()
{
    $this->output
    ->set_content_type(
    'application/xml'
    );

    $data['posts'] =
    $this->db
    ->where(
    'status',
    'publish'
    )
    ->order_by(
    'published_at',
    'DESC'
    )
    ->get(
    'posts'
    )
    ->result();

    $data['categories'] =
    $this->db
    ->order_by(
    'name',
    'ASC'
    )
    ->get(
    'categories'
    )
    ->result();

    $this->load->view(
    'sitemap',
    $data
    );
}
}