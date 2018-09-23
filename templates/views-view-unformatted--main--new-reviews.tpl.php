<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
	<?php
	$md = 8; $class_name = 'eight';
	switch ($id) {
    case 0:
        $md = 8; $class_name = 'eight'; break;
    case 1:
        $md = 4; $class_name = 'four'; break;
    case 2:
        $md = 5; $class_name = 'five'; break;
    case 3:
        $md = 7; $class_name = 'seven'; break;
	} 
	?>
	<div class="col-sm-6 col-md-<?php print $md;?> media-wrapper--<?php print $class_name;?>">
		<?php print $row; ?>
	</div>	
<?php endforeach; ?>