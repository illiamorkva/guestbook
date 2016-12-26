<?php
include ROOT . '/views/layouts/header.php';
?>

    <div class="container">
        <h1 class="text-center">
        </h1>
        <form method="POST" id="id-form_messages" action="/">
            <div class="form-group">
                <label for="name">Name: *</label>
                <input class="form-control" placeholder="Name" name="name" type="text" id="name" value="<?php
                $name = '';
                if (isset($userName)) {
                    $name = $userName;
                }
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                }
                echo $name;
                ?>">
                <?php if (isset($errors['name'])) { ?>
                    <span class="help-block">
                                        <strong><?php echo $errors['name']; ?></strong>
                                    </span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input class="form-control" placeholder="E-mail" name="email" type="email" id="email" value="<?php
                $email = '';
                if (isset($userEmail)) {
                    $email = $userEmail;
                }
                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                }
                echo $email;


                ?> ">
                <?php if (isset($errors['email'])) { ?>
                    <span class="help-block">
                                        <strong><?php echo $errors['email']; ?></strong>
                                    </span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="message">Message: *</label>
                <textarea class="form-control" rows="5" placeholder="Message" name="message" cols="50"
                          id="message"><?php if (isset($_POST['message'])) echo $_POST['message']; ?></textarea>
                <?php if (isset($errors['message'])) { ?>
                    <span class="help-block">
                                        <strong><?php echo $errors['message']; ?></strong>
                                    </span>
                <?php } ?>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add">
            </div>
        </form>
        <div class="text-right"><b>All messages:</b> <i class="badge"><?php echo count($tasks); ?></i></div>
        <br/>
        <div class="messages">
            <?php if (count($tasks)) { ?>
                <?php foreach ($tasks as $task) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">

                        <span>
                         
                                        <a href="task/<?php echo $task['id'] ?>/edit"><?php echo $task['name'] ?></a>
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
                                <a class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <button class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
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
include ROOT . '/views/layouts/footer.php';
?>