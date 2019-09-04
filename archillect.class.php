<?php

class Archillect
{
    static function GetLastImageID()
    {
        $mainPage = file_get_contents('http://archillect.com');

        $document = new DOMDocument();
        $document->loadHTML($mainPage); // was @$document

        $containerDiv = $document->getElementById('posts');
        $imageElement = $containerDiv->childNodes->item(1)->getAttribute('href');
        //$this->imageMaxId = substr($imageElement, 1);
        return substr($imageElement, 1);
    }

    static function GetImageData($imageId)
    {
        // todo: add existence check
        $mainPage = file_get_contents('http://archillect.com/'.$imageId);
        $document = new DOMDocument();
        $document->loadHTML($mainPage);

        $imageURL = $document->getElementsByTagName('img')[1]->getAttribute('src');
        $linksArray = [];

        $sourcesDiv = $document->getElementById('sources');

        foreach ($sourcesDiv->childNodes as $entry)
            if($entry->nodeName == 'a' && $entry->hasAttribute('href'))
                $linksArray[] = $entry->getAttribute('href');

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
