<?php

require_once (dirname(dirname(dirname(dirname(dirname(__FILE__))))) . DIRECTORY_SEPARATOR . 'config.php');

try {
    (new \auth_hnauth\controller\Request())->all($ME);
} catch (\Exception $ex) {
    //continue
}