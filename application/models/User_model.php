<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class User_model
extends CI_Model
{
    private $table =
    'users';

    /*
    |--------------------------------------------------------------------------
    | GET ALL
    |--------------------------------------------------------------------------
    */

    public function get_all()
    {
        return $this->db
        ->order_by(
            'id',
            'DESC'
        )
        ->get(
            $this->table
        )
        ->result();
    }

    /*
    |--------------------------------------------------------------------------
    | GET BY ID
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | GET BY USERNAME
    |--------------------------------------------------------------------------
    */

    public function get_by_username(
    $username
    )
    {
        return $this->db
        ->where(
            'username',
            $username
        )
        ->get(
            $this->table
        )
        ->row();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(
    $username,
    $password
    )
    {
        $user =
        $this->db
        ->where(
            'username',
            $username
        )
        ->get(
            $this->table
        )
        ->row();

        if(!$user){
            return false;
        }

        if(
        password_verify(
        $password,
        $user->password
        )
        ){
            return $user;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | INSERT
    |--------------------------------------------------------------------------
    */

    public function insert(
    $data
    )
    {
        return $this->db
        ->insert(
            $this->table,
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
    $id,
    $data
    )
    {
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

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

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
    | COUNT
    |--------------------------------------------------------------------------
    */

    public function count_all()
    {
        return $this->db
        ->count_all(
            $this->table
        );
    }
}