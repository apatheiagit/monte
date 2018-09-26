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

<?php foreach ($rows as $id => $row): ?>
  <?php if (($id == 0)):?>
		<div class="col-sm-6 col-md-8 media-wrapper--eight">
			<?php print $row; ?>
		</div>
	<?php else:?>
		<div class="col-sm-6 col-md-4 media-wrapper--four">			
	    <?php print $row; ?>
		</div>
	<?php endif;?>
<?php endforeach; ?>