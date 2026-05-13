<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model
{
    private $table = 'posts';

    public function get_all()
{
    return $this->db
        ->select('posts.*, categories.name as category_name')
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->order_by('posts.id', 'DESC')
        ->get()
        ->result();
}

    public function get_draft()
{
    return $this->db
        ->select('posts.*, categories.name as category_name')
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->where('status', 'draft')
        ->order_by('posts.id', 'DESC')
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

    public function insert($data)
    {
        return $this->db
            ->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    public function generate_slug($title)
    {
        
        $slug = url_title($title, '-', TRUE);

        $count = $this->db
            ->like('slug', $slug, 'after')
            ->count_all_results($this->table);

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        return $slug;
    }
    public function create_post($data)
{
    return $this->db->insert(
        $this->table,
        $data
    );
}
public function get_by_slug($slug)
{
    return $this->db
        ->where('slug', $slug)
        ->where('status', 'publish')
        ->get('posts')
        ->row();
}
public function get_featured_post()
{
    return $this->db
        ->where('status', 'publish')
        ->order_by('published_at', 'DESC')
        ->limit(1)
        ->get('posts')
        ->row();
}
public function get_latest_posts(
    $limit = 6,
    $exclude_id = null
)
{
    $this->db
        ->select(
            'posts.*, categories.name as category_name'
        )
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->where(
            'posts.status',
            'publish'
        );

    // jangan tampilkan featured lagi
    if ($exclude_id) {

        $this->db->where(
            'posts.id !=',
            $exclude_id
        );
    }

    return $this->db
        ->order_by(
            'posts.published_at',
            'DESC'
        )
        ->limit($limit)
        ->get()
        ->result();
}
public function get_popular_posts($limit = 5)
{
    return $this->db
        ->where('status', 'publish')
        ->order_by('views', 'DESC')
        ->limit($limit)
        ->get('posts')
        ->result();
}
public function get_posts_by_category(
    $category_id
)
{
    return $this->db
        ->select('posts.*, categories.name as category_name')
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->where(
            'posts.category_id',
            $category_id
        )
        ->where(
            'posts.status',
            'publish'
        )
        ->order_by(
            'posts.published_at',
            'DESC'
        )
        ->get()
        ->result();
}
public function search_posts($keyword)
{
    return $this->db
        ->select(
            'posts.*, categories.name as category_name'
        )
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->where(
            'posts.status',
            'publish'
        )
        ->group_start()
        ->like(
            'posts.title',
            $keyword
        )
        ->or_like(
            'posts.content',
            $keyword
        )
        ->or_like(
            'posts.excerpt',
            $keyword
        )
        ->group_end()
        ->order_by(
            'posts.published_at',
            'DESC'
        )
        ->get()
        ->result();
}
public function get_all_published()
{
    return $this->db
        ->select(
            'posts.*, categories.name as category_name'
        )
        ->from('posts')
        ->join(
            'categories',
            'categories.id = posts.category_id',
            'left'
        )
        ->where(
            'posts.status',
            'publish'
        )
        ->order_by(
            'posts.published_at',
            'DESC'
        )
        ->get()
        ->result();
}
public function count_all()
{
    return $this->db
    ->count_all(
    'posts'
    );
}
}