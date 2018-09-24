<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>	
		<div class="media-wrapper--large media-wrapper--event" id="event_<?php print $id;?>" data-id="<?php print $id;?>">
			<?php print $row; ?>
		</div>			
<?php endforeach; ?>