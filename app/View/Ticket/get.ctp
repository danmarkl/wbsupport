<div class="row">
	<div class="col-md-2">
		<!--
		<button type="button" class="btn btn-default btn-block btn-sm">New Ticket</button>
		<button type="button" class="btn btn-default btn-block btn-sm">Reply</button>
		-->
		<a href="<?php echo $this->Html->Url(array('controller' => 'ticket', 'action' => 'index')); ?>" class="btn btn-default btn-block btn-sm">Go Back</a>
	</div>
	<div class="col-md-8">
		<div>
			<h4><?php echo $ticket['ticket']['subject']; ?></h4>
			<?php echo empty($ticket['ticket']['content']) ? "No Content." : $this->SB->parseImages($ticket['ticket']['content']); ?>
		</div>
		<br>
		<h4>Replies (<?php echo count($replies['replies']); ?>)</h4>
		<?php foreach($replies['replies'] as $reply): ?>
		<div class="well well-sm">
			<div class="pull-left">
				<?php echo $reply['summary']; ?> - <?php echo $reply['replier']['name']; ?>
			</div>
			<div class="pull-right">
				<button type="button" rel="getreply" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" data-href="<?php echo $this->Html->Url(array('controller' => 'reply', 'action' => 'get', $ticket['ticket']['id'], $reply['id'])); ?>">Open</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="col-md-2">
		<h5>Other Tickets</h5>
		<div>
			<?php if(!empty($tickets['tickets'])): ?>
			<ul class="wb-other-tix">
				<?php foreach($tickets['tickets'] as $tix): ?>
				<?php if($ticket['ticket']['id'] !== $tix['id']): ?>
				<li>
					<a href="<?php echo $this->Html->Url(array('controller' => 'ticket', 'action' => 'get', $tix['id'])); ?>">
					<?php echo $this->Text->truncate($tix['subject'], 30, array('ellipsis' => '...', 'exact' => false)); ?> - <span><?php echo date('M Y', strtotime($tix['last_activity_at'])); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<label>No tickets available.</label>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="contentTitle"></h4>
	      	</div>
			<div class="modal-body" id="contentBody"></div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
		</div>
	</div>
</div>
<?php echo $this->start('footerScripts'); ?>
<script>
	$(document).ready(function(){
		$('button[rel=getreply]').click(function(e){
			$(this).getReply($(this).attr('data-href'), 'contentBody');
		});
	});
</script>
<?php echo $this->end(); ?>