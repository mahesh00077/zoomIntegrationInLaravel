<?php

use Illuminate\Support\Facades\DB;


function roleName($id)
{
    // $q = array();
    $users = DB::table('role')
        ->select('role_name')
        ->where('id', $id)
        ->get();
    // dd($users);
    return $users[0]->role_name;
}
function getRoleID($uid)
{
    // $q = array();
    $users = DB::table('users')
        ->select('role')
        ->where('id', $uid)
        ->get();
    // dd($users);
    return $users[0]->role;
}

function generate_signature($api_key, $api_secret, $meeting_number, $role)
{

    $time = time() * 1000 - 30000; //time in milliseconds (or close enough)

    $data = base64_encode($api_key . $meeting_number . $time . $role);

    $hash = hash_hmac('sha256', $data, $api_secret, true);

    $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);

    //return signature, url safe base64 encoded
    return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
}