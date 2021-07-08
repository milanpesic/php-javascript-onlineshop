<?php

if(Cookie::has('cookie_token') && !Session::has('user')) {

    $cookie_token = Cookie::get('cookie_token');

    $cookie_token_check = DB::find('user_session', ['cookie_token' => $cookie_token]);

        if($cookie_token_check) {

            $user_id = $cookie_token_check->user_id;

            $user = DB::find('users', ['id' => $user_id]);

            Session::put('user', $user);

        }

}