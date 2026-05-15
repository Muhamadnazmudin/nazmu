<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Tutorials extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Tutorial_model'
        );

        $this->load->helper(
            'text'
        );

        $this->load->helper(
            'url'
        );

        $this->load->library(
            'form_validation'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] =
            'Tutorial';

        $data['tutorials'] =
            $this->Tutorial_model
                ->get_all();

        $this->load->view(
            'admin/tutorials/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['title'] =
            'Tambah Tutorial';

        $this->load->view(
            'admin/tutorials/create',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->form_validation
            ->set_rules(
                'title',
                'Judul',
                'required|trim'
            );

        $this->form_validation
            ->set_rules(
                'video_url',
                'URL Video',
                'required|trim'
            );

        if(
            $this->form_validation
                ->run()
            == FALSE
        ){

            return $this->create();

        }

        /*
        Generate slug
        */
        $slug =
            url_title(
                $this->input->post(
                    'title'
                ),
                '-',
                TRUE
            );

        /*
        Prevent duplicate slug
        */
        $original_slug =
            $slug;

        $i = 1;

        while(
            $this->Tutorial_model
                ->slug_exists(
                    $slug
                )
        ){

            $slug =
                $original_slug .
                '-' .
                $i;

            $i++;
        }

        /*
        Detect platform
        */
        $video_url =
            trim(
                $this->input->post(
                    'video_url'
                )
            );

        $video_type =
            $this->detect_video_type(
                $video_url
            );

        $data = [

    'title' =>
        $this->input->post(
            'title',
            TRUE
        ),

    'slug' =>
        $slug,

    'description' =>
        $this->input->post(
            'description'
        ),

    'video_url' =>
        $video_url,

    'video_type' =>
        $video_type,

    'thumbnail' =>
        $this->input->post(
            'thumbnail',
            TRUE
        ),

    'status' =>
        $this->input->post(
            'status'
        ) ?: 'published',

    'is_featured' =>
        $this->input->post(
            'is_featured'
        ) ? 1 : 0,

    'sort_order' =>
        (int) (
            $this->input->post(
                'sort_order'
            ) ?: 0
        ),

    'created_at' =>
        date(
            'Y-m-d H:i:s'
        ),

    'updated_at' =>
        date(
            'Y-m-d H:i:s'
        )

];

        $this->Tutorial_model
            ->insert(
                $data
            );

        $this->session
            ->set_flashdata(
                'success',
                'Tutorial berhasil ditambahkan.'
            );

        redirect(
            'admin/tutorials'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETECT VIDEO TYPE
    |--------------------------------------------------------------------------
    */

    private function detect_video_type(
        $url
    ){

        if(
            strpos(
                $url,
                'youtube.com'
            ) !== false
            ||
            strpos(
                $url,
                'youtu.be'
            ) !== false
        ){

            return 'youtube';

        }

        if(
            strpos(
                $url,
                'tiktok.com'
            ) !== false
        ){

            return 'tiktok';

        }

        if(
            strpos(
                $url,
                'vimeo.com'
            ) !== false
        ){

            return 'vimeo';

        }

        return 'other';
    }
    /*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/

public function edit($id)
{
    $tutorial =
        $this->Tutorial_model
            ->get_by_id(
                $id
            );

    if(!$tutorial){

        show_404();

    }

    $data['title'] =
        'Edit Tutorial';

    $data['tutorial'] =
        $tutorial;

    $this->load->view(
        'admin/tutorials/edit',
        $data
    );
}

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

public function update($id)
{
    $tutorial =
        $this->Tutorial_model
            ->get_by_id(
                $id
            );

    if(!$tutorial){

        show_404();

    }

    $this->form_validation
        ->set_rules(
            'title',
            'Judul',
            'required|trim'
        );

    $this->form_validation
        ->set_rules(
            'video_url',
            'URL Video',
            'required|trim'
        );

    if(
        $this->form_validation
            ->run()
        == FALSE
    ){

        return $this->edit(
            $id
        );

    }

    /*
    Generate slug
    */
    $slug =
        url_title(
            $this->input->post(
                'title'
            ),
            '-',
            TRUE
        );

    /*
    Prevent duplicate slug
    */
    $original_slug =
        $slug;

    $i = 1;

    while(
        $this->Tutorial_model
            ->slug_exists(
                $slug,
                $id
            )
    ){

        $slug =
            $original_slug .
            '-' .
            $i;

        $i++;
    }

    /*
    Detect video type
    */
    $video_url =
        trim(
            $this->input->post(
                'video_url'
            )
        );

    $video_type =
        $this->detect_video_type(
            $video_url
        );

    $data = [

        'title' =>
            $this->input->post(
                'title',
                TRUE
            ),

        'slug' =>
            $slug,

        'description' =>
            $this->input->post(
                'description'
            ),

        'video_url' =>
            $video_url,

        'video_type' =>
            $video_type,

        'thumbnail' =>
            $this->input->post(
                'thumbnail',
                TRUE
            ),

        'status' =>
            $this->input->post(
                'status'
            ) ?: 'published',

        'is_featured' =>
            $this->input->post(
                'is_featured'
            ) ? 1 : 0,

        'sort_order' =>
            (int) (
                $this->input->post(
                    'sort_order'
                ) ?: 0
            ),

        'updated_at' =>
            date(
                'Y-m-d H:i:s'
            )

    ];

    $this->Tutorial_model
        ->update(
            $id,
            $data
        );

    $this->session
        ->set_flashdata(
            'success',
            'Tutorial berhasil diupdate.'
        );

    redirect(
        'admin/tutorials'
    );
}

/*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/

public function delete($id)
{
    $tutorial =
        $this->Tutorial_model
            ->get_by_id(
                $id
            );

    if(!$tutorial){

        show_404();

    }

    $this->Tutorial_model
        ->delete(
            $id
        );

    $this->session
        ->set_flashdata(
            'success',
            'Tutorial berhasil dihapus.'
        );

    redirect(
        'admin/tutorials'
    );
}
}