<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Website Blue Support</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="danmarkl">
	<?php
		echo $this->Html->css(array(
			'metro-bootstrap'
		));
	?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style type="text/css">
		body{margin-top:20px;}
		.box-logo{margin-bottom: 20px;}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="text-center box-logo"><?php echo $this->Html->image('/app/webroot/img/wblogo-blue.jpg'); ?></div>
				<?php echo $this->Form->create('User', array('role' => 'form', 'url' => array('controller' => 'user', 'action' => 'login'))); ?>
					<div class="panel panel-primary">
						<div class="panel-heading">Account Login</div>
						<div class="panel-body">
							<div class="form-group">
								<input type="email" name="data[User][EmailAddress]" placeholder="Email Address" class="form-control" required="required">
							</div>
							<div class="form-group">
								<input type="password" name="data[User][Password]" placeholder="Password" class="form-control" required="required">
							</div>
						</div>
						<div class="panel-footer">
							<input type="submit" value="Login" class="btn btn-sm btn-primary btn-block">
							<!--<a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'register')); ?>" class="btn btn-sm btn-default btn-block">New User? Please Register Here!</a>-->
						</div>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
                <?php echo $this->Session->flash('login_message'); ?>
                <?php echo htmlspecialchars_decode($this->Session->flash('auth')); ?>
            </div>
		</div>
	</div>
<?php
	echo $this->Html->script(array(
		'jquery-2.x-git',
		'bootstrap.min'
	));
?>
</body>
</html>