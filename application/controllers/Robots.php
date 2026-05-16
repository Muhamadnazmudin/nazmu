<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class Robots
extends CI_Controller
{
    public function index()
    {
        header(
        'Content-Type: text/plain'
        );

        echo
"User-agent: *

Allow: /

Disallow: /admin/
Disallow: /login
Disallow: /logout

Crawl-delay: 2

Sitemap: "
. base_url(
'sitemap.xml'
);
    }
}