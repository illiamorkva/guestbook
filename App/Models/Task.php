<?php
namespace App\Models;

use App\Components\Db;

/**
 * Class Task - model for working with tasks
 */
class Task
{
    /**
     * Returns the task with the specified id
     * @param integer $id <p>id task</p>
     * @return array <p>Array with information about task</p>
     */
    public static function getTaskById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM tasks WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        $result->setFetchMode(\PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }


    /**
     * Return list of tasks
     * @return array <p>Array of tasks</p>
     */
    public static function getTaskList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, email, message, date FROM tasks ORDER BY id DESC');
        $tasksList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tasksList[$i]['id'] = $row['id'];
            $tasksList[$i]['name'] = $row['name'];
            $tasksList[$i]['email'] = $row['email'];
            $tasksList[$i]['message'] = $row['message'];
            $tasksList[$i]['date'] = $row['date'];
            $i++;
        }
        return $tasksList;
    }

    /**
     * Delete the task with the specified id
     * @param integer $id <p>id task</p>
     * @return boolean <p>The result of method execution</p>
     */
    public static function deleteTaskById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM tasks WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Edit task with the given id
     * @param integer $id <p>id task</p>
     * @param array $options <p>Array with information about the task</p>
     * @return boolean <p>The result of method execution</p>
     */
    public static function updateTaskById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE tasks
            SET 
                name = :name, 
                email = :email, 
                message = :message
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], \PDO::PARAM_STR);
        $result->bindParam(':message', $options['message'], \PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Add new task
     * @param array $options <p>Array with information about the task</p>
     * @return integer <p>id added to the entries table</p>
     */
    public static function createTask($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO tasks '
            . '(name, email, message, date)'
            . 'VALUES '
            . '(:name, :email, :message, NOW())';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], \PDO::PARAM_STR);
        $result->bindParam(':message', $options['message'], \PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
}