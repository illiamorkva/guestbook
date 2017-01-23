<?php
namespace App\Controllers;

use App\Models\User;

class UserController
{
    /**
     * Action for page "Registration"
     */
    public function actionRegister()
    {
        $name = false;
        $email = false;
        $password = false;
        $result = false;

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors['name'] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)) {
                $errors['email'] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors['password'] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)) {
                $errors['email'] = 'Такой email уже используется';
            }

            if ($errors == false) {

                $result = User::register($name, $email, $password);

                $userId = User::checkUserData($email, $password);

                if ($userId == false) {
                    $errors['password'] = 'Неправильные данные для входа на сайт';
                } else {
                    User::auth($userId);
                }
                header("Location: /");
            }
        }

        require_once(ROOT . '/App/Views/user/register.php');
        return true;
    }

    /**
     * Action for page "Login"
     */
    public function actionLogin()
    {
        $email = false;
        $password = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors['email'] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors['password'] = 'Пароль не должен быть короче 6-ти символов';
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors['password'] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);

                header("Location: /");
            }
        }

        require_once(ROOT . '/App/Views/user/login.php');
        return true;
    }

    /**
     * Delete user information from the session
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /");
    }

}