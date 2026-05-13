<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Setting_model
extends CI_Model
{
    private $table =
    'settings';

    public function get()
    {
        return $this->db
        ->where(
            'id',
            1
        )
        ->get(
            $this->table
        )
        ->row();
    }

    public function update($data)
    {
        return $this->db
        ->where(
            'id',
            1
        )
        ->update(
            $this->table,
            $data
        );
    }
}