<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Slider_model
extends CI_Model
{
    private $table =
    'sliders';

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        return $this->db
        ->order_by(
            'sort_order',
            'ASC'
        )
        ->order_by(
            'id',
            'DESC'
        )
        ->get(
            $this->table
        )
        ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | GET PUBLISHED
    |--------------------------------------------------------------------------
    */

    public function get_published()
    {
        return $this->db
        ->where(
            'status',
            'publish'
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

    /*
    |--------------------------------------------------------------------------
    | GET BY ID
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | INSERT
    |--------------------------------------------------------------------------
    */

    public function insert(
    $data
    )
    {
        return $this->db
        ->insert(
            $this->table,
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
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

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | COUNT
    |--------------------------------------------------------------------------
    */

    public function count_all()
    {
        return $this->db
        ->count_all(
            $this->table
        );
    }
}