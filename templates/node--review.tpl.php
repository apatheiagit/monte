<?php    
    $theme_path = path_to_theme();
    global $language_content; 
    $lang = $language_content->language;
    if ($lang == 'en') $prefix = '/en'; else $prefix = '';
    $term_city = taxonomy_term_load($content['field_city']['#items'][0]['taxonomy_term']->tid);
    $translated_term_city = i18n_taxonomy_localize_terms($term_city); 
    function print_gallery($photo_array, $image_style, $p_title){
      $gallery = '<div class="somit somit-gallery">';
      $gallery .= '<div class="photo-carousel">';
      foreach ($photo_array as $key => $photo) {
        $gallery .= '<div class="photo-item">';
        $photo_title = $photo['title'] == null ? $p_title : $photo['title'];
        $param = array(
          'style_name' => 'cyprus1140x720',
          'path' => $photo['uri'],
          'getsize' => FALSE,
        );
        $gallery .= theme('image_style', $param);
        $gallery .= '<div class="descr"><div>'.$photo_title.'</div></div>';
        $gallery .= '</div>';
      }
      $gallery .= '</div>';
      $gallery .= '<div class="photo-controls-wrapper"><div class="photo-controls"><div class="customBtn customPrevBtn"></div><div class="owl-counter">';  
      $gallery .= ' <span class="current-photo">1</span> \\ '.count($photo_array).'</div> <div class="customBtn customNextBtn"></div></div></div>';
      $gallery .= '</div>';
      print $gallery;
    }   
?>
<?php 
  $totalcount = isset($content['links']['statistics']['#links']['statistics_counter']['title']) ? (int) $content['links']['statistics']['#links']['statistics_counter']['title'] : 10;
  $type = $content['field_type']['#items']['0']['value']; 
  $special = $content['field_special']['#items']['0']['value']; 
  $city = $content['field_city']['#items']['0']['taxonomy_term']->tid; 
  $term_city = taxonomy_term_load($city);  $city_name_localize = i18n_taxonomy_localize_terms($term_city);
  $city_name = $city_name_localize->name;
  $section = $content['field_section']['#items']['0']['taxonomy_term']->tid; 
  $terms = taxonomy_term_load($section); $english = $terms->field_english['und'][0]['value']; 
  $russian_name_localize = i18n_taxonomy_localize_terms($terms); $russian = $russian_name_localize->name;
?>
<div class="media-detail media-detail--<?php print $type;?>">

<div class="media-detail--main-photo">
  <div class="photo" id="mainPhoto">
    <?php
      $params = array(
        'style_name' => 'cyprus1920x800',
        'path' => $content['field_main_img']['#items']['0']['uri'],
        'alt' => $title,
        'title' => $title,
        'attributes' => array('class' => array('img-responsive')),
        'getsize' => FALSE,
      );?>    
    <?php  print theme('image_style', $params); ?>
  </div>
  <div class="container">
    <div class="text">    
      <?php if($type != 'top5'):?>
      <div class="category">
       <?php if(isset($content['field_specproekt'])):?>
          <?php $term_specproekt = taxonomy_term_load($content['field_specproekt']['#items'][0]['taxonomy_term']->tid); $translated_term_specproekt = i18n_taxonomy_localize_terms($term_specproekt); ?>
          <a href="<?php print $prefix;?>/special/<?php print $content['field_specproekt']['#items'][0]['taxonomy_term']->tid;?>"><?php print $translated_term_specproekt->name;?></a>
        <?php elseif($type == 'photo'):?>
          <a href="<?php print $prefix;?>/photoreviews"><?php print t("Picture story");?></a>
        <?php elseif($type == 'lifehack'):?>
          <a href="<?php print $prefix;?>/lifehack"><?php print t("Life hack");?></a>
        <?php elseif($type == 'blog'):?>
          <a href="<?php print $prefix;?>/blog"><?php print t("Personal experience");?></a>
        <?php elseif(isset($city)):?>
          <a href="<?php print $prefix;?>/reviews/<?php print $city;?>"><?php print $city_name; ?></a>
        <?php else:?>          
          <a href="<?php print $prefix;?>/<?php print $english;?>"><?php print $russian; ?></a>
        <?php endif;?>
      </div>    
      <?php endif;?>
      <div class="title" id="mainTitle">
        <span class="big"><?php 
          if(isset($content['field_heading']['#items']['0']['value'])){
            print $content['field_heading']['#items']['0']['value'];
          }else{
            print $title;}?></span>
        <?php if(isset($content['field_subtitle']['#items'])):?>
          <br><span class="small"><?php print $content['field_subtitle']['#items']['0']['value'];?></span>
        <?php endif;?>
      </div>
      <div class="statistic">
        <div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
      </div>
    </div>
  </div>
