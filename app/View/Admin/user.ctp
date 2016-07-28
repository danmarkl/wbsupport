<?php echo $this->start('title'); ?>
Users
<?php echo $this->end(); ?>
<div class="row">
	<div class="col-md-2">
		<?php echo $this->Form->create('User', array('role' => 'form', 'url' => array('controller' => 'admin', 'action' => 'user'))); ?>
			<div class="form-group">
			    <label>Search:</label>
		  	</div>
			<div class="form-group">
			    <input type="text" class="form-control input-sm" placeholder="Email Address" name="data[email]" value="<?php echo $search['email']; ?>">
		  	</div>
		  	<div class="form-group">
			    <input type="text" class="form-control input-sm" placeholder="Name" name="data[name]" value="<?php echo $search['name']; ?>">
		  	</div>
		  	<div class="form-group">
			    <select class="form-control input-sm" name="data[role]">
			    	<option value="">Select Role</option>
			    	<?php foreach($roles as $role): ?>
			    	<option <?php echo $search['role']==$role ? 'selected="selected"' : ''; ?> value="<?php echo $role; ?>"><?php echo ucfirst($role); ?></option>
			    	<?php endforeach; ?>
			    </select>
		  	</div>
		  	<div class="form-group">
			    <select class="form-control input-sm" name="data[team]">
			    	<option value="">Select Team</option>
			    	<?php foreach($teams['teams'] as $team): ?>
			    	<option <?php echo $search['team']==$team['id'] ? 'selected="selected"' : ''; ?> value="<?php echo $team['id']; ?>"><?php echo ucwords($team['name']); ?></option>
			    	<?php endforeach; ?>
			    </select>
		  	</div>
		  	<button type="submit" class="btn btn-primary btn-block btn-sm">Search</button>
		  	<a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'add')); ?>" class="btn btn-default btn-block btn-sm">New User</a>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-10">
		<br>
		<div class="table-responsive">
			<table class="table table-condensed" id="dataTable">
				<thead>
					<tr>
						<th>Email Address</th>
						<th>Name</th>
						<th>Role</th>
						<th>Team</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($users as $user): ?>
					<tr>
						<td><?php echo strtolower($user['User']['EmailAddress']); ?></td>
						<td><?php echo ucwords($user['User']['FirstName'].' '.$user['User']['LastName']); ?></td>
						<td><?php echo ucfirst($user['User']['Role']); ?></td>
						<td><?php echo ucfirst($user['Team']['Name']); ?></td>
						<td>
							<a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'edit', $user['User']['Id'])); ?>" class="btn btn-sm btn-default">edit</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<ul class="pagination pull-right">
		<?php
			echo '<li>'.$this->Paginator->prev('< ', array('tag'=>'li', 'class'=>'prev'),null, array('tag'=>'a', 'class' => '')).'</li>';
			echo '<li>'.$this->Paginator->numbers(array('tag'=>'li', 'separator'=>' | ', 'class'=>'', 'modulus'=>4)).'</li>';
			echo '<li>'.$this->Paginator->next(" > ", array('tag'=>'li', 'class'=>'next'),null, array('tag'=>'a', 'class' => '')).'</li>';
		?>
		</ul>
	</div>
</div>
<?php echo $this->start('footerScripts'); ?>
<script>
	jQuery('#dataTable').dataTable({
		paging: false,
		searching: false,
		info: false
	});
</script>
<?php echo $this->end(); ?>