<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Post_model');
        $this->load->model('Category_model');
        $this->load->model('Media_model');
    }

    // Semua Artikel
    public function index()
    {
        $data['title'] = 'Semua Artikel';
        $data['posts'] = $this->Post_model->get_all();

        $this->load->view(
            'admin/posts/index',
            $data
        );
    }

    // Tambah Artikel
    public function create()
{
    $data['categories'] =
        $this->Category_model
        ->get_all();

    $data['media'] =
        $this->Media_model
        ->get_all();

    $this->load->view(
        'admin/posts/create',
        $data
    );
}

    // Draft Artikel
    public function draft()
    {
        $data['title'] = 'Draft Artikel';

        $data['posts'] =
            $this->Post_model->get_draft();

        $this->load->view(
            'admin/posts/draft',
            $data
        );
    }
    public function store()
{
    $title =
        $this->input
        ->post('title');

    $slug =
        $this->Post_model
        ->generate_slug($title);

    $status =
        $this->input
        ->post('status');

    $published_at =
        ($status == 'publish')
        ? date('Y-m-d H:i:s')
        : null;

    // thumbnail dari media library
    $thumbnail =
        $this->input
        ->post(
            'thumbnail_selected'
        );

    $data = [

        'category_id' =>
        $this->input
        ->post('category_id'),

        'user_id' =>
        $this->session
        ->userdata('id_user'),

        'title' =>
        $title,

        'slug' =>
        $slug,

        'thumbnail' =>
        $thumbnail,

        'excerpt' =>
        $this->input
        ->post('excerpt'),

        'content' =>
        $this->input
        ->post('content'),

        'meta_title' =>
        $this->input
        ->post('meta_title'),

        'meta_description' =>
        $this->input
        ->post('meta_description'),

        'status' =>
        $status,

        'published_at' =>
        $published_at

    ];

    $this->Post_model
    ->create_post($data);

    $this->session
    ->set_flashdata(
        'success',
        'Artikel berhasil dibuat'
    );

    redirect('admin/posts');
}
public function publish($id)
{
    $data = [
        'status' => 'publish',
        'published_at' =>
            date('Y-m-d H:i:s')
    ];

    $this->Post_model
        ->update($id, $data);

    redirect('admin/posts/draft');
}
public function delete($id)
{
    $post =
        $this->Post_model
        ->get_by_id($id);

    if ($post->thumbnail) {

        $path =
            './uploads/posts/' .
            $post->thumbnail;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $this->Post_model
        ->delete($id);

    redirect('admin/posts');
}
public function edit($id)
{
    $data['post'] =
    $this->Post_model
    ->get_by_id($id);

    $data['categories'] =
        $this->Category_model
        ->get_all();

    $data['media'] =
        $this->Media_model
        ->get_all();

    $this->load->view(
        'admin/posts/edit',
        $data
    );
}
public function update($id)
{
    $post =
        $this->Post_model
        ->get_by_id($id);

    $title =
        $this->input
        ->post('title');

    $slug =
        $this->Post_model
        ->generate_slug($title);

    $status =
        $this->input
        ->post('status');

    // thumbnail dari media library
    $thumbnail =
        $this->input
        ->post(
            'thumbnail_selected'
        );

    // kalau kosong pakai thumbnail lama
    if(empty($thumbnail)) {

        $thumbnail =
            $post->thumbnail;
    }

    // publish date
    if(
        $status == 'publish'
        &&
        empty(
            $post->published_at
        )
    ){
        $published_at =
            date(
                'Y-m-d H:i:s'
            );
    } else {

        $published_at =
            $post->published_at;
    }

    $data = [

        'category_id' =>
        $this->input
        ->post(
            'category_id'
        ),

        'title' =>
        $title,

        'slug' =>
        $slug,

        'thumbnail' =>
        $thumbnail,

        'excerpt' =>
        $this->input
        ->post(
            'excerpt'
        ),

        'content' =>
        $this->input
        ->post(
            'content'
        ),

        'meta_title' =>
        $this->input
        ->post(
            'meta_title'
        ),

        'meta_description' =>
        $this->input
        ->post(
            'meta_description'
        ),

        'status' =>
        $status,

        'published_at' =>
        $published_at
    ];

    $this->Post_model
    ->update(
        $id,
        $data
    );

    $this->session
    ->set_flashdata(
        'success',
        'Artikel berhasil diperbarui'
    );

    redirect(
        'admin/posts'
    );
}
public function toggle_status($id)
{
    $post =
        $this->Post_model
        ->get_by_id($id);

    if (!$post) {
        show_404();
    }

    // toggle
    $new_status =
        ($post->status == 'publish')
        ? 'draft'
        : 'publish';

    $data = [
        'status' => $new_status
    ];

    // kalau publish
    if ($new_status == 'publish') {

        $data['published_at'] =
            date('Y-m-d H:i:s');
    }

    $this->Post_model
        ->update($id, $data);

    redirect('admin/posts');
}
}