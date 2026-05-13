<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Menu_model
extends CI_Model
{
    private $table =
    'menus';

    public function get_all()
    {
        return $this->db
        ->order_by(
            'sort_order',
            'ASC'
        )
        ->get(
            $this->table
        )
        ->result();
    }

    public function get_active()
    {
        return $this->db
        ->where(
            'status',
            1
        )
        ->where(
            'parent_id',
            0
        )
        ->order_by(
            'sort_order',
            'ASC'
        )
        ->get(
            $this->table
        )
        ->result();
    }

    public function get_submenu(
        $parent_id
    ){
        return $this->db
        ->where(
            'parent_id',
            $parent_id
        )
        ->where(
            'status',
            1
        )
        ->order_by(
            'sort_order',
            'ASC'
        )
        ->get(
            $this->table
        )
        ->result();
    }

    public function insert(
        $data
    ){
        return $this->db
        ->insert(
            $this->table,
            $data
        );
    }

    public function get_by_id(
        $id
    ){
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

    public function update(
        $id,
        $data
    ){
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

    public function delete(
        $id
    ){
        return $this->db
        ->where(
            'id',
            $id
        )
        ->delete(
            $this->table
        );
    }
}