<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="row">
<?php foreach ($rows as $id => $row): ?>
  <?php if (($id == 0)):?>
		<div class="col-md-12 media-wrapper--full">
			<?php print $row; ?>
		</div>
	<?php elseif($id == 1):?>
		<div class="col-st-6 col-sm-6 col-md-6 media-wrapper--half">			
	    <?php print $row; ?>
		</div>
	<?php else:?>
		<div class="col-st-6 col-sm-6 col-md-3 media-wrapper--third">			
	    <?php print $row; ?>
		</div>
	<?php endif;?>
<?php endforeach; ?>
</div>