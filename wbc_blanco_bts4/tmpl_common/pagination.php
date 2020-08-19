<?php if ($this->params->get('show_pagination', 2) != 0) : ?>

<div class="pagination justify-content-around">
	
	<?php if ($this->params->get('show_pagination_results', 1)) : ?>
	<p class="counter">
		<?php echo $this->pageNav->getPagesCounter(); ?>
	</p>
	<?php endif; ?>
	
	<?php echo $this->pageNav->getPagesLinks(); ?>
	
</div>

<?php endif; ?>
