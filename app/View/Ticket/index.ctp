<?php echo $this->start('title'); ?>
Tickets
<?php echo $this->end(); ?>
<div class="row">
	<div class="col-md-2" class="white-box">
		<?php echo $this->Form->create('Ticket', array('role' => 'form')); ?>
			<div class="form-group">
			    <label><i class="fa fa-fw fa-search"></i> Search:</label>
		  	</div>
			<div class="form-group">
			    <input type="text" class="form-control input-sm" placeholder="Ticket ID" name="data[ticketid]" value="<?php echo $search['ticketid']; ?>">
		  	</div>
		  	<!--
		  	<div class="form-group">
			    <input type="text" class="form-control input-sm" placeholder="Subject" name="subject">
		  	</div>
		  	-->
		  	<div class="form-group">
			    <select class="form-control input-sm" name="data[label]">
			    	<option <?php echo ""==$search['label'] ? 'selected' : ''; ?> value="">Show All</option>
			    	<option <?php echo "unanswered"==$search['label'] ? 'selected' : ''; ?> value="unanswered">Unanswered</option>
			    	<option <?php echo "answered"==$search['label'] ? 'selected' : ''; ?> value="answered">Answered</option>
			    </select>
		  	</div>
            <button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-fw fa-search"></i> Search</button>
		  	<!--<button type="button" class="btn btn-default btn-block btn-sm">New Ticket</button>-->
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-10">
		<h4>Tickets assigned to My Team: <b><?php echo $team[0]['Team']['Name']; ?></b></h4>
		<br>
		<div class="table-responsive">
			<table class="table table-condensed table-hover" id="dataTable">
				<thead>
				<tr>
					<th>Ticket ID</th>
					<th>Subject</th>
					<th>Label</th>
					<th>Activity Date</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($tickets['tickets'] as $ticket): ?>
				<?php if($search['ticketid']!=null): ?>
				<?php if($ticket['id']==$this->request->data['ticketid']): ?>
				<tr>
					<td><a href="<?php echo $this->Html->Url(array('controller' => 'ticket', 'action' => 'get', $ticket['id'])); ?>"><?php echo $ticket['id']; ?></a></td>
					<td><?php echo $ticket['subject']; ?></td>
					<td>
						<?php if($ticket['unanswered']): ?>
							Unanswered
						<?php else: ?>
							Answered
						<?php endif; ?>
					</td>
					<td><?php echo date('M d, Y', strtotime($ticket['last_activity_at'])); ?></td>
				</tr>
				<?php endif; ?>
				<?php else: ?>
				<tr>
					<td><a href="<?php echo $this->Html->Url(array('controller' => 'ticket', 'action' => 'get', $ticket['id'])); ?>"><?php echo $ticket['id']; ?></a></td>
					<td><?php echo $ticket['subject']; ?></td>
					<td>
						<?php if($ticket['unanswered']): ?>
							Unanswered
						<?php else: ?>
							Answered
						<?php endif; ?>
					</td>
					<td><?php echo date('M d, Y', strtotime($ticket['last_activity_at'])); ?></td>
				</tr>
				<?php endif; ?>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php
			$total = $tickets['total'];
			$currentpage = $tickets['current_page'];
			$perPage = $tickets['per_page'];
			$totalPages = $tickets['total_pages'];
		?>
		<ul class="pagination pull-right">
			<li><a href="#">&laquo;</a></li>
			<?php for($i=1;$i<=$totalPages;$i++): ?>
			<li><a href="<?php echo $this->Html->Url(array('controller' => 'ticket', 'action' => 'index', $i)); ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
			<li><a href="#">&raquo;</a></li>
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