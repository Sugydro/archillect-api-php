<?php

require_once 'archillect.class.php';

if(!empty($_GET['method']))
{
    switch (strtolower($_GET['method']))
    {
        case 'getlastid':
            echo json_encode(Archillect::GetLastImageID());
            break;
        case 'getlast':
            if(isset($_GET['int']) && is_numeric($_GET['int'])) {
                echo json_encode(Archillect::GetLast($_GET['int']));
            }
            else
                echo 'Invalid amount';
            break;
        case 'getbyid':
            if(isset($_GET['int']) && is_numeric($_GET['int'])) {
                echo json_encode(Archillect::GetImageData($_GET['int']));
            }
            else
                echo 'Invalid id';
            break;
        case 'getrandom':
            echo json_encode(Archillect::GetRandom());
            break;
        default:
            echo 'Unknown method';
            break;
    }
}
else
    echo 'Method not selected';
