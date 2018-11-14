<?php

namespace auth_hnauth\business;

use auth_hnauth\business\RegisterUser;

class Logon implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function authentication($uri)
    {
        try {
            global $CFG;
            $token = (new Input())->getTokenByUri($uri);
            if ($data = (new Token())->decode($token)) {
                $this->logon('admin');
                $this->logon((new RegisterUser())->put($data));
            }
            redirect($CFG->wwwroot);
        } catch (\Exception $ex) {
            \core\session\manager::kill_all_sessions();
            throw $ex;
        }
    }

    private function logon($username)
    {
        try {
            global $CFG;
            $auth = false;
            if ($user = get_complete_user_data('username', $username)) {
                if (complete_user_login($user)) {
                    $auth = true;
                }
            }
            if (!$auth) {
                \core\session\manager::kill_all_sessions();
            }
            return $auth;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
