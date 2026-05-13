<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Comment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Comment_model'
        );
    }

    public function store()
    {
        $post_id =
        $this->input
        ->post(
            'post_id'
        );

        $data = [

        'post_id' =>
        $post_id,

        'name' =>
        htmlspecialchars(
            $this->input
            ->post('name')
        ),

        'email' =>
        htmlspecialchars(
            $this->input
            ->post('email')
        ),

        'content' =>
        htmlspecialchars(
            $this->input
            ->post('content')
        ),

        'status' =>
        'pending'

        ];

        $this->Comment_model
        ->create($data);

        $this->session
        ->set_flashdata(
            'success',
            'Komentar berhasil dikirim & menunggu moderasi'
        );

        redirect(
            $_SERVER['HTTP_REFERER']
        );
    }
}