<?php

class User
{

    /**
     * User Register
     * @param string $name <p>Name</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Password</p>
     * @return boolean <p>The result of method execution</p>
     */
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) '
            . 'VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Check if a user already exists with the specified $email and $password
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Password</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    /**
     * Remember user
     * @param integer $userId <p>id users</p>
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * Returns the ID of the user if it is authorized.<br/>
     * Otherwise redirects to the login page
     * @return string <p>User ID</p>
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    /**
     * Checks if the user is a guest
     * @return boolean <p>Result</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }


    /**
     * Checks the name: no less than 2 characters
     * @param string $name <p>Name</p>
     * @return boolean <p>Result</p>
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Check the phone: not less than 10 characters
     * @param string $phone <p>Phone</p>
     * @return boolean <p>Result</p>
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Checks the name: no less than 6 characters
     * @param string $password <p>Password</p>
     * @return boolean <p>Result</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Checks email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Result</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Checks whether the email is not occupied by another user
     * @param type $email <p>E-mail</p>
     * @return boolean <p>Result</p>
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Returns user with the specified id
     * @param integer $id <p>id users</p>
     * @return array <p>An array containing information about the user</p>
     */
    public static function getUserById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }


    public static function getUserName()
    {
        $userId = self::checkLogged();
        $user = self::getUserById($userId);

        return $user['name'];
    }


}
