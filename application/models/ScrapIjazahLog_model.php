<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class ScrapIjazahLog_model
extends CI_Model
{
    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */
    protected $table =
        'scrap_ijazah_logs';


    /*
    |--------------------------------------------------------------------------
    | Create Log
    |--------------------------------------------------------------------------
    */
    public function insert(
        $data
    )
    {
        $this->db->insert(
            $this->table,
            $data
        );

        return $this->db
            ->insert_id();
    }


    /*
    |--------------------------------------------------------------------------
    | Get Logs
    |--------------------------------------------------------------------------
    */
    public function get_all(
        $limit = 20,
        $offset = 0
    )
    {
        return $this->db
            ->order_by(
                'created_at',
                'DESC'
            )
            ->limit(
                $limit,
                $offset
            )
            ->get(
                $this->table
            )
            ->result();
    }

    public function get_by_id(
        $id
    )
    {
        return $this->db
            ->get_where(
                $this->table,
                [
                    'id' => $id
                ]
            )
            ->row();
    }


    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */
    public function count_all()
    {
        return $this->db
            ->count_all(
                $this->table
            );
    }

    public function total_today()
    {
        return $this->db
            ->where(
                'DATE(created_at)',
                date('Y-m-d')
            )
            ->count_all_results(
                $this->table
            );
    }

    public function total_this_month()
    {
        return $this->db
            ->where(
                'MONTH(created_at)',
                date('m')
            )
            ->where(
                'YEAR(created_at)',
                date('Y')
            )
            ->count_all_results(
                $this->table
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Top Schools
    |--------------------------------------------------------------------------
    */
    public function top_school(
        $limit = 10
    )
    {
        return $this->db
            ->select('
                school_name,
                npsn,
                COUNT(id)
                as total_usage
            ')
            ->group_by(
                'npsn'
            )
            ->order_by(
                'total_usage',
                'DESC'
            )
            ->limit($limit)
            ->get(
                $this->table
            )
            ->result();
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Old Logs
    |--------------------------------------------------------------------------
    */
    public function delete_old(
        $days = 90
    )
    {
        return $this->db
            ->where(
                'created_at <',
                date(
                    'Y-m-d H:i:s',
                    strtotime(
                        "-{$days} days"
                    )
                )
            )
            ->delete(
                $this->table
            );
    }
}