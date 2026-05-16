<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Messages
extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            !$this->session
            ->userdata(
                'logged_in'
            )
        ) {
            redirect(
                'auth'
            );
        }

        $this->load->model(
            'Message_model'
        );

        $this->load->model(
            'Setting_model'
        );
    }

    /**
     * List semua pesan
     */
    public function index()
    {
        $data['title'] =
        'Pesan Kontak';

        $data['setting'] =
        $this->Setting_model
        ->get();

        $keyword =
        trim(
            $this->input
            ->get(
                'keyword',
                true
            )
        );

        if (
            !empty(
                $keyword
            )
        ) {

            $data['messages'] =
            $this->Message_model
            ->search(
                $keyword
            );

        } else {

            $data['messages'] =
            $this->Message_model
            ->get_all();

        }

        $data['unread_count'] =
        $this->Message_model
        ->count_unread();

        $this->load->view(
            'admin/messages/index',
            $data
        );
    }

    /**
     * Detail pesan
     */
    public function detail(
        $id = null
    )
    {
        if (
            !$id
        ) {
            redirect(
                'admin/messages'
            );
        }

        $message =
        $this->Message_model
        ->get_by_id(
            $id
        );

        if (
            !$message
        ) {

            $this->session
            ->set_flashdata(
                'error',
                'Pesan tidak ditemukan'
            );

            redirect(
                'admin/messages'
            );
        }

        // otomatis tandai dibaca
        if (
            $message
            ->is_read == 0
        ) {

            $this->Message_model
            ->mark_read(
                $id
            );
        }

        $data['title'] =
        'Detail Pesan';

        $data['setting'] =
        $this->Setting_model
        ->get();

        $data['message'] =
        $this->Message_model
        ->get_by_id(
            $id
        );

        $this->load->view(
            'admin/messages/detail',
            $data
        );
    }

    /**
     * Tandai sudah dibaca
     */
    public function mark_read(
        $id = null
    )
    {
        if (
            !$id
        ) {
            redirect(
                'admin/messages'
            );
        }

        $this->Message_model
        ->mark_read(
            $id
        );

        $this->session
        ->set_flashdata(
            'success',
            'Pesan ditandai sudah dibaca'
        );

        redirect(
            'admin/messages'
        );
    }

    /**
     * Tandai belum dibaca
     */
    public function mark_unread(
        $id = null
    )
    {
        if (
            !$id
        ) {
            redirect(
                'admin/messages'
            );
        }

        $this->Message_model
        ->mark_unread(
            $id
        );

        $this->session
        ->set_flashdata(
            'success',
            'Pesan ditandai belum dibaca'
        );

        redirect(
            'admin/messages'
        );
    }

    /**
     * Hapus pesan
     */
    public function delete(
        $id = null
    )
    {
        if (
            !$id
        ) {
            redirect(
                'admin/messages'
            );
        }

        $message =
        $this->Message_model
        ->get_by_id(
            $id
        );

        if (
            !$message
        ) {

            $this->session
            ->set_flashdata(
                'error',
                'Pesan tidak ditemukan'
            );

            redirect(
                'admin/messages'
            );
        }

        $this->Message_model
        ->delete(
            $id
        );

        $this->session
        ->set_flashdata(
            'success',
            'Pesan berhasil dihapus'
        );

        redirect(
            'admin/messages'
        );
    }

    /**
     * Bulk delete
     */
    public function bulk_delete()
    {
        $ids =
        $this->input
        ->post(
            'ids'
        );

        if (
            empty(
                $ids
            )
        ) {

            $this->session
            ->set_flashdata(
                'error',
                'Pilih minimal satu pesan'
            );

            redirect(
                'admin/messages'
            );
        }

        $this->Message_model
        ->bulk_delete(
            $ids
        );

        $this->session
        ->set_flashdata(
            'success',
            'Pesan terpilih berhasil dihapus'
        );

        redirect(
            'admin/messages'
        );
    }
}