<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
	<?php if ($id == 0):	?>
	<div class="col-st-6 col-sm-6 col-md-6 media-wrapper--half">
		<?php print $row; ?>
	</div>
    <?php else: ?>
    <div class="col-st-6 col-sm-6 col-md-3 media-wrapper--third">
        <?php print $row; ?>
    </div>
    <?php endif;?>	
<?php endforeach; ?>