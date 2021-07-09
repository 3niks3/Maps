<?php


namespace App\Models;


use App\Core\Database;

class Users
{

    public static function checkAuth($email, $password)
    {
        $user = Database::getRecord('SELECT * from users where email = ? and password = ?', [$email, $password]);

        if(empty($user)) {
            return ['status' => false, 'user' => []];
        }

        return ['status' => true, 'user' => $user];

    }
}