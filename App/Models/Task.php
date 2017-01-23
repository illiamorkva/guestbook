<?php
namespace App\Models;

use App\Components\ActiveRecord;
use App\Components\Db;

/**
 * Class Task - model for working with tasks
 */
class Task extends ActiveRecord
{
    protected static $tableName = 'tasks';
    protected static $tableFields = ["id" => "id",
        "name" => "name",
        "email" => "email",
        "message" => "message",
        "date" => "date",
    ];
    /**
     * Returns the task with the specified id
     * @param integer $id <p>id task</p>
     * @return array <p>Array with information about task</p>
     */
    public static function getTaskById($id)
    {
        return self::getByID($id);
    }


    /**
     * Return list of tasks
     * @return array <p>Array of tasks</p>
     */
    public static function getTaskList()
    {
        return self::getAll("ORDER BY id DESC");
    }

    /**
     * Delete the task with the specified id
     * @param integer $id <p>id task</p>
     * @return boolean <p>The result of method execution</p>
     */
    public static function deleteTaskById($id)
    {
       return self::delete($id);

    }

    /**
     * Edit task with the given id
     * @param object $id <p>task</p>
     * @param array $options <p>Array with information about the task</p>
     * @return boolean <p>The result of method execution</p>
     */
    public static function updateTaskById($task, $options)
    {
        $task->name = $options['name'];
        $task->email = $options['email'];
        $task->message = $options['message'];
        return $task->update();
    }

    /**
     * Add new task
     * @param array $options <p>Array with information about the task</p>
     * @return integer <p>id added to the entries table</p>
     */
    public static function createTask($options)
    {
        $task = new Task();
        $task->name = $options['name'];
        $task->email = $options['email'];
        $task->message = $options['message'];
        $task->date = date("Y-m-d H:i:s");
        $task->insert();
        return $task->id ?? 0;
    }
}