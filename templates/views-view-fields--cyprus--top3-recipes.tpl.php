<?php foreach ($fields as $id => $field): 
    if($id == 'field_main_img') { $image = $field->content; }
    if($id == 'title') { $title = $field->content; }
    if($id == 'body') { $body = $field->content; }  
    if($id == 'field_subtitle') { $subtitle = $field->content; } 
    if($id == 'field_category_recipe') { $city = $field->content; } 
    if($id == 'totalcount') { $totalcount = $field->content; }
 endforeach; ?>
<?php $theme_path = path_to_theme();
	global $language_content; 
	$lang = $language_content->language;
	if ($lang == 'en') $prefix = '/en'; else $prefix = '';
	$term_city = taxonomy_term_load($city);
	$city_name_localize = i18n_taxonomy_localize_terms($term_city);
	$city_name = $city_name_localize->name;?>
<div class="media-block media-block--review media-block--top3places media-block--top3recipes media-block--place">
		<div class="photo"><?php print $image;?></div>
		<div class="container">		
			<div class="text">			
				<div class="category"><a href="<?php print $prefix;?>/recipes?category_recipe=<?php print $city;?>"><?php print $city_name;?></a></div>
				<div class="title-descr">
					<div class="title"><?php print str_replace("/en/en", "/en", $title)?></div>			
					<div class="descr"><?php print str_replace("/en/en", "/en", $body)?></div>
				</div>
				<div class="statistic">			
					<div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
				</div>
			</div>	
		</div>
	</div>