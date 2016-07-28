<div>
	<h4><?php echo $reply['reply']['replier']['name']; ?></h4>
	<?php $this->SB->parseImages($reply['reply']['content']); ?>
</div>