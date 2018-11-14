<?php

namespace auth_hnauth\business;

require_once ($CFG->dirroot . DIRECTORY_SEPARATOR . 'group' . DIRECTORY_SEPARATOR . 'lib.php');

use stdClass;
use auth_hnauth\business\RegisterGroup;

class RegisterGroupAssign implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function put(stdClass $data)
    {
        try {
            global $DB;
            if (!empty($data->user) && !empty($data->user->username) && !empty($data->groups) && is_array($data->groups)) {
                if ($user = $DB->get_record('user', array('username' => $data->user->username))) {
                    foreach ($data->groups as $group) {
                        if (!empty($group->idnumber) && !empty($group->name)) {
                            if ($groupid = (new RegisterGroup())->put($group->idnumber, $group->name)) {
                                groups_add_member($groupid, $user->id);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
