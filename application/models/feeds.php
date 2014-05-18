<?php

class Feeds extends CI_Model {

    const TABLE_NAME = 'feeds';

    public function getAll() {
        $query = $this->db->get(self::TABLE_NAME);
        return $query->result();
    }

}