</div>
<div class="article-item article-item--detail-content container">
<?php if($type == 'blog'):?>
  <div class="bloger-block">
    <div class="photo">
    <?php $bloger = $content['field_bloger']['#items']['0']['taxonomy_term'];?>
    <a href="<?php print $prefix;?>/blog/<?php print $bloger->tid;?>">          
      <?php 
        $autor_params = array(
          'style_name' => 'cyprus150x150',
          'path' => $bloger->field_image['und'][0]['uri'],
          'alt' => $bloger->name,
          'title' => $bloger->name,
          'attributes' => array('class' => array('img-rounded')),
          'getsize' => FALSE,
        );
      ?>
      <?php $autor_photo = theme('image_style', $autor_params); print $autor_photo;  ?>
    </a></div>
    <div class="info">      
      <div class="name"><a href="<?php print $prefix;?>/blog/<?php print $bloger->tid;?>"><?php print $bloger->name;?></a></div>
      <?php if(isset($content['field_translator']['#items']['0']['taxonomy_term'])):?>
        <?php $translator = $content['field_translator']['#items']['0']['taxonomy_term'];?>
        <div class="title translator"><span class='label'><?php print t('Translation'); ?>:</span> <?php print $translator->name;?></div>
      <?php endif;?>
      <?php if(isset($content['field_photographer']['#items']['0']['taxonomy_term'])):?>
        <?php $photographer = $content['field_photographer']['#items']['0']['taxonomy_term'];?>
        <div class="title photographer"><span class='label'><?php print t('Photo'); ?>:</span> <?php print $photographer->name;?></div>
      <?php endif;?>
      <div class="date"><?php print format_date($node->created, 'date'); /*format_interval((time() - $node->created) , 2) . t(' ago'); */ ?></div>
    </div>
  </div>
<?php elseif(isset($content['field_author']['#items']['0']['taxonomy_term'])):?>
  <div class="bloger-block">
    <div class="photo">
    <?php $author = $content['field_author']['#items']['0']['taxonomy_term'];?>              
      <?php 
        $autor_params = array(
          'style_name' => 'cyprus150x150',
          'path' => $author->field_image['und'][0]['uri'],
          'alt' => $author->name,
          'title' => $author->name,
          'attributes' => array('class' => array('img-rounded')),
          'getsize' => FALSE,
        );
      ?>
      <?php if (isset($author->field_image['und'][0]['uri'])):?>
        <?php $autor_photo = theme('image_style', $autor_params); print $autor_photo; ?>
      <?php endif;?>
    </div>
    <div class="info">      
      <div class="title"><span class='label'><?php print t('Author'); ?>:</span> <b><?php print $author->name;?></b></div>
      <?php if(isset($content['field_translator']['#items']['0']['taxonomy_term'])):?>
        <?php $translator = $content['field_translator']['#items']['0']['taxonomy_term'];?>
        <div class="title translator"><span class='label'><?php print t('Translation'); ?>:</span> <?php print $translator->name;?></div>
      <?php endif;?>
      <?php if(isset($content['field_photographer']['#items']['0']['taxonomy_term'])):?>
        <?php $photographer = $content['field_photographer']['#items']['0']['taxonomy_term'];?>
        <div class="title photographer"><span class='label'><?php print t('Photo'); ?>:</span> <?php print $photographer->name;?></div>
      <?php endif;?>
      <div class="date"><?php print format_date($node->created, 'date'); ?></div>
    </div>
  </div>
<?php elseif(isset($content['field_photographer']['#items']['0']['taxonomy_term'])):?>
   <div class="bloger-block">
    <div class="info">
        <?php $photographer = $content['field_photographer']['#items']['0']['taxonomy_term'];?>
        <div class="title photographer"><span class='label'><?php print t('Photo'); ?>:</span> <?php print $photographer->name;?></div>
      <div class="date"><?php print format_date($node->created, 'date'); ?></div>
    </div>
  </div>
