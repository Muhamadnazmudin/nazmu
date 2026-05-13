<?php
class Media_model
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
            'media_library'
        )
        ->result();
    }

    public function insert($data)
    {
        return $this->db
        ->insert(
            'media_library',
            $data
        );
    }

    public function get_by_id($id)
    {
        return $this->db
        ->where('id',$id)
        ->get(
            'media_library'
        )
        ->row();
    }

    public function delete($id)
    {
        return $this->db
        ->where('id',$id)
        ->delete(
            'media_library'
        );
    }
    public function count_all()
{
    return $this->db
    ->count_all(
    'media_library'
    );
}
}