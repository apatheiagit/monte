<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php $i = 0;?>
<?php foreach ($rows as  $row): ?>
	<?php
	$md = 8; $class_name = 'eight';
	switch ($i) {
    case 0:
        $md = 8; $class_name = 'eight'; break;
    case 1:
        $md = 4; $class_name = 'four'; break;
    case 2:
        $md = 5; $class_name = 'five'; break;
    case 3:
        $md = 7; $class_name = 'seven'; break;
	} 
    $i++;
	?>
	<div class="col-sm-6 col-md-<?php print $md;?> media-wrapper--<?php print $class_name;?>">
		<?php print $row; ?>
	</div>	
<?php endforeach; ?>