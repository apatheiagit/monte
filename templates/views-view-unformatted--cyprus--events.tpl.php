<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
	<div class="clearfix"></div>
	<div class="col-sm-12"><h3 class="index-head"><?php print $title; ?></h3></div>
  
<?php endif; ?>

<?php foreach ($rows as $id => $row): ?>
  <?php if (($id == 0) || ($id == 9)):?>
		<div class="col-sm-4 col-md-6 media-wrapper--half">
			<?php print $row; ?>
		</div>
	<?php else:?>
		<div class="col-sm-4 col-md-3 media-wrapper--third">			
	    <?php print $row; ?>
		</div>
	<?php endif;?>
<?php endforeach; ?>