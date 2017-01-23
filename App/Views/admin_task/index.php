<?php
include ROOT . '/App/Views/layouts/header.php';
?>
    <div class="container">
        </br>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Adminpanel</a></li>
                <li class="active">Task management</li>
            </ol>
        </div>
        <h1 class="text-center">
        </h1>
        <div class="text-right"><b>All messages:</b> <i class="badge"><?php echo count($tasks); ?></i></div>
        <br/>
        <div class="messages">
            <?php if (count($tasks)) { ?>
                <?php foreach ($tasks as $task) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                           <span>
                         <a href="/admin/task/update/<?php echo $task['id'] ?>"><?php echo $task['name'] ?></a>
                        </span>
                                <span class="pull-right label label-info">
                           <?php echo $task['date']; ?>
                        </span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <?php echo $task['message'] ?>
                            <hr/>
                            <div class="pull-right">
                                <a class="btn btn-info" href="/admin/task/update/<?php echo $task['id'] ?>">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a class="btn btn-danger" href="/admin/task/delete/<?php echo $task['id'] ?>">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="text-center">
                    <?php //$tasks->render() ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
include ROOT . '/App/Views/layouts/footer.php';
?>