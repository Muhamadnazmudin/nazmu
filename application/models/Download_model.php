<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model
{
    protected $table = 'downloads';

    public function get_all()
    {
        return $this->db
            ->select('downloads.*, download_categories.name as category_name')
            ->from($this->table)
            ->join(
                'download_categories',
                'download_categories.id = downloads.category_id',
                'left'
            )
            ->order_by('downloads.id', 'DESC')
            ->get()
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function get_by_slug($slug)
    {
        return $this->db
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->get($this->table)
            ->row();
    }

    public function get_published()
    {
        return $this->db
            ->where('status', 'publish')
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function get_by_category($category_id)
    {
        return $this->db
            ->where('category_id', $category_id)
            ->where('status', 'publish')
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function get_featured()
    {
        return $this->db
            ->where('is_featured', 1)
            ->where('status', 'publish')
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function get_popular($limit = 10)
    {
        return $this->db
            ->where('status', 'publish')
            ->order_by(
                'total_download',
                'DESC'
            )
            ->limit($limit)
            ->get($this->table)
            ->result();
    }

    public function search($keyword)
    {
        return $this->db
            ->like('title', $keyword)
            ->or_like(
                'description',
                $keyword
            )
            ->where(
                'status',
                'publish'
            )
            ->order_by(
                'id',
                'DESC'
            )
            ->get($this->table)
            ->result();
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
            ->delete($this->table);
    }

    public function increment_download($id)
    {
        return $this->db
            ->set(
                'total_download',
                'total_download + 1',
                false
            )
            ->where('id', $id)
            ->update($this->table);
    }

    public function count_all()
    {
        return $this->db
            ->count_all(
                $this->table
            );
    }

    public function total_downloads()
    {
        return $this->db
            ->select_sum(
                'total_download'
            )
            ->get($this->table)
            ->row()
            ->total_download;
    }
}