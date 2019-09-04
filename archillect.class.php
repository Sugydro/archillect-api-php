<?php

require_once 'simple_html_dom.php';

class Archillect
{
    static function GetLastImageID()
    {
        $html = file_get_html('http://archillect.com');
        $href = $html->find('#posts', 0)->first_child()->href;

        return substr($href, 1);
    }

    static function GetImageData($imageId)
    {
        // todo: add existence check
        $html = file_get_html('http://archillect.com/'.$imageId);
        $imageURL = $html->find('#imgnav', 0)->last_child()->src;

        $linksArray = [];

        $divElements = $html->find('#sources', 0)->children;
        foreach($divElements as $element)
            $linksArray[] = $element->href;

        $dataArray = [
          'id' => $imageId, 'imageSource' => $imageURL, 'sourceLinks' => $linksArray
        ];

        return $dataArray;
    }

    static function GetLast($amount = 1)
    {
        $imageMaxId = self::GetLastImageID();
        $dataArray = [];

        for($i = 0; $i < $amount; $i++)
            $dataArray[] = self::GetImageData($imageMaxId - $i);

        return $dataArray;
    }

    static function GetRandom()
    {
        $imageMaxId = self::GetLastImageID();
        $imageId = mt_rand(1, $imageMaxId);

        return self::GetImageData($imageId);
    }
}
