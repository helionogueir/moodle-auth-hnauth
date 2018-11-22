<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . DIRECTORY_SEPARATOR . 'config.php');

try {
    if (!empty($_SERVER['REQUEST_URI'])) {
        (new \auth_hnauth\controller\Request())->all($_SERVER['REQUEST_URI']);
    } else {
        redirect($CFG->wwwroot);
    }
} catch (\Exception $ex) {
    redirect($CFG->wwwroot);
    //continue
}