<?php
    $theme_path = path_to_theme();
    global $language_content; 
    $lang = $language_content->language;
    if ($lang == 'en') $prefix = '/en'; else $prefix = '';
    $term_city = taxonomy_term_load($content['field_city']['#items'][0]['taxonomy_term']->tid);
    $translated_term_city = i18n_taxonomy_localize_terms($term_city); 
?>
<?php
    $exp_block = module_invoke('views', 'block_view', '-exp-cyprus-places');
    print render($exp_block['content']);
  ?>
<?php $totalcount = isset($content['links']['statistics']['#links']['statistics_counter']['title']) ? (int) $content['links']['statistics']['#links']['statistics_counter']['title'] : 10;?>
<div class="media-detail media-detail--place article-detail article-detail--event">
  <div class="article-photo-wrapper container">
    <div class="main-photo" id="mainPhoto">
     <?php
      if ($content['field_cut_photo']['#items']['0']['value'] == 'top'){
        $params = array(
          'style_name' => 'monte1140x550top',
          'path' => $content['field_main_img']['#items']['0']['uri'],
          'alt' => $title,
          'title' => $title,
          'attributes' => array('class' => array('img-responsive')),
          'getsize' => FALSE,
        );
      }elseif($content['field_cut_photo']['#items']['0']['value'] == 'bottom'){
        $params = array(
          'style_name' => 'monte1140x550bottom',
          'path' => $content['field_main_img']['#items']['0']['uri'],
          'alt' => $title,
          'title' => $title,
          'attributes' => array('class' => array('img-responsive')),
          'getsize' => FALSE,
        );
      }else{
        $params = array(
          'style_name' => 'monte1140x550',
          'path' => $content['field_main_img']['#items']['0']['uri'],
          'alt' => $title,
          'title' => $title,
          'attributes' => array('class' => array('img-responsive')),
          'getsize' => FALSE,
        );
      }
      print theme('image_style', $params);
    ?>  
    </div> 
    <div class="main-info">
      <div class="category"><a href="<?php print $prefix;?>/places?city=<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid;?>"><?php print $translated_term_city->name;?></a></div>
      <div class="title-descr">            
        <h1 class="main-title" id="mainTitle">
          <?php if (isset($content['field_title']['#items']['0']['value'])):?>
            <?php print $content['field_title']['#items']['0']['value']; ?>
          <?php else:?>
            <?php print $title; ?>
          <?php endif;?>
        </h1>
        <div class="descr"><?php print $content['body']['#items'][0]['summary']; ?></div>
      </div> 
      <div class="statistic">
        <div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
      </div> 
    </div>
  </div>
  <div class="container">
    <div class="row">     
      <div class="article-contact-block">
        <div class="article-contact">
          <div class="col-md-8 col-md-offset-2"><h5 class="article-title"><?php print t("Contact Information");?></h5></div>
          <div class="col-sm-6 col-md-4 col-md-offset-2">            
            <?php if (isset($content['field_places']['0']['#markup'])):?>
              <div class="item-row">             
                <span class="item-label"><?php print t("Where");?>:</span>
                <span class="item-value"><?php print($content['field_places']['0']['#markup']);?></span>
              </div>
            <?php endif;?>
            <?php if (isset($content['field_address']['#items']['0']['value'])):?>
              <div class="item-row">
                <span class="item-label"><?php print t("Address");?>:</span>
                <span class="item-value show_map">
                   <?php 
                      foreach ($content['field_address']['#items'] as $key => $value) {
                        print $value['value']."; ";
                      }                  
                    ?>                  
                </span>
              </div>
            <?php endif;?>
            <?php if (isset($content['field_time']['#items']['0']['value'])):?>
              <div class="item-row"> 
                <span class="item-label"><?php print t("Opening hours")?>:</span>
                <span class="item-value">
                 <?php 
                    foreach ($content['field_time']['#items'] as $key => $value) {
                      print $value['value']."; ";
                    }                  
                  ?>
              </div>
            <?php endif;?>
          </div>
          <div class="col-sm-6 col-md-4">
            <?php if (isset($content['field_www']['#items']['0']['value'])):?>              
              <div class="item-row">
                <?php $newphrase = str_replace('http://', '', $content['field_www']['#items']['0']['value']);?>
                <?php $newphrase = str_replace('https://', '', $newphrase);?>
                <span class="item-label"><?php print t("Website") ?>:</span><span class="item-value">
                  <?php if ($content['field_special']['#items']['0']['value'] == 1):?>
                    <a href="//<?php print($newphrase);?>" target="_blank"><?php print($newphrase);?></a>
                   <?php else:?>
                    <?php print($newphrase);?>
                  <?php endif;?>                  
                </span>
              </div>
            <?php endif;?>
            <?php if (isset($content['field_phone']['#items']['0']['value'])):?>
              <div class="item-row">             
                <span class="item-label"><?php print t("Phone");?>:</span>
                <span class="item-value"><?php print($content['field_phone']['#items']['0']['value']);?></span>
              </div>
            <?php endif;?>            
            <?php if (isset($content['field_price']['#items']['0']['value'])):?>
              <div class="item-row"> 
                <span class="item-label"><?php print t("Price");?>:</span>
                <span class="item-value"><?php print ($content['field_price']['#items'][0]['value']);?></span>
              </div>
            <?php endif;?>
          </div>
        </div>    
        <div class="clearfix "></div>    
      </div>    
      <div class="article-detail-block col-md-8 col-md-offset-2">
        <div class="article-text bordered-top">
        <?php print($content['body']['#items'][0]['value']);?>
        </div>
      </div> 
      <div class="clearfix "></div>        
  </div> 
  <div class="map-wrapper">
    <div id="map_canvas" class="map-container"></div>
  </div>
    <?php if(isset($content['field_latlng']['#items'][0])):?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
  <script type="text/javascript">
  (function($) {
  $(function(){
    $('.show_map').click(function(){
      $('.body').css('width', $('.body').css('width'));
      $('body').css('overflow-y', 'hidden');
      $('<div id="mybox_overlay"></div>')
      .css('top',$(document).scrollTop()).css('opacity','0').animate({'opacity':'0.75'},'slow').appendTo('body');
      $('<span class="lb-close"></span>').prependTo('.map-wrapper');
      $('.map-wrapper').css('visibility','visible');
    })

    <?php
    print "var Address = [";
    foreach ($content['field_latlng']['#items'] as $latlng) { print "'".$latlng['value']."',"; }
    print "];";
    ?>
    var mymap = L.map('map_canvas').setView([42.292295, 18.842695], 17);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYXBhdGhlaWEiLCJhIjoiY2p5eWdldnAzMTA0bzNjbWVxN2V4eGsxMSJ9.K0GrQhIKuXexBH6bj0kv6Q', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYXBhdGhlaWEiLCJhIjoiY2p5eWdldnAzMTA0bzNjbWVxN2V4eGsxMSJ9.K0GrQhIKuXexBH6bj0kv6Q'
    }).addTo(mymap);
    for (var i = 0; i < Address.length; i++) {
      if (Address[i].match(/^\d/)) {        
        var latlng_array = Address[i].split(", ");
        var lat = latlng_array[0];
        var lng = latlng_array[1];
        if (lng.match(/^\d/)){
          var marker = L.marker([lat, lng]).addTo(mymap);
          mymap.panTo(new L.LatLng(lat, lng));
        }
      }else{
        setOSM_Markers(Address[i]);
      } 
    }
    function setOSM_Markers(address){
      var res = encodeURI(address);
      var url = 'http://api.geonames.org/searchJSON?username=apatheiar&q='+res;
      
      $.ajax({
        url: url,
        dataType: 'jsonp',        
        success: function(data){
          console.log(data);
          if(data.totalResultsCount > 0){
            var lat = data.geonames[0].lat;
            var lng = data.geonames[0].lng;
            var marker = L.marker([lat, lng]).addTo(mymap);
            mymap.panTo(new L.LatLng(lat, lng));
          }
        },
        error: function(jqXHR, err, ex){
          console.log("jqXHR:");
          console.log(jqXHR);
        }
      });
    }
  })
  })(jQuery);   
  </script>
  <?php endif;?>  
  <?php /* Фотографии этого места */ ?>
    <?php if (isset($content['field_photos']['#items'])):?>
    <div class="somit somit-gallery ">
        <div class="photo-carousel">
          <?php foreach ($content['field_photos']['#items'] as $photo):?>
            <div class="photo-item">
              <?php 
                $param = array(
                  'style_name' => 'cyprus1140x720',
                  'path' => $photo['uri'],
                  'getsize' => FALSE,
                );
                print theme('image_style', $param);
              ?> 
              <div class="descr"><div><?php print $photo['title']; ?></div></div>
            </div>              
          <?php endforeach; ?>
        </div>
        <div class="photo-controls-wrapper"><div class="photo-controls"><div class="customBtn customPrevBtn"></div> <div class="owl-counter"><span class="current-photo">1</span> / <?php print count($content['field_photos']['#items']);?></div> <div class="customBtn customNextBtn"></div></div></div> 
    </div>  
    <?php endif; ?>
    <?php /* Фотографии из привязанного фотообзора */ ?>
    <?php if (isset($content['field_photo_review']['#items']['0'])):?>
    <div class="somit somit-gallery ">
        <div class="photo-carousel">
          <?php $photo_review = $content['field_photo_review']['#items']['0']['entity'];?>
          <?php foreach ($photo_review->field_photos['und'] as $photo):?>
            <div class="photo-item">
              <?php 
                $param = array(
                  'style_name' => 'cyprus1140x720',
                  'path' => $photo['uri'],
                  'getsize' => FALSE,
                );
                print theme('image_style', $param);
              ?> 
              <div class="descr"><div><?php print $photo['title']; ?></div></div>
            </div>              
          <?php endforeach; ?>
        </div>
        <div class="photo-controls-wrapper"><div class="photo-controls"><div class="customBtn customPrevBtn"></div> <div class="owl-counter"><span class="current-photo">1</span> / <?php print count($photo_review->field_photos['und']);?></div> <div class="customBtn customNextBtn"></div></div></div> 
    </div>  
    <?php endif; ?>
  <div class="tags-block">
    <div class="statistic">
      <div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
    </div>   
    <a href="<?php print $prefix;?>/places?city=<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid;?>"><?php print $translated_term_city->name;?></a>
    <?php foreach ($content['field_section']['#items'] as $section):?>
      <?php $term_section = taxonomy_term_load($section['taxonomy_term']->tid);
            $translated_term_section = i18n_taxonomy_localize_terms($term_section); ?>
      <a href="<?php print $prefix;?>/places?section=<?php print $section['taxonomy_term']->tid;?>"><?php print $translated_term_section->name;?></a>
    <?php endforeach; ?>
    <?php foreach ($content['field_category']['#items'] as $category):?>
      <?php $term_category = taxonomy_term_load($category['taxonomy_term']->tid);
            $translated_term_category = i18n_taxonomy_localize_terms($term_category); ?>
      <a href="<?php print $prefix;?>/places?category=<?php print $category['taxonomy_term']->tid;?>"><?php print $translated_term_category->name;?></a>
    <?php endforeach; ?>
    <?php if(isset($content['field_tags'])):?>
      <?php foreach ($content['field_tags']['#items'] as $tags):?>
         <?php $term_tag = taxonomy_term_load($tags['taxonomy_term']->tid);
              $translated_term_tag = i18n_taxonomy_localize_terms($term_tag); ?>
        <a href="<?php print $prefix;?>/tags/<?php print str_replace(" ", "-", $tags['taxonomy_term']->name);?>"><?php print $translated_term_tag->name;?></a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
 </div>
