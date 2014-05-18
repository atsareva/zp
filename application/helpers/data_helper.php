<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Create folder and retrieve path to it
 * 
 * @param string $name
 * @return string
 */
if (!function_exists('createFolder')) {

    function createFolder($name) {
        $directory = FCPATH . $name;

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        return $directory;
    }

}

if (!function_exists('writeToLog')) {

    function writeToLog($filename, $data) {
        if (is_string($data)) {
            file_put_contents($filename, date('Y-m-d H:i:s') . ' - ' . $data . "\n", FILE_APPEND);
        }

        return true;
    }

}
