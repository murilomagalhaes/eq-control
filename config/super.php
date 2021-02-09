<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default super user
    |--------------------------------------------------------------------------
    |
    | Default super user will be created at project installation/deployment
    |
    */

    'super_nome' => env('SU_NOME', ''),
    'super_login' => env('SU_LOGIN', ''),
    'super_pwd' => env('SU_PWD', '')

];