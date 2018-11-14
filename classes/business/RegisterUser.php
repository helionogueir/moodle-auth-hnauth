<?php

namespace auth_hnauth\business;

use stdClass;
use auth_hnauth\Constant;
use auth_hnauth\business\format\Lang;
use auth_hnauth\business\format\Timezone;
use auth_hnauth\business\RegisterRoleAssign;
use auth_hnauth\business\RegisterGroupAssign;

require_once ($CFG->dirroot . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'lib.php');

class RegisterUser implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function put(stdClass $data)
    {
        try {
            $username = null;
            if (!empty($data->user) && ($data->user instanceof stdClass) && !empty($data->user->username)) {
                $secretkey = get_config('auth_hnauth', 'secretkey');
                $row = Array(
                    "id" => 0,
                    "auth" => Constant::PLUGIN_TAG_NAME,
                    "deleted" => 0,
                    "confirmed" => 1,
                    "mnethostid" => 1,
                    "username" => "",
                    "password" => md5($secretkey),
                    "idnumber" => "",
                    "firstname" => "",
                    "lastname" => "",
                    "email" => "",
                    "icq" => "",
                    "skype" => "",
                    "yahoo" => "",
                    "aim" => "",
                    "msn" => "",
                    "phone1" => "",
                    "phone2" => "",
                    "institution" => "",
                    "department" => "",
                    "address" => "",
                    "city" => "",
                    "country" => "",
                    "lang" => "",
                    "timezone" => ""
                );
                $this->matchValues($row, $data->user);
                $this->matchValuesExists($row, $data->user->username);
                $row['lang'] = (new Lang())->format($row['lang']);
                $row['timezone'] = (new Timezone())->format($row['timezone']);
                if (!empty($row['id'])) {
                    user_update_user($row, false, false);
                } else {
                    user_create_user($row);
                }
                $username = $row["username"];
            }
            (new RegisterGroupAssign())->put($data);
            (new RegisterRoleAssign())->put($data);
            return $username;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private function matchValues(Array &$user, stdClass $data)
    {
        $ignore = Array('id', 'auth', 'password', 'confirmed', 'mnethostid');
        foreach ($data as $key => $value) {
            if (!in_array($key, $ignore) && isset($user[$key])) {
                $user[$key] = $value;
            }
        }
    }

    private function matchValuesExists(Array &$user, $username)
    {
        global $DB;
        if ($userObject = $DB->get_record('user', array('username' => $username))) {
            $user['id'] = $userObject->id;
            $this->matchValues($user, $userObject);
        }
    }

}
