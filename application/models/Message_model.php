<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Message_model extends CI_Model
{
    protected $table = 'messages';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua pesan
     */
    public function get_all()
    {
        return $this->db
            ->order_by(
                'created_at',
                'DESC'
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Ambil pesan by ID
     */
    public function get_by_id($id)
    {
        return $this->db
            ->where(
                'id',
                $id
            )
            ->get(
                $this->table
            )
            ->row();
    }

    /**
     * Insert pesan baru
     */
    public function insert_message($data)
    {
        return $this->db
            ->insert(
                $this->table,
                $data
            );
    }

    /**
     * Update pesan
     */
    public function update_message(
        $id,
        $data
    )
    {
        return $this->db
            ->where(
                'id',
                $id
            )
            ->update(
                $this->table,
                $data
            );
    }

    /**
     * Tandai sudah dibaca
     */
    public function mark_read($id)
    {
        return $this->db
            ->where(
                'id',
                $id
            )
            ->update(
                $this->table,
                [
                    'is_read' => 1
                ]
            );
    }

    /**
     * Tandai belum dibaca
     */
    public function mark_unread($id)
    {
        return $this->db
            ->where(
                'id',
                $id
            )
            ->update(
                $this->table,
                [
                    'is_read' => 0
                ]
            );
    }

    /**
     * Hapus pesan
     */
    public function delete($id)
    {
        return $this->db
            ->where(
                'id',
                $id
            )
            ->delete(
                $this->table
            );
    }

    /**
     * Hitung semua pesan
     */
    public function count_all()
    {
        return $this->db
            ->count_all(
                $this->table
            );
    }

    /**
     * Hitung pesan belum dibaca
     */
    public function count_unread()
    {
        return $this->db
            ->where(
                'is_read',
                0
            )
            ->count_all_results(
                $this->table
            );
    }

    /**
     * Ambil pesan belum dibaca
     */
    public function get_unread()
    {
        return $this->db
            ->where(
                'is_read',
                0
            )
            ->order_by(
                'created_at',
                'DESC'
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Ambil pesan terbaru
     */
    public function get_latest(
        $limit = 5
    )
    {
        return $this->db
            ->order_by(
                'created_at',
                'DESC'
            )
            ->limit(
                $limit
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Filter berdasarkan jenis
     */
    public function get_by_type(
        $jenis
    )
    {
        return $this->db
            ->where(
                'jenis',
                $jenis
            )
            ->order_by(
                'created_at',
                'DESC'
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Bulk delete
     */
    public function bulk_delete(
        $ids = []
    )
    {
        if (
            empty($ids)
        ) {
            return false;
        }

        return $this->db
            ->where_in(
                'id',
                $ids
            )
            ->delete(
                $this->table
            );
    }

    /**
     * Search pesan
     */
    public function search(
        $keyword
    )
    {
        return $this->db
            ->group_start()
            ->like(
                'nama',
                $keyword
            )
            ->or_like(
                'email',
                $keyword
            )
            ->or_like(
                'whatsapp',
                $keyword
            )
            ->or_like(
                'pesan',
                $keyword
            )
            ->or_like(
                'jenis',
                $keyword
            )
            ->group_end()
            ->order_by(
                'created_at',
                'DESC'
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Pagination admin
     */
    public function get_paginated(
        $limit,
        $start
    )
    {
        return $this->db
            ->order_by(
                'created_at',
                'DESC'
            )
            ->limit(
                $limit,
                $start
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /**
     * Jumlah pesan hari ini
     */
    public function count_today()
    {
        return $this->db
            ->where(
                'DATE(created_at)',
                date(
                    'Y-m-d'
                )
            )
            ->count_all_results(
                $this->table
            );
    }
}