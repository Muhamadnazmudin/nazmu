<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Backup
extends MY_Controller
{
    private $backup_path;

    public function __construct()
    {
        parent::__construct();

        if(
            !$this->session
            ->userdata(
                'logged_in'
            )
        ){
            redirect(
                'auth'
            );
        }

        $this->load
        ->database();

        $this->load
        ->dbutil();

        $this->load
        ->helper([
            'file',
            'download'
        ]);

        $this->load
        ->model(
            'Backup_model'
        );

        $this->backup_path =
        FCPATH .
        'uploads/backups/';

        if(
            !is_dir(
                $this->backup_path
            )
        ){
            mkdir(
                $this->backup_path,
                0777,
                true
            );
        }
    }

    public function index()
    {
        $data['title'] =
        'Backup Database';

        $data['backups'] =
        $this->Backup_model
        ->get_all();

        $this->load->view(
            'admin/backup/index',
            $data
        );
    }

    public function create()
    {
        try{

            $file_name =
            'backup_' .
            date(
                'Y-m-d_H-i-s'
            ) .
            '.sql';

            $prefs = [

                'format' =>
                'txt',

                'filename' =>
                'database.sql',

                'add_drop' =>
                true,

                'add_insert' =>
                true,

                'newline' =>
                "\n",

                'foreign_key_checks' =>
                false
            ];

            $backup =
            $this->dbutil
            ->backup(
                $prefs
            );

            $full_path =
            $this->backup_path .
            $file_name;

            write_file(
                $full_path,
                $backup
            );

            $this->db->insert(
                'backups',
                [

                    'file_name' =>
                    $file_name,

                    'file_size' =>
                    round(
                        filesize(
                            $full_path
                        ) / 1024,
                        2
                    ) . ' KB',

                    'created_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
                ]
            );

            if(
                function_exists(
                    'activity_log'
                )
            ){
                activity_log(
                    'Membuat backup database'
                );
            }

            $this->session
            ->set_flashdata(
                'success',
                'Backup database berhasil dibuat.'
            );

        }catch(
            Exception $e
        ){

            $this->session
            ->set_flashdata(
                'error',
                $e->getMessage()
            );
        }

        redirect(
            'admin/backup'
        );
    }

    public function restore()
    {
        if(
            empty(
                $_FILES['file']['name']
            )
        ){
            $this->session
            ->set_flashdata(
                'error',
                'Silakan pilih file SQL.'
            );

            redirect(
                'admin/backup'
            );
        }

        $extension =
        pathinfo(
            $_FILES['file']['name'],
            PATHINFO_EXTENSION
        );

        if(
            strtolower(
                $extension
            ) != 'sql'
        ){
            $this->session
            ->set_flashdata(
                'error',
                'File harus format .sql'
            );

            redirect(
                'admin/backup'
            );
        }

        try{

            $sql =
            file_get_contents(
                $_FILES['file']
                ['tmp_name']
            );

            $queries =
            preg_split(
                "/;[\r\n]+/",
                $sql
            );

            $this->db
            ->trans_begin();

            foreach(
                $queries
                as $query
            ){

                $query =
                trim(
                    $query
                );

                if(
                    empty(
                        $query
                    )
                ){
                    continue;
                }

                $this->db
                ->query(
                    $query
                );
            }

            if(
                $this->db
                ->trans_status()
                === false
            ){

                $this->db
                ->trans_rollback();

                throw new Exception(
                    'Restore database gagal.'
                );
            }

            $this->db
            ->trans_commit();

            if(
                function_exists(
                    'activity_log'
                )
            ){
                activity_log(
                    'Melakukan restore database'
                );
            }

            $this->session
            ->set_flashdata(
                'success',
                'Database berhasil direstore.'
            );

        }catch(
            Exception $e
        ){

            $this->session
            ->set_flashdata(
                'error',
                $e->getMessage()
            );
        }

        redirect(
            'admin/backup'
        );
    }

    public function download($file_name)
    {
        $path =
        $this->backup_path .
        $file_name;

        if(
            file_exists(
                $path
            )
        ){
            force_download(
                $path,
                null
            );

            return;
        }

        show_404();
    }

    public function delete($id)
    {
        $backup =
        $this->db
        ->get_where(
            'backups',
            [
                'id' => $id
            ]
        )
        ->row();

        if(
            !$backup
        ){
            show_404();
        }

        $path =
        $this->backup_path .
        $backup->file_name;

        if(
            file_exists(
                $path
            )
        ){
            unlink(
                $path
            );
        }

        $this->db
        ->delete(
            'backups',
            [
                'id' => $id
            ]
        );

        if(
            function_exists(
                'activity_log'
            )
        ){
            activity_log(
                'Menghapus backup database'
            );
        }

        $this->session
        ->set_flashdata(
            'success',
            'Backup berhasil dihapus.'
        );

        redirect(
            'admin/backup'
        );
    }
}