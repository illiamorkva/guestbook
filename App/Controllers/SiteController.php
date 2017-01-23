<?php
namespace App\Controllers;

use App\Models\Task;
use App\Models\User;

class SiteController
{
    /**
     * Action for main page
     */
    public function actionIndex()
    {
        if (isset($_POST['submit'])) {

            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['message'] = $_POST['message'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors['name'] = 'Неверное имя';
            }
            if (!isset($options['email']) || empty($options['email'])) {
                $errors['email'] = 'Неверный Email';
            }
            if (!isset($options['message']) || empty($options['message'])) {
                $errors['message'] = 'Заполните сообщение';
            }

            if ($errors == false) {
                $id = Task::createTask($options);
                header("Location: /");
            }
        }

        $tasks = Task::getTaskList();

        if (!User::isGuest()) {
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
            $userEmail = $user['email'];
        }

        require_once(ROOT . '/App/Views/site/index.php');
        return true;
    }
}

