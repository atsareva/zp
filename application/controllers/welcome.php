<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->model('feed');
        $rss = $this->feed->loadRss('http://zp.comments.ua/export/rss_zp_ru.xml');
        
        $data['title'] = htmlSpecialChars($rss->title);
        $data['description'] = htmlSpecialChars($rss->description);
        $data['items'] = $rss->item;
        
        $this->load->view('welcome_message', $data);
    }

}
