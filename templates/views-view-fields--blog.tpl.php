<?php foreach ($fields as $id => $field): 
    if($id == 'field_main_img') { $image = $field->content; }
    if($id == 'title') { $title = $field->content; }
    if($id == 'path') { $path = $field->content; }
    if($id == 'body') { $body = $field->content; }
    if($id == 'field_section') { $section = $field->content; }
    if($id == 'field_city') { $city = $field->content; }
    if($id == 'field_title') { $title = $field->content; }
    if($id == 'field_subtitle') { $subtitle = $field->content; }
    if($id == 'totalcount') { $totalcount = $field->content; }
    if($id == 'field_special') { $special = $field->content; }
    if($id == 'field_type') { $type = $field->content; }
    if($id == 'field_rubtic') { $rubric = $field->content; }
    if($id == 'field_specproekt') { $specproekt_tid = $field->content; }
 endforeach; ?>
<?php 	
	$theme_path = path_to_theme();
	global $language_content; 
	$lang = $language_content->language;
	if ($lang == 'en') $prefix = '/en'; else $prefix = '';
?>
<div class="media-block media-block--review media-block--review-page media-block--blogs">	
	<div class="photo">		
		<?php print $image;?>
	</div>	
	<div class="category"><?php print t("Personal experience");?></div>		
	<div class="text">				
		<div class="title"><a href="<?php print $path;?>"><?php print $title?></a></div>
		<div class="descr"><a href="<?php print $path;?>"><?php print $body;?></a></div>
	</div>
	<div class="statistic">
		<div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
	</div>
</div>
