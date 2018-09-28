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
  <?php if (($id == 0) || ($id == 9)):?>
		<div class="col-md-12 media-wrapper--full">
			<?php print $row; ?>
		</div>
	<?php else:?>
		<div class="col-sm-4 col-md-4 media-wrapper--small">			
	    <?php print $row; ?>
		</div>
	<?php endif;?>
<?php endforeach; ?>
</div>