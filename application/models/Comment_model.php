<?php
class Comment_model
extends CI_Model
{
    public function create($data)
    {
        return $this->db
        ->insert(
            'comments',
            $data
        );
    }

    public function get_all()
{
    return $this->db
    ->select(
        'comments.*,
        posts.title as post_title,
        posts.slug'
    )
    ->from('comments')
    ->join(
        'posts',
        'posts.id =
        comments.post_id'
    )
    ->order_by(
        'comments.id',
        'DESC'
    )
    ->get()
    ->result();
}

    public function get_by_post(
        $post_id
    )
    {
        return $this->db
        ->where(
            'post_id',
            $post_id
        )
        ->where(
            'status',
            'approved'
        )
        ->order_by(
            'id',
            'DESC'
        )
        ->get(
            'comments'
        )
        ->result();
    }

    public function update_status(
        $id,
        $status
    )
    {
        return $this->db
        ->where(
            'id',
            $id
        )
        ->update(
            'comments',
            [
                'status' =>
                $status
            ]
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
            'comments'
        );
    }
    public function count_all()
    {
        return $this->db
        ->count_all(
        'comments'
        );
    }
}