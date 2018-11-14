<?php

namespace auth_hnauth\business\format;

use core_user;
use auth_hnauth\business\Business;

class Lang implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function format($lang)
    {
        $value = core_user::get_property_default('lang');
        try {
            $pattern = "/^(\w{2})(\_|\-)(\w{2})$/";
            if (preg_match($pattern, $lang)) {
                $value = preg_replace($pattern, '$1_$3', $lang);
            }
        } catch (Exception $ex) {
            //continue
        }
        return strtolower($value);
    }

}
