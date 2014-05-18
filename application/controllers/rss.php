<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rss extends CI_Controller {

    private function _loadViews($templateName, $title, $data) {
        $this->load->view('page/head', array('title' => $title));
        $this->load->view('page/header');
        $this->load->view($templateName, $data);
        $this->load->view('page/footer');
    }

    public function index() {
        $this->load->model('news');
        $res           = $this->news->getAll();
        $data['items'] = $res;

        $this->_loadViews('template', 'Новости Запорожья', $data);
    }

}
