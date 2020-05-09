<?php

namespace Lib\Service;

use Exception;

class FileReader
{

    public $content = '';
    public $hasContent = false;

    public function read($file)
    {
        try {
            $data = file_get_contents($file);
            if ($data) {
                $this->hasContent = true;
                $this->content = $data;
            }
        } catch (Exception $e) {
            //File does not exist!
        }
    }

    public function getData()
    {
        return $this->content;
    }

    public function getDataJsonDecoded()
    {
        return json_decode($this->content);
    }

    public function getDataArray()
    {
        return explode("\n", $this->content);
    }

    public function hasContent()
    {
        return $this->hasContent;
    }
}