</div>
<?php /* Поделитесь с друзьями */?>
<?php $current_url = url(current_path(), array('absolute' => TRUE)); $current_title = drupal_get_title();?>
<div class="container"> 
  <div class="detail-share-block">   
  <div class="title"><?php print t("Share with friends");?></div>       
  <div class="share-links">         
    <a href="http://www.facebook.com/sharer.php?src=sp&amp;u=<?php print urlencode($current_url);?>" class="fa fa-facebook" target="_blank">
      <?php print file_get_contents($theme_path."/img/facebook.svg");?>
      <span class="link-name">Facebook</span></a>   
    <a href="http://twitter.com/home?status=<?php print urlencode($current_url);?>&amp;text=<?php print $current_title;?>" class="fa fa-twitter" target="_blank">
      <?php print file_get_contents($theme_path."/img/twitter.svg");?>
      <span class="link-name">Twitter</span></a>    
    <a href="https://telegram.me/share/url?url=<?php print urlencode($current_url);?>&amp;text=<?php print $current_title;?>" class="fa fa-telegram" target="_blank" >
      <?php print file_get_contents($theme_path."/img/telegram.svg");?>
      <span class="link-name">Telegram</span></a>           
    <a href="http://vk.com/share.php?url=<?php print urlencode($current_url);?>&amp;title=<?php print $current_title;?>" class="fa fa-vk" target="_blank">
      <?php print file_get_contents($theme_path."/img/vk.svg");?>
      <span class="link-name">ВКонтакте</span></a>  
    <a href="http://www.tumblr.com/share/link?url=<?php print urlencode($current_url);?>&amp;name=<?php print $current_title;?>" class="fa fa-tumblr" target="_blank">
      <?php print file_get_contents($theme_path."/img/tumblr.svg");?>
      <span class="link-name">Tumblr</span></a>  
  </div>
  <script type="text/javascript">
  (function($) {
    $(function() {          
      $('.share-links a').on('click', function(){   
        var Url = $(this).attr('href');
        var newWin = window.open(Url, 'example', 'width=600,height=400');
        return false;
      });
      $('#edit-section').val('<?php print $content['field_section']['#items'][0]['taxonomy_term']->tid; ?>');
      $('#edit-city').val('<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid; ?>');
      $('#edit-category').val('<?php print $content['field_category']['#items'][0]['taxonomy_term']->tid; ?>');
     })
  })(jQuery);    
  </script>
</div>
</div>
<?php 
 /* Афиша в этом месте */
  //print views_embed_view('cyprus', 'events_inplace');
  /* Популярные места в этом городе */
  //print views_embed_view('cyprus', 'top_places');
  /* Популярные обзоры из того же раздела */
  //print views_embed_view('cyprus', 'theme_reviews'); 
?>