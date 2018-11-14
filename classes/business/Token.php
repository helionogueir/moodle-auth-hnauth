<?php

namespace auth_hnauth\business;

use auth_hnauth\business\JWT;

class Token implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function decode($token)
    {
        try {
            $data = null;
            $publickey = get_config('auth_hnauth', 'publickey');
            $secretkey = get_config('auth_hnauth', 'secretkey');
            if (!empty($token) && !empty($publickey) && !empty($secretkey)) {
                $decoded = JWT::decode($token, $secretkey, array('HS256'));
                if (!empty($decoded->publicOrAccessKey) && ($publickey == $decoded->publicOrAccessKey)) {
                    if (!empty($decoded->data)) {
                        $data = $decoded->data;
                    }
                }
            }
            return $data;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
