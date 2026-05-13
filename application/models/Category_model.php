<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
    private $table =
        'categories';

    public function get_all()
    {
        return $this->db
            ->order_by('name', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function insert($data)
    {
        return $this->db
            ->insert(
                $this->table,
                $data
            );
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update(
                $this->table,
                $data
            );
    }

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete(
                $this->table
            );
    }

    public function generate_slug($name)
    {
        return url_title(
            $name,
            '-',
            TRUE
        );
    }
    public function get_by_slug($slug)
{
    return $this->db
        ->where('slug', $slug)
        ->get('categories')
        ->row();
}
public function count_all()
{
    return $this->db
    ->count_all(
    'categories'
    );
}
}