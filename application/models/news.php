<?php

class News extends CI_Model {

    const TABLE_NAME = 'news';

    public function getAll() {
        $this->db->order_by('news_date', 'desc');
        $query = $this->db->get(self::TABLE_NAME);
        return $query->result();
    }

    public function getLastByFeedId($feedId) {
        $this->db->order_by('news_date', 'desc');
        $query = $this->db->get_where(self::TABLE_NAME, array('feed_id' => (int) $feedId), 1);
        $res   = $query->result();
        if (isset($res[0])) {
            return $res[0];
        }

        return false;
    }

    public function save($data) {
        $this->db->insert(self::TABLE_NAME, $data);
        return $this->db->insert_id();
    }

}
