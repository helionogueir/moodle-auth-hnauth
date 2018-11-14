<?php

namespace auth_hnauth\controller;

use auth_hnauth\business\Logon;

class Request implements Controller
{

    public function __construct()
    {
        return $this;
    }

    public function all($uri)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: GET, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type');
                header('Content-Type: text/plain');
                header('Content-Length: 0');
                break;
            case 'GET':
                $response = (new Logon())->authentication($uri);
                $this->header();
                header('Access-Control-Allow-Origin: *');
                header('Content-Type: application/json');
                header('Content-Length: ' . strlen($response));
                echo $response;
                break;
        }
    }

    private function header()
    {
        
    }

}
