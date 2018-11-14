<?php

namespace auth_hnauth\business;

require_once($CFG->dirroot . '/' . $CFG->admin . '/roles/lib.php');

use stdClass;
use context_course;
use auth_hnauth\Constant;

class RegisterRoleAssign implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function put(stdClass $data)
    {
        try {
            global $DB;
            if (!empty($data->user) && !empty($data->user->username) && !empty($data->roles) && is_array($data->roles)) {
                if ($user = $DB->get_record('user', array('username' => $data->user->username))) {
                    if ($context = context_course::instance(Constant::COURSE_HOME)) {
                        $this->assign($data->roles, $user, $context);
                    }
                }
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private function assign(Array $roles, stdClass $userid, context_course $contextid)
    {
        try {
            global $DB;
            foreach ($roles as $role) {
                if ($roleid = $DB->get_field('role', 'id', array('shortname' => $role))) {
                    role_assign($roleid, $userid->id, $contextid->id);
                }
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
