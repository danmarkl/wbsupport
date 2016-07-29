<?php echo $this->start('title'); ?>
New User
<?php echo $this-> end();?>
<div class="row">
	<div class="col-md-2">
		<button type="button" id="btnSubmit" class="btn btn-sm btn-primary btn-block">Submit</button>
		<button type="reset" id="btnReset" class="btn btn-sm btn-default btn-block">Reset</button>
		<a href="<?php echo $this->Html->Url(array('controller' => 'admin', 'action' => 'user')); ?>" class="btn btn-sm btn-default btn-block">Back To List</a>
	</div>
	<div class="col-md-10">
		<h4>Create New User</h4>
		<br>
		<?php echo $this->Form->create('User', array('role' => 'form', 'id' => 'formAddUser', 'url' => array('controller' => 'user', 'action' => 'add'))); ?>
		<div class="form-group">
			<label for="" class="control-label">Email Address</label>
			<input type="email" name="data[User][EmailAddress]" placeholder="Email Address" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="data[User][Password]" placeholder="Password" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label for="" class="control-label">First Name</label>
			<input type="text" name="data[User][FirstName]" placeholder="First Name" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Last Name</label>
			<input type="text" name="data[User][LastName]" placeholder="Last Name" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Select Role</label>
			<select name="data[User][Role]" class="form-control" id="selectRole">
				<option value="">Select Role</option>
				<?php foreach($roles as $role): ?>
				<option value="<?php echo $role; ?>"><?php echo ucfirst($role); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group" id="teamHolder">
			<label for="" class="control-label">Select Team</label>
			<select name="data[User][TeamId]" class="form-control">
				<option value="">Select Team</option>
				<?php foreach($teams['teams'] as $team): ?>
				<option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<input type="submit" id="submitButton" style="display:none;">
		<input type="reset" id="resetButton" style="display:none;">
		<?php echo $this->Form->end(); ?>
		<div>
			<?php echo $this->Session->flash('reg_message'); ?>
            <?php echo htmlspecialchars_decode($this->Session->flash('auth')); ?>
		</div>
	</div>
</div>
<?php echo $this->start('footerScripts'); ?>
<script>
	$('#btnSubmit').click(function(e){
		$('#submitButton').trigger('click');
	});

	$('#btnReset').click(function(e){
		$('#resetButton').trigger('click');
	});

	$('#teamHolder').hide();

	$('#selectRole').change(function(){
		if($(this).val() == 'client') {
			$('#teamHolder').show();
		} else {
			$('#teamHolder').hide();
		}
	});
</script>
<?php echo $this->end(); ?>