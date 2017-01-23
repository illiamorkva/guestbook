<?php
namespace App\Controllers;
use App\Components\AdminBase;

class AdminController extends AdminBase
{
    /**
     * Action start page "admin Panel"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        require_once(ROOT . '/App/Views/admin/index.php');
        return true;
    }

}

