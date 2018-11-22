<?php

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = "Autenticação (JSON Web Token)";
$string['auth_hnauthdescription'] = "Autenticação com JWT (JSON Web Token)";

$string['settings:credentials'] = "Credenciais";
$string['settings:credentials:description'] = 'Credenciais de acesso a autenticação. URL de acesso {$a->url}';

$string['settings:credentials:publickey'] = "Chave Pública";
$string['settings:credentials:publickey:description'] = 'Chave pública de acesso ao JWT';

$string['settings:credentials:secretkey'] = "Chave Privada";
$string['settings:credentials:secretkey:description'] = 'Chave private de acesso ao JWT';

$string['settings:credentials:password'] = "Password Padrão";
$string['settings:credentials:password:description'] = 'Password padrão para os noves usuários';
