<?php

namespace auth_hnauth\business;

require_once ($CFG->dirroot . DIRECTORY_SEPARATOR . 'group' . DIRECTORY_SEPARATOR . 'lib.php');

use stdClass;
use auth_hnauth\Constant;

class RegisterGroup implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function put($idnumber, $name)
    {
        $id = 0;
        try {
            global $DB;
            if (!empty($idnumber) && !empty($name)) {
                if ($groupid = $DB->get_field('groups', 'id', array('idnumber' => $idnumber))) {
                    $id = $groupid;
                } else {
                    $row = new stdClass();
                    $row->courseid = Constant::COURSE_HOME;
                    $row->idnumber = $idnumber;
                    $row->name = $name;
                    $id = groups_create_group($row);
                }
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $id;
    }

}
