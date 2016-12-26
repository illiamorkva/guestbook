<?php

/**
 * Abstract class AdminBase contains general logic controllers, which
 * used in the admin panel
 */
abstract class AdminBase
{
    /**
     * The method that checks the user of the fact whether it is the administrator
     * @return boolean
     */
    public static function checkAdmin()
    {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        if ($user['role'] == 'admin') {
            return true;
        }

        die('Access denied');
    }

}

