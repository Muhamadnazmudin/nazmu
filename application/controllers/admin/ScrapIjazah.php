<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class ScrapIjazah
extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // cek login admin
        if (
            !$this->session
                ->userdata(
                    'logged_in'
                )
        ) {

            redirect(
                'auth/login'
            );
        }

        $this->load->database();
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['title'] =
            'Dashboard Scrap e-Ijazah';

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */
        $data['total_sekolah'] =
            $this->db
                ->count_all(
                    'scrap_ijazah_schools'
                );

        $data['total_siswa'] =
            $this->db
                ->select_sum(
                    'jumlah_siswa'
                )
                ->get(
                    'scrap_ijazah_schools'
                )
                ->row()
                ->jumlah_siswa
                ?? 0;

        $data['upload_today'] =
            $this->db
                ->where(
                    'DATE(created_at)',
                    date('Y-m-d')
                )
                ->count_all_results(
                    'scrap_ijazah_schools'
                );

        $data['latest_schools'] =
            $this->db
                ->order_by(
                    'created_at',
                    'DESC'
                )
                ->limit(10)
                ->get(
                    'scrap_ijazah_schools'
                )
                ->result();

        $this->load->view(
            'admin/scrapijazah/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Riwayat Sekolah
    |--------------------------------------------------------------------------
    */
    public function schools()
    {
        $data['title'] =
            'Riwayat Sekolah';

        $data['schools'] =
            $this->db
                ->order_by(
                    'created_at',
                    'DESC'
                )
                ->get(
                    'scrap_ijazah_schools'
                )
                ->result();

        $this->load->view(
            'admin/scrapijazah/schools',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Logs Penggunaan
    |--------------------------------------------------------------------------
    */
    public function logs()
    {
        $data['title'] =
            'Logs Penggunaan';

        /*
        kalau tabel logs belum ada
        biar aman dulu
        */
        if (
            !$this->db
                ->table_exists(
                    'scrap_ijazah_logs'
                )
        ) {

            $data['logs'] = [];

        } else {

            $data['logs'] =
                $this->db
                    ->order_by(
                        'created_at',
                        'DESC'
                    )
                    ->get(
                        'scrap_ijazah_logs'
                    )
                    ->result();
        }

        $this->load->view(
            'admin/scrapijazah/logs',
            $data
        );
    }
    /*
|--------------------------------------------------------------------------
| Delete School
|--------------------------------------------------------------------------
*/
public function delete_school($id)
{
    $this->db
        ->where(
            'id',
            $id
        )
        ->delete(
            'scrap_ijazah_schools'
        );

    $this->session
        ->set_flashdata(
            'success',
            'Data sekolah berhasil dihapus'
        );

    redirect(
        'admin/scrapijazah/schools'
    );
}
}