<?php

class News extends CI_Model {

    public function getNews() {
        $this->db->order_by('news_date', 'desc');
        //$this->db->from('news');
        $query = $this->db->get('news');
        return $query->result();
    }

}