<?php endif?>
    <div class="article-content">
      <div class="article-content-text">
      <?php 
          /* Находим в тексте все картинки и к родительскому параграфу добавляем класс photo-intext */
          $new_body = str_replace('<p><img', '<p class="photo-intext"><img', $content['body']['#items'][0]['value']);
          /* Находим в тексте все Заметки на полях и добавляем к ним фото автора статьи */
          $new_body = str_replace('<div class="monte-lemma">', '<div class="monte-lemma">'.$autor_photo, $new_body);
          /* Делим весь текст по значку параграфа § чтобы вставить Фотогалерею (если она есть) */
          $body_array = explode("§", $new_body);
          $global_key = 0;
          /* Если не одного значка § не найдено, то просто выводим текст*/ 
          if (count($body_array) > 1){
            foreach ($body_array as $key => $text) {
              print $text;
              if(isset($content['field_photogallery']['#items'][$key])){
                $photo_gallery = $content['field_photogallery']['#items'][$key]['entity'];
                $photo_gallery_photos = $photo_gallery->field_photos['und'];
                print_gallery($photo_gallery_photos, "review", $photo_gallery->title);
                $global_key = $key;
              }
            }
          }else{
            print $new_body;
          }
       ?>
      <?php 
        /* Если это фоторепортаж, то выводим крупно фотографии в виде ленты */
        if ($type == 'photo'):?>
        <?php foreach ($content['field_photos']['#items'] as $photo):?>
          <div class="photo-intext">
            <?php 
                $param = array(
                  'style_name' => 'cyprus1140x720',
                  'path' => $photo['uri'],
                  'getsize' => FALSE,
                );
                print theme('image_style', $param);
              ?> 
          </div>
        <?php endforeach; ?>
      <?php else:?>
      <?php 
        /* Если фотографии просто добавлены в обзор, выводим magnific-popup */
        if (isset($content['field_photos']['#items'])):?>
        <div class="row popup-gallery">
        <?php $photo_count = count($content['field_photos']['#items']); 
              $remainder = $photo_count % 4; $dop_class = (12 - 3 * $remainder) / 2; $dop_class = str_replace(".", "_", $dop_class);             
        ?>
        <?php if ($photo_count == 3 || $photo_count % 3 == 0):?>
          <?php foreach ($content['field_photos']['#items'] as $key => $photo):?>
            <div class="col-sm-6 col-md-4 photo-item">
              <a href="<?php print file_create_url($photo['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $photo['uri'],'getsize' => FALSE,);   
                    print theme('image_style', $photo_param); ?>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else:?>
          <?php for ($i = 0; $i < $photo_count - $remainder; $i++):?>
            <div class="col-sm-6 col-md-3 photo-item">
              <a href="<?php print file_create_url($content['field_photos']['#items'][$i]['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $content['field_photos']['#items'][$i]['uri'],'getsize' => FALSE,);  
                    print theme('image_style', $photo_param); ?> 
              </a>
            </div>
          <?php endfor;?>
          <?php for ($i = $photo_count - $remainder; $i < $photo_count; $i++):?>
            <div class="col-sm-6 col-md-3 photo-item col-md-offset-<?php if ($i == $photo_count - $remainder) print $dop_class;?>">
              <a href="<?php print file_create_url($content['field_photos']['#items'][$i]['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $content['field_photos']['#items'][$i]['uri'],'getsize' => FALSE,);  
                    print theme('image_style', $photo_param); ?>
              </a>
            </div>
          <?php endfor; ?>
        <?php endif;?>
        <div class="clearfix"></div>
        </div>
      <?php endif;?>
      <?php endif;?>

	    <?php
        /* Если к обзору привязаны рецепты, показываем их */
        if (isset($content['field_recipe']['#items']['0'])): ?>
        <h2 class="bordered"><?php print t("Recipes");?></h2>
        <?php 
          $recipes = $content['field_recipe']['#items'];
          foreach($recipes as $recipe):?>
          <div class="row">
            <?php $item = $recipe['entity'];?>
            <div class="recipe-content">
              <div class="col-lg-8 col-lg-offset-2">
                <h5 class="uppercase"><?php print $item->title; ?></h5>
                <?php if (isset($item->body)):?>
                  <div class="recipe-summery"><?php print $item->body['und'][0]['value']; ?></div>
                <?php endif;?>
                <p class="recipe-photo"><img src="<?php print file_create_url($item->field_main_img['und'][0]['uri']); ?>" alt="<?php print $item->title; ?>" /></p>
              </div>
              <div class="col-sm-6 col-md-5 col-lg-3 col-lg-offset-2">
                <h6 class="cuisine cuisine-ingredients"><?php print t("Ingredients");?></h6>
                <div class="recipe-ingredients">            
                  <?php if (isset($item->field_title['und'][0]['value'])):?>
                    <p class='bold-text'><?php print $item->field_title['und'][0]['value'];?></p>
                  <?php endif;?>
                  <?php foreach($item->field_ingredients['und'] as $ingredient):?>
                    <div class="param ">
                      <span class="param__value"><?php print $ingredient['second']; ?></span>
                      <span class="param__prop"><?php print $ingredient['first']; ?></span>                
                    </div>              
                  <?php endforeach;?>  
                  <?php if (isset($item->field_www['und'][0]['value']) && isset($item->field_ingredients2['und'][0])):?>
                    <p class='bold-text'><?php print $item->field_www['und'][0]['value'];?></p>
                    <?php foreach($item->field_ingredients2['und'] as $ingr):?>
                      <div class="param">
                        <span class="param__value"><?php print $ingr['second']; ?></span>
                        <span class="param__prop"><?php print $ingr['first']; ?></span>                  
                      </div>  
                    <?php endforeach;?>
                  <?php endif;?> 
                </div>
              </div>
              <div class="col-sm-6 col-md-7 col-lg-5">
                <div class="recipe-cooking">
                  <h6 class="cuisine"><?php print t("Cooking method");?></h6>
                   <?php 
                    /* Находим в тексте все картинки и к родительскому параграфу добавляем класс photo-intext */
                    $new_body_cooking = str_replace('<p><img', '<p class="photo-intext"><img', $item->field_body['und'][0]['value']);
                    print  $new_body_cooking; ?>
                </div>
              </div>
              <div class="clearfix "></div>
              <hr class="grey" />
            </div>
          </div>
        <?php endforeach;?>     
      <?php endif; ?>
      <?php 
        /* Находим в тексте все картинки и к родительскому параграфу добавляем класс photo-intext */
        $new_body_continue = "";
        if(isset($content['field_body'])){
          $new_body_continue = str_replace('<p><img', '<p class="photo-intext"><img', $content['field_body']['#items'][0]['value']);
          /* Находим в тексте все Заметки на полях и добавляем к ним фото автора статьи */
          $new_body_continue = str_replace('<div class="monte-lemma">', '<div class="monte-lemma">'.$autor_photo, $new_body_continue);
        }
      ?>
      <?php 
          /* Делим весь текст по значку параграфа § чтобы вставить Фотогалерею (если она есть) */
          $body_continue_array = explode("§",$new_body_continue);
          if (count($body_continue_array) > 1){
            foreach ($body_continue_array as $key => $text) {
              print $text;
              if ($global_key > 0) $global_key = $global_key + 1;
              if (isset($content['field_photogallery']['#items'][$global_key])){
                $photo_gallery = $content['field_photogallery']['#items'][$global_key]['entity'];
                $photo_gallery_photos = $photo_gallery->field_photos['und'];
                print_gallery($photo_gallery_photos, "review", $photo_gallery->title);
                $global_key = $global_key + 1;
              }
            }
          }else{
            print $new_body_continue;
          }
      ?>
      <?php 
        /* Если к обзору привязан фотообзор, то показываем фото в виде magnific-popup */
        if (isset($content['field_photo_review']['#items']['0'])):?>
        <div class="row popup-gallery">
        <?php $photo_review = $content['field_photo_review']['#items']['0']['entity'];
              $photo_review_photos = $photo_review->field_photos['und'];
              $photo_count = count($photo_review_photos); 
              $remainder = $photo_count % 4; $dop_class = (12 - 3 * $remainder) / 2; $dop_class = str_replace(".", "_", $dop_class);             
        ?>
        <?php if ($photo_count == 3 || $photo_count % 3 == 0):?>
          <?php foreach ($photo_review_photos as $key => $photo):?>
            <div class="col-sm-6 col-md-4 photo-item">
              <a href="<?php print file_create_url($photo['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $photo['uri'],'getsize' => FALSE,);   
                    print theme('image_style', $photo_param); ?>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else:?>
          <?php for ($i = 0; $i < $photo_count - $remainder; $i++):?>
            <div class="col-sm-6 col-md-3 photo-item">
              <a href="<?php print file_create_url($photo_review_photos[$i]['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $photo_review_photos[$i]['uri'],'getsize' => FALSE,);  
                    print theme('image_style', $photo_param); ?> 
              </a>
            </div>
          <?php endfor;?>
          <?php for ($i = $photo_count - $remainder; $i < $photo_count; $i++):?>
            <div class="col-sm-6 col-md-3 photo-item col-md-offset-<?php if ($i == $photo_count - $remainder) print $dop_class;?>">
              <a href="<?php print file_create_url($photo_review_photos[$i]['uri']) ?>">
                <?php $photo_param = array('style_name' => 'cyprus1140x720', 'path' => $photo_review_photos[$i]['uri'],'getsize' => FALSE,);  
                    print theme('image_style', $photo_param); ?>
              </a>
            </div>
          <?php endfor; ?>
        <?php endif;?>
        <div class="clearfix"></div>
        </div>           
      <?php endif; ?> 
      </div>
      <div class="tags-block">
        <div class="statistic">
          <div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
        </div>   
        <?php foreach ($content['field_section']['#items'] as $section):?>
          <?php $term_section = taxonomy_term_load($section['taxonomy_term']->tid);
                $translated_term_section = i18n_taxonomy_localize_terms($term_section); ?>
          <a href="<?php print $prefix;?>/<?php print $term_section->field_english['und'][0]['value'];?>"><?php print $translated_term_section->name;?></a>
        <?php endforeach; ?>
        <?php foreach ($content['field_tags']['#items'] as $tags):?>
           <?php $term_tag = taxonomy_term_load($tags['taxonomy_term']->tid);
                $translated_term_tag = i18n_taxonomy_localize_terms($term_tag); ?>
          <a href="<?php print $prefix;?>/tags/<?php print str_replace(" ", "-", $tags['taxonomy_term']->name);?>"><?php print $translated_term_tag->name;?></a>
        <?php endforeach; ?>
      </div>
  </div>  
