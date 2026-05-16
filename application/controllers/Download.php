<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Download_model'
        );

        $this->load->model(
            'Download_category_model'
        );
        $this->load->helper('download');
    }

    public function index()
    {
        $data['title'] =
            'Download';

        $data['downloads'] =
            $this->Download_model
                ->get_published();

        $data['download_categories']
=
$this->Download_category_model
->get_all();

        $this->load->view(
            'public/download/index',
            $data
        );
    }

    public function file($slug)
    {
        $file =
            $this->Download_model
                ->get_by_slug(
                    $slug
                );

        if (!$file) {
            show_404();
        }

        /*
        Increment download
        */
        $this->Download_model
            ->increment_download(
                $file->id
            );

        /*
        External URL
        */
        if (
            $file->file_source
            == 'external'
        ) {

            redirect(
                $file->external_url
            );
        }

        /*
        Local file
        */
        if (
            !empty(
                $file->file_path
            )
        ) {

            force_download(
                FCPATH .
                $file->file_path,
                NULL
            );
        }

        show_404();
    }

    public function category($slug)
    {
        $category =
            $this->Download_category_model
                ->get_by_slug(
                    $slug
                );

        if (!$category) {
            show_404();
        }

        $data['title'] =
            'Download - ' .
            $category->name;

        $data['downloads'] =
            $this->Download_model
                ->get_by_category(
                    $category->id
                );

        $data['category'] =
            $category;

       $data['download_categories']
=
$this->Download_category_model
->get_all();

        $this->load->view(
            'public/download/index',
            $data
        );
    }

    public function view($slug)
{
    $file =
        $this->Download_model
        ->get_by_slug($slug);

    if(!$file){
        show_404();
    }

    /*
    External URL
    */
    if(
        $file->file_source
        == 'external'
    ){

        redirect(
            $file->external_url
        );
    }

    /*
    Local file
    */
    if(
        empty(
            $file->file_path
        )
    ){
        show_404();
    }

    $file_url =
        base_url(
            $file->file_path
        );

    $ext =
        strtolower(
            pathinfo(
                $file->file_path,
                PATHINFO_EXTENSION
            )
        );

    /*
    PDF
    */
    if($ext == 'pdf'){

        redirect(
            $file_url
        );
    }

    /*
    OFFICE DOCUMENT
    */
    if(
    in_array(
        $ext,
        [
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx'
        ]
    )
){

    /*
    localhost -> buka langsung
    */
    if(
        strpos(
            base_url(),
            'localhost'
        ) !== false
        ||
        strpos(
            base_url(),
            '127.0.0.1'
        ) !== false
    ){

        redirect(
            $file_url
        );
    }

    /*
    hosting -> office viewer
    */
    $viewer =
'https://view.officeapps.live.com/op/view.aspx?src='
    .
    urlencode(
        $file_url
    );

    redirect(
        $viewer
    );
}

    /*
    IMAGE
    */
    if(
        in_array(
            $ext,
            [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ]
        )
    ){

        redirect(
            $file_url
        );
    }

    /*
    fallback
    */
    redirect(
        site_url(
            'download-center/file/' .
            $slug
        )
    );
}
}