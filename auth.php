<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/authlib.php');

class auth_plugin_hnauth extends auth_plugin_base
{

    public function __construct()
    {
        $this->authtype = auth_hnauth\Constant::PLUGIN_TAG_NAME;
    }

    public function can_be_manually_set()
    {
        return true;
    }

}
