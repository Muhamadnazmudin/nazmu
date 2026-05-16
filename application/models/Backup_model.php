<?php
class Backup_model
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
            'backups'
        )
        ->result();
    }
}