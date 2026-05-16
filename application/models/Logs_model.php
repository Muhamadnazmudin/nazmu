<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Logs_model
extends CI_Model
{
    public function get_all()
    {
        return $this->db
        ->order_by(
            'id',
            'DESC'
        )
        ->get(
            'activity_logs'
        )
        ->result();
    }
}