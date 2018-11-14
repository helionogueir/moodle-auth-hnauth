<?php

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2018110914.00;
$plugin->requires = 2015111610.00;
$plugin->component = 'auth_hnauth';
$plugin->dependencies = array(
    'auth_manual' => 2016120500
);
