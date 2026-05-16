<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Logs
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
            'Logs_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Activity Logs';

        $data['logs'] =
        $this->Logs_model
        ->get_all();

        $this->load->view(
            'admin/logs/index',
            $data
        );
    }

    public function reset()
{
    $this->db
    ->truncate(
        'activity_logs'
    );

    $this->session
    ->set_flashdata(
        'success',
        'Semua activity logs berhasil dihapus.'
    );

    redirect(
        'admin/logs'
    );
}
}