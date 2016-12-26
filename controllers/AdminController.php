<?php

class AdminController extends AdminBase
{
    /**
     * Action start page "admin Panel"
     */
    public function actionIndex()
    {
        self::checkAdmin();

        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}

