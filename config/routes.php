<?php
return array(
     // User:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    // Management tasks:
    'admin/task/create' => 'adminTask/create',
    'admin/task/update/([0-9]+)' => 'adminTask/update/$1',
    'admin/task/delete/([0-9]+)' => 'adminTask/delete/$1',
    'admin/task' => 'adminTask/index',
    // Admin panel:
    'admin' => 'admin/index',
    // Main page
    'index.php' => 'site/index', // actionIndex in SiteController
    '' => 'site/index', // actionIndex in SiteController
);

