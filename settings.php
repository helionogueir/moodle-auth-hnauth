<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // Credentials
    $settings->add(new admin_setting_heading(
            'auth_hnauth/general'
            , (new \lang_string('settings:credentials', 'auth_hnauth'))
            , (new \lang_string('settings:credentials:description', 'auth_hnauth', Array('url' => "{$CFG->wwwroot}/auth/hnauth/version/18.11.09/?:token")))
    ));
    $settings->add(new admin_setting_configtext(
            'auth_hnauth/publickey'
            , (new lang_string('settings:credentials:publickey', 'auth_hnauth'))
            , (new lang_string('settings:credentials:publickey:description', 'auth_hnauth'))
            , ''
            , PARAM_TEXT
            , 80
    ));
    $settings->add(new admin_setting_configtext(
            'auth_hnauth/secretkey'
            , (new lang_string('settings:credentials:secretkey', 'auth_hnauth'))
            , (new lang_string('settings:credentials:secretkey:description', 'auth_hnauth'))
            , ''
            , PARAM_TEXT
            , 80
    ));
}