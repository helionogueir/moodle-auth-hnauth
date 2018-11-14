<?php

namespace auth_hnauth\business\format;

use auth_hnauth\business\Business;

class Timezone implements Business
{

    public function __construct()
    {
        return $this;
    }

    public function format($timezone)
    {
        $value = "";
        try {
            if (in_array($timezone, timezone_identifiers_list())) {
                $value = $timezone;
            }
        } catch (Exception $ex) {
            //continue
        }
        return $value;
    }

}
