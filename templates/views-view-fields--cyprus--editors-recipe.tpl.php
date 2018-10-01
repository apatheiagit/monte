<?php foreach ($fields as $id => $field): 
    if($id == 'field_main_img') { $image = $field->content; }
    if($id == 'path') { $path = $field->content; }
    if($id == 'title') { $title = $field->content; }
    if($id == 'field_title') { $title = $field->content; }
    if($id == 'body') { $body = $field->content; }
    if($id == 'field_category_recipe') { $category = $field->content; }
    if($id == 'totalcount') { $totalcount = $field->content; }
 endforeach; ?>
 <?php
	$theme_path = path_to_theme();
	global $language_content; 
	$lang = $language_content->language;
	if ($lang == 'en') $prefix = '/en'; else $prefix = '';
 ?>
	<div class="media-block media-block--review media-block--top3places media-block--place">
		<div class="photo"><?php print $image;?></div>
		<div class="container">		
			<div class="text">			
				<div class="category"><span><?php print $category;?></span></div>
				<div class="title"><a href="<?php print $path;?>"><?php print $title?></a></div>			
				<div class="descr"><a href="<?php print $path;?>"><?php print $body;?></a></div>			
				<div class="statistic">			
					<div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
				</div>
			</div>	
		</div>
	</div>
