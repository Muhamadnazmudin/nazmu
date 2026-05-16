<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Kontak
extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Message_model'
        );

        $this->load->model(
            'Setting_model'
        );

        $this->load->library(
            'form_validation'
        );
    }

    /**
     * Halaman kontak
     */
    public function index()
    {
        $data['title'] =
        'Pusat Permintaan & Saran';

        $data['setting'] =
        $this->Setting_model
        ->get();

        $this->load->view(
            'public/kontak/index',
            $data
        );
    }

    /**
     * Kirim pesan
     */
    public function send()
    {
        // validasi form
        $this->form_validation
        ->set_rules(
            'nama',
            'Nama',
            'required|trim|min_length[3]'
        );

        $this->form_validation
        ->set_rules(
            'email',
            'Email',
            'required|trim|valid_email'
        );

        $this->form_validation
        ->set_rules(
            'whatsapp',
            'Nomor WhatsApp',
            'required|trim|min_length[10]'
        );

        $this->form_validation
        ->set_rules(
            'jenis',
            'Jenis Pesan',
            'required|trim'
        );

        $this->form_validation
        ->set_rules(
            'pesan',
            'Pesan',
            'required|trim|min_length[10]'
        );

        if (
            $this->form_validation
            ->run() == false
        ) {

            $this->session
            ->set_flashdata(
                'error',
                strip_tags(
                    validation_errors()
                )
            );

            redirect(
                'kontak'
            );
        }

        // data simpan
        $data = [

            'nama' =>
            html_escape(
                $this->input
                ->post(
                    'nama',
                    true
                )
            ),

            'email' =>
            html_escape(
                $this->input
                ->post(
                    'email',
                    true
                )
            ),

            'whatsapp' =>
            html_escape(
                $this->input
                ->post(
                    'whatsapp',
                    true
                )
            ),

            'jenis' =>
            html_escape(
                $this->input
                ->post(
                    'jenis',
                    true
                )
            ),

            'pesan' =>
            html_escape(
                $this->input
                ->post(
                    'pesan',
                    true
                )
            ),

            'ip_address' =>
            $this->input
            ->ip_address(),

            'created_at' =>
            date(
                'Y-m-d H:i:s'
            )
        ];

        // simpan ke database
        $insert =
        $this->Message_model
        ->insert_message(
            $data
        );

        if (
            $insert
        ) {

            // kirim notif whatsapp
            $this->send_whatsapp(
                $data
            );

            $this->session
            ->set_flashdata(
                'success',
                'Terima kasih, pesan Anda berhasil dikirim.'
            );

        } else {

            $this->session
            ->set_flashdata(
                'error',
                'Gagal mengirim pesan.'
            );
        }

        redirect(
            'kontak'
        );
    }

    /**
     * Kirim notif WA admin
     */
    private function
send_whatsapp(
    $data
)
{
    $token =
    '7x2FczPc9s25XSmYFhuv';

    $curl =
    curl_init();

    $message =
    "🔔 Pesan Baru Nazmu Blog\n\n" .

    "👤 Nama: " .
    $data['nama'] .
    "\n" .

    "📧 Email: " .
    $data['email'] .
    "\n" .

    "📱 WhatsApp: " .
    $data['whatsapp'] .
    "\n" .

    "📂 Jenis: " .
    $data['jenis'] .
    "\n\n" .

    "💬 Pesan:\n" .
    $data['pesan'] .
    "\n\n" .

    "🕒 " .
    date(
        'd-m-Y H:i'
    );

    curl_setopt_array(
        $curl,
        [

            CURLOPT_URL =>
            'https://api.fonnte.com/send',

            CURLOPT_RETURNTRANSFER =>
            true,

            CURLOPT_POST =>
            true,

            CURLOPT_SSL_VERIFYHOST =>
            0,

            CURLOPT_SSL_VERIFYPEER =>
            false,

            CURLOPT_POSTFIELDS =>
            [

                'target' =>
                '6285651414221',

                'message' =>
                $message
            ],

            CURLOPT_HTTPHEADER =>
            [
                'Authorization: ' .
                $token
            ]

        ]
    );

    curl_exec(
        $curl
    );

    curl_close(
        $curl
    );
}
 
}
