<?php
include ROOT . '/views/layouts/header.php';
?>

    <div class="container">

        </br>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Adminpanel</a></li>
                <li><a href="/admin/task">Task management</a></li>
                <li class="active">Edit the task</li>
            </ol>
        </div>

        <h1 class="text-center">
        </h1>
        <form method="POST" id="id-form_messages" action="/admin/task/update/<?php echo $task['id'] ?>">
            <div class="form-group">
                <label for="name">Name: *</label>
                <input class="form-control" placeholder="Name" name="name" type="text" id="name" value="<?php
                echo $task['name'];
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

                echo $task['email'];

                ?> ">
                <?php if (isset($errors['email'])) { ?>
                    <span class="help-block">
                                        <strong><?php echo $errors['email']; ?></strong>
                                    </span>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="message">Message: *</label>
                <textarea class="form-control" rows="5" placeholder="Текст сообщения" name="message" cols="50"
                          id="message"><?php echo $task['message']; ?></textarea>
                <?php if (isset($errors['message'])) { ?>
                    <span class="help-block">
                                        <strong><?php echo $errors['message']; ?></strong>
                                    </span>
                <?php } ?>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Change">
            </div>
        </form>
    </div>
<?php
include ROOT . '/views/layouts/footer.php';
?>