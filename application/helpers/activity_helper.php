<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

function activity_log(
    $module,
    $activity
){
    $CI =& get_instance();

    if(
        !$CI->session
        ->userdata('logged_in')
    ){
        return;
    }

    $CI->db->insert(
        'activity_logs',
        [
            'user_id' =>
            $CI->session
            ->userdata('id'),

            'user_name' =>
            $CI->session
            ->userdata('nama'),

            'module' =>
            $module,

            'activity' =>
            $activity,

            'ip_address' =>
            $CI->input
            ->ip_address(),

            'user_agent' =>
            $CI->input
            ->user_agent(),

            'created_at' =>
            date(
                'Y-m-d H:i:s'
            )
        ]
    );
}