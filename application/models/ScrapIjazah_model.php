<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class ScrapIjazah_model
extends CI_Model
{
    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */
    protected $table_school =
        'scrap_ijazah_schools';

    protected $table_student =
        'scrap_ijazah_students';


    /*
    |--------------------------------------------------------------------------
    | School History
    |--------------------------------------------------------------------------
    */
    public function get_schools(
        $limit = 10,
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
                $this->table_school
            )
            ->result();
    }

    public function count_schools()
    {
        return $this->db
            ->count_all(
                $this->table_school
            );
    }

    public function get_school_by_npsn(
        $npsn
    )
    {
        return $this->db
            ->get_where(
                $this->table_school,
                [
                    'npsn' => $npsn
                ]
            )
            ->row();
    }

    public function insert_school(
        $data
    )
    {
        return $this->db
            ->insert(
                $this->table_school,
                $data
            );
    }

    public function update_school(
        $npsn,
        $data
    )
    {
        return $this->db
            ->where(
                'npsn',
                $npsn
            )
            ->update(
                $this->table_school,
                $data
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Student Parsed Result
    |--------------------------------------------------------------------------
    */
    public function insert_students(
        $data
    )
    {
        return $this->db
            ->insert_batch(
                $this->table_student,
                $data
            );
    }

    public function get_students_by_school(
        $npsn
    )
    {
        return $this->db
            ->where(
                'npsn',
                $npsn
            )
            ->order_by(
                'nama',
                'ASC'
            )
            ->get(
                $this->table_student
            )
            ->result();
    }

    public function get_student_count(
        $npsn
    )
    {
        return $this->db
            ->where(
                'npsn',
                $npsn
            )
            ->count_all_results(
                $this->table_student
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Statistics
    |--------------------------------------------------------------------------
    */
    public function total_school()
    {
        return $this->db
            ->count_all(
                $this->table_school
            );
    }

    public function total_students()
    {
        return $this->db
            ->count_all(
                $this->table_student
            );
    }

    public function top_school(
        $limit = 10
    )
    {
        return $this->db
            ->order_by(
                'jumlah_siswa',
                'DESC'
            )
            ->limit($limit)
            ->get(
                $this->table_school
            )
            ->result();
    }
}