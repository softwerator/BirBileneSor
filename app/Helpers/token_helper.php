<?php

function get_new_token(){
    do{
        $token = md5(uniqid(null,true));
    }
    while(\App\User::where('login_token',$token)->first() != null);

    return $token;
}