</div>
</div>
<?php /* Поделитесь с друзьями */?>
<?php $current_url = url(current_path(), array('absolute' => TRUE)); $current_title = drupal_get_title();?>
<div class="wide-container container">
<div class="detail-share-block">  
  <div class="title"><?php print t("Share with friends");?></div>       
  <div class="share-links">         
    <a href="http://www.facebook.com/sharer.php?src=sp&amp;u=<?php print urlencode($current_url);?>" class="fa fa-facebook" target="_blank">
      <span class="note"><?php print t("Facebook");?></span></a>    
    <a href="http://twitter.com/home?status=<?php print urlencode($current_url);?>&amp;text=<?php print $current_title;?>" class="fa fa-twitter" target="_blank">
      <span class="note"><?php print t("Twitter");?></span></a>   
    <a href="https://telegram.me/share/url?url=<?php print urlencode($current_url);?>&amp;text=<?php print $current_title;?>" class="fa fa-telegram" target="_blank" >
      <span class="note"><?php print t("Telegram");?></span></a>            
    <a href="http://vk.com/share.php?url=<?php print urlencode($current_url);?>&amp;title=<?php print $current_title;?>" class="fa fa-vk" target="_blank">
      <span class="note"><?php print t("ВКонтакте");?></span></a> 
    <a href="http://www.tumblr.com/share/link?url=<?php print urlencode($current_url);?>&amp;name=<?php print $current_title;?>" class="fa fa-tumblr" target="_blank">
      <span class="note"><?php print t("Tumblr");?></span></a>  
  </div>
  
  <script type="text/javascript">
  (function($) {
    $(function() {          
      $('.share-links a').on('click', function(){   
        var Url = $(this).attr('href');
        var newWin = window.open(Url, 'example', 'width=600,height=400');
        return false;
      });
      var Section = "<?php print $russian;?>";
      $('#block-menu-menu-top-menu li a').each(function(){
          if($(this).text() == Section){
            $(this).addClass('active');
          }
        });
     })
  })(jQuery);    
  </script>
</div>
</div>
<?php   
  /* Популярные обзоры */
  //print views_embed_view('cyprus', 'theme_reviews5');
  /* События из Афиши */
  //print views_embed_view('cyprus', 'top_events');
  /* Популярные места */
  //print views_embed_view('cyprus', 'top_places');
  //switch ($type) {
  //  case 'text':
      /* Популярные места */
  //    print views_embed_view('cyprus', 'top_places');
      /* События из Афиши */
  //    print views_embed_view('cyprus', 'top_events');
  //    break;
  //  case 'photo':
      /* События из Афиши */
  //    print views_embed_view('cyprus', 'top_events');
       /* Популярные места */
  //    print views_embed_view('cyprus', 'top_places');
  //    break;
  //  case 'recipe':
      /* События из Афиши */
  //    print views_embed_view('cyprus', 'top_events');
  //     break;
  //  default:
      /* Популярные места */
  //    print views_embed_view('cyprus', 'top_places');
      /* События из Афиши */
  //    print views_embed_view('cyprus', 'top_events');
  //    break;
  //}
?>
