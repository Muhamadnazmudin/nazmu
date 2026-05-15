<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Tutorial_model extends CI_Model
{
    protected $table =
        'tutorials';

    /*
    |--------------------------------------------------------------------------
    | ADMIN
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

    public function insert($data)
    {
        return $this->db
            ->insert(
                $this->table,
                $data
            );
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
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    public function get_published()
    {
        return $this->db
            ->where(
                'status',
                'published'
            )
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

    public function get_featured(
        $limit = 6
    ){
        return $this->db
            ->where(
                'status',
                'published'
            )
            ->where(
                'is_featured',
                1
            )
            ->limit($limit)
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

    public function get_by_slug(
        $slug
    ){
        return $this->db
            ->where(
                'slug',
                $slug
            )
            ->where(
                'status',
                'published'
            )
            ->get(
                $this->table
            )
            ->row();
    }

    public function increment_views(
        $id
    ){
        $this->db->set(
            'views',
            'views + 1',
            FALSE
        );

        $this->db->where(
            'id',
            $id
        );

        return $this->db
            ->update(
                $this->table
            );
    }

    public function get_related(
        $id,
        $limit = 4
    ){
        return $this->db
            ->where(
                'id !=',
                $id
            )
            ->where(
                'status',
                'published'
            )
            ->limit($limit)
            ->order_by(
                'RAND()'
            )
            ->get(
                $this->table
            )
            ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | UTILITIES
    |--------------------------------------------------------------------------
    */

    public function slug_exists(
        $slug,
        $id = null
    ){
        $this->db->where(
            'slug',
            $slug
        );

        if($id){

            $this->db->where(
                'id !=',
                $id
            );

        }

        return $this->db
            ->count_all_results(
                $this->table
            ) > 0;
    }

    public function count_all()
    {
        return $this->db
            ->count_all(
                $this->table
            );
    }
}