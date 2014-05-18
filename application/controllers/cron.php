<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cron extends CI_Controller {

    const LOF_FILE   = 'log.txt';
    const LOG_FOLDER = 'var';

    private $_logFolder;

    public function __construct() {
        parent::__construct();

        $this->load->helper('data');
        $this->_logFolder = createFolder(self::LOG_FOLDER);

        $this->load->library('parser');
    }

    public function test() {
        writeToLog($this->_logFolder . DIRECTORY_SEPARATOR . self::LOF_FILE, 'test');
    }

    private function _saveNews($feedId, $item) {
        $data = array(
            'feed_id'    => $feedId,
            'news_title' => (string) $item->title,
            'news_link'  => (string) $item->link,
            'news_date'  => (int) $item->timestamp,
        );

        if (isset($item->{'content:encoded'})) {
            $data['news_text'] = (string) $item->{'content:encoded'};
        } else {
            $data['news_text'] = (string) $item->description;
        }

        $id = $this->news->save($data);

        $message = 'ID=' . $id . ' (' . date('Y-m-d H:i') . ') ' . $data['news_title'];
        writeToLog($this->_logFolder . DIRECTORY_SEPARATOR . self::LOF_FILE, $message);
    }

    public function index() {
        $this->load->model(array('news', 'feeds'));
        foreach ($this->feeds->getAll() as $feedItem) {
            $feed     = $this->parser->loadRss($feedItem->rss_link);
            $lastNews = $this->news->getLastByFeedId($feedItem->entity_id);

            foreach ($feed->item as $item) {
                if ($lastNews) {
                    if ($lastNews->news_date < (int) $item->timestamp) {
                        $this->_saveNews($feedItem->entity_id, $item);
                    }
                } else {
                    $this->_saveNews($feedItem->entity_id, $item);
                }
            }
            unset($feed);
        }
    }

}
