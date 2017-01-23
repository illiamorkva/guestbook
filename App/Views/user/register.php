<?php
include ROOT . '/App/Views/layouts/header.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Register
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="/user/register">

						<div class="form-group<?php isset($errors['name']) ? ' has-error' : '' ?>">
							<label class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="<?= (isset($_POST['name'])) ? trim($_POST['name']) : '' ?>">

								<?php if(isset($errors['name'])) {?>
								<span class="help-block"> <strong><?php echo $errors['name']; ?></strong> </span>
								<?php } ?>
							</div>
						</div>

						<div class="form-group<?php isset($errors['email']) ? ' has-error' : '' ?>">
							<label class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="<?= (isset($_POST['email'])) ? trim($_POST['email']) : '' ?>">

								<?php if(isset($errors['email'])) {?>
								<span class="help-block"> <strong><?php echo $errors['email']; ?></strong> </span>
								<?php } ?>
							</div>
						</div>

						<div class="form-group<?php isset($errors['password']) ? ' has-error' : '' ?>">
							<label class="col-md-4 control-label">Password</label>

							<div class="col-md-6">
								<input type="password" class="form-control" name="password">

								<?php if(isset($errors['password'])) {?>
								<span class="help-block"> <strong><?php echo $errors['password']; ?></strong> </span>
								<?php } ?>
							</div>
						</div>

						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" name="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-user"></i>Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include ROOT . '/App/Views/layouts/footer.php';
?>