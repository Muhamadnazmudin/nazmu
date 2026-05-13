<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Comments
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
            redirect('login');
        }

        $this->load->model(
            'Comment_model'
        );
    }

    public function index()
    {
        $data['comments'] =
        $this->Comment_model
        ->get_all();

        $this->load->view(
            'admin/comments/index',
            $data
        );
    }

    public function approve($id)
    {
        $this->Comment_model
        ->update_status(
            $id,
            'approved'
        );

        redirect(
            'admin/comments'
        );
    }

    public function pending($id)
    {
        $this->Comment_model
        ->update_status(
            $id,
            'pending'
        );

        redirect(
            'admin/comments'
        );
    }

    public function spam($id)
    {
        $this->Comment_model
        ->update_status(
            $id,
            'spam'
        );

        redirect(
            'admin/comments'
        );
    }

    public function delete($id)
    {
        $this->Comment_model
        ->delete($id);

        redirect(
            'admin/comments'
        );
    }
}