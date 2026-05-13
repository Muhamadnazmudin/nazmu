<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Menu
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
        'Menu_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Menu Builder';

        $data['menus'] =
        $this->Menu_model
        ->get_all();

        $this->load->view(
        'admin/menu/index',
        $data
        );
    }

    public function store()
{
    $title =
    $this->input
    ->post(
        'title'
    );

    $url =
    trim(
        $this->input
        ->post(
            'url'
        )
    );

    /* AUTO URL */
    if(
    empty(
    $url
    )){
        $url =
        url_title(
            $title,
            '-',
            true
        );
    }

    $data = [

    'title' =>
    $title,

    'url' =>
    $url,

    'sort_order' =>
    $this->input
    ->post(
        'sort_order'
    ),

    'status' =>
    $this->input
    ->post(
        'status'
    )
    ? 1 : 0
    ];

    $this->Menu_model
    ->insert(
        $data
    );

    /* AUTO CREATE PAGE */
    $page =
    $this->db
    ->where(
        'slug',
        $url
    )
    ->get(
        'pages'
    )
    ->row();

    if(
    !$page
    ){
        $this->db
        ->insert(
        'pages',
        [
        'title' =>
        $title,

        'slug' =>
        $url,

        'content' =>
        '<p>Isi halaman '
        .$title.
        '</p>',

        'status' =>
        1
        ]
        );
    }

    $this->session
    ->set_flashdata(
    'success',
    'Menu berhasil ditambahkan'
    );

    redirect(
    'admin/menu'
    );
}
public function delete($id)
{
    $this->db
    ->where(
        'id',
        $id
    )
    ->delete(
        'menus'
    );

    $this->session
    ->set_flashdata(
        'success',
        'Menu berhasil dihapus'
    );

    redirect(
        'admin/menu'
    );
}
}