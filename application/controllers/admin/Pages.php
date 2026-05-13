<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Pages
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
            'Page_model'
        );
    }

    /* ======================
       LIST PAGE
    ====================== */
    public function index()
    {
        $data['title'] =
        'Pages';

        $data['pages'] =
        $this->Page_model
        ->get_all();

        $this->load->view(
            'admin/pages/index',
            $data
        );
    }

    /* ======================
       CREATE PAGE
    ====================== */
    public function create()
    {
        $data['title'] =
        'Tambah Halaman';

        $this->load->view(
            'admin/pages/create',
            $data
        );
    }

    /* ======================
       STORE PAGE
    ====================== */
    public function store()
    {
        $title =
        trim(
            $this->input
            ->post(
                'title'
            )
        );

        $slug =
        trim(
            $this->input
            ->post(
                'slug'
            )
        );

        /* AUTO SLUG */
        if(
        empty(
            $slug
        )
        ){
            $slug =
            url_title(
                $title,
                '-',
                true
            );
        }

        $data = [

        'title' =>
        $title,

        'slug' =>
        $slug,

        'content' =>
        $this->input
        ->post(
            'content'
        ),

        'status' =>
        $this->input
        ->post(
            'status'
        )
        ? 1 : 0
        ];

        $this->Page_model
        ->insert(
            $data
        );

        /* AUTO MENU */
        if(
        $this->input
        ->post(
            'show_menu'
        )
        ){
            $this->db
            ->insert(
            'menus',
            [
            'title' =>
            $title,

            'url' =>
            $slug,

            'sort_order' =>
            999,

            'status' =>
            1
            ]
            );
        }

        $this->session
        ->set_flashdata(
            'success',
            'Halaman berhasil dibuat'
        );

        redirect(
            'admin/pages'
        );
    }

    /* ======================
       EDIT PAGE
    ====================== */
    public function edit($id)
    {
        $page =
        $this->Page_model
        ->get_by_id(
            $id
        );

        if(
        !$page
        ){
            show_404();
        }

        $data['title'] =
        'Edit Halaman';

        $data['page'] =
        $page;

        $this->load->view(
            'admin/pages/edit',
            $data
        );
    }

    /* ======================
       UPDATE PAGE
    ====================== */
    public function update($id)
    {
        $page =
        $this->Page_model
        ->get_by_id(
            $id
        );

        if(
        !$page
        ){
            show_404();
        }

        $title =
        trim(
            $this->input
            ->post(
                'title'
            )
        );

        $slug =
        trim(
            $this->input
            ->post(
                'slug'
            )
        );

        if(
        empty(
            $slug
        )
        ){
            $slug =
            url_title(
                $title,
                '-',
                true
            );
        }

        $data = [

        'title' =>
        $title,

        'slug' =>
        $slug,

        'content' =>
        $this->input
        ->post(
            'content'
        ),

        'status' =>
        $this->input
        ->post(
            'status'
        )
        ? 1 : 0
        ];

        $this->Page_model
        ->update(
            $id,
            $data
        );

        /* UPDATE MENU */
        $menu =
        $this->db
        ->where(
            'url',
            $page->slug
        )
        ->get(
            'menus'
        )
        ->row();

        if(
        $menu
        ){
            $this->db
            ->where(
                'id',
                $menu->id
            )
            ->update(
            'menus',
            [
            'title' =>
            $title,

            'url' =>
            $slug
            ]
            );
        }

        $this->session
        ->set_flashdata(
            'success',
            'Halaman berhasil diupdate'
        );

        redirect(
            'admin/pages'
        );
    }

    /* ======================
       DELETE PAGE
    ====================== */
    public function delete($id)
    {
        $page =
        $this->Page_model
        ->get_by_id(
            $id
        );

        if(
        !$page
        ){
            show_404();
        }

        /* DELETE MENU */
        $this->db
        ->where(
            'url',
            $page->slug
        )
        ->delete(
            'menus'
        );

        /* DELETE PAGE */
        $this->Page_model
        ->delete(
            $id
        );

        $this->session
        ->set_flashdata(
            'success',
            'Halaman berhasil dihapus'
        );

        redirect(
            'admin/pages'
        );
    }
}