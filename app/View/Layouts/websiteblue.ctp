<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->fetch('title'); ?> - Website Blue Support</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="danmarkl">
	<?php
		echo $this->Html->css(array(
			'metro-bootstrap',
			'jquery.dataTables.min',
			'styles'
		));
	?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php echo $this->fetch('headerScripts'); ?>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo $role=='admin' ? $this->Html->Url(array('controller' => 'admin', 'action' => 'index')) : $this->Html->Url(array('controller' => 'ticket', 'action' => 'index')); ?>"><?php echo $this->Html->image('/app/webroot/img/wblogo-white.png', array('style' => 'margin-top: -8px;')); ?></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<?php if($role=='admin'): ?>
		<ul class="nav navbar-nav">
			<!--<li class="<?php echo $page=='ticket' ? 'active' : ''; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'admin', 'action' => 'index')); ?>">Tickets</a></li>-->
			<li class="<?php echo $page=='user' ? 'active' : ''; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'admin', 'action' => 'user')); ?>">Users</a></li>
		</ul>
		<?php endif; ?>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $user['User']['FirstName']!=null ? $user['User']['FirstName'] : $user['User']['EmailAddress']; ?>! <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'get', $user['User']['Id'])); ?>">Account Settings</a></li>
					<li><a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'logout')); ?>">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
	<div class="container-fluid">
	<?php echo $this->fetch('content'); ?>
	</div>
<?php
	echo $this->Html->script(array(
		'jquery-2.x-git',
		'jquery.dataTables.min',
		'bootstrap.min',
		'scripts'
	));
?>
<?php echo $this->fetch('footerScripts'); ?>
</body>
</html>