<?php

namespace auth_hnauth\business;

class Input implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function getTokenByUri($uri)
    {
        try {
            $token = null;
            $pattern = "/^(.*?)(\/version\/.*\?)(.*)$/";
            if (preg_match($pattern, $uri)) {
                $token = preg_replace($pattern, '$3', $uri);
            }
            return $token;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
