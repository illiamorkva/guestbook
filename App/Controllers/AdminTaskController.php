<?php
namespace App\Controllers;
use App\Components\AdminBase;
use App\Models\Task;

/**
 * Task management in the admin panel
 */
class AdminTaskController extends AdminBase
{
    /**
     * Action for page "Task Management"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        $tasks = Task::getTaskList();

        require_once(ROOT . '/App/Views/admin_task/index.php');
        return true;
    }


    /**
     * Action for page "Edit task"
     */
    public function actionUpdate($id)
    {
        self::checkAdmin();

        $task = Task::getTaskById($id);

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
                Task::updateTaskById($task, $options);
                header("Location: /admin/task");
            }


        }

        require_once(ROOT . '/App/Views/admin_task/update.php');
        return true;
    }

    /**
     * Action for page "Delete task"
     */
    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Task::deleteTaskById($id);

            header("Location: /admin/task");
        }

        require_once(ROOT . '/App/Views/admin_task/delete.php');
        return true;
    }

}

