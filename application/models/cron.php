<?php

class Cron extends CI_Model {

    private function _getFeeds() {
        $query = $this->db->get('feeds');
        return $query->result();
    }

    private function _saveNews($feedId, $item) {
        $data = array(
            'feed_id' => $feedId,
            'news_title' => htmlSpecialChars($item->title),
            'news_link' => htmlSpecialChars($item->link),
            'news_date' => (int) $item->timestamp,
        );

        if (isset($item->{'content:encoded'})) {
            $data['news_text'] = htmlSpecialChars($item->{'content:encoded'});
        } else {
            $data['news_text'] = htmlSpecialChars($item->description);
        }

        $this->db->insert('news', $data);
    }

    public function updateNews() {
        $this->load->model('feed');
        foreach ($this->_getFeeds() as $feedItem) {
            $feed = $this->feed->loadRss($feedItem->rss_link);
            foreach ($feed->item as $item) {
                $this->_saveNews($feedItem->entity_id, $item);
            }
            unset($feed);
        }
    }

}
