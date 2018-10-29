<?php
    $theme_path = path_to_theme();
    global $language_content; 
    $lang = $language_content->language;
    if ($lang == 'en') $prefix = '/en'; else $prefix = '';
    $term_city = taxonomy_term_load($content['field_city']['#items'][0]['taxonomy_term']->tid);
    $translated_term_city = i18n_taxonomy_localize_terms($term_city); 
?>
<?php
    $exp_block = module_invoke('views', 'block_view', '-exp-cyprus-events');
    print render($exp_block['content']);
  ?>
<?php $totalcount = isset($content['links']['statistics']['#links']['statistics_counter']['title']) ? (int) $content['links']['statistics']['#links']['statistics_counter']['title'] : 10;?>
<div class="media-detail media-detail--event article-detail article-detail--event">
  <div class="article-photo-wrapper container">
    <div class="main-photo">
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
      <div class="category">
        <span class="date">
        <?php 
            print format_date(strtotime($content['field_when']['#items'][0]['value']), 'short_event'); 
            if ($content['field_when']['#items'][0]['value2'] != $content['field_when']['#items'][0]['value']){
              print " - ";
              print format_date(strtotime($content['field_when']['#items'][0]['value2']), 'short_event');
         } ?>         
        </span> |
      <?php if (isset($content['field_city']['#items'][0]['taxonomy_term']->tid)):?>
        <a href="/events?city=<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid;?>"><?php print $translated_term_city->name;?></a>
      <?php else:?>
        <a href="/events"><?php print t("Montenegro") ?></a>
      <?php endif;?>
      </div>
      <div class="title-descr">     
        <h1 class="main-title" id="mainTitle"><?php print $title; ?></h1>
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
                <span class="item-value">
                  <?php 
                  $count_places = count($content['field_places']);
                  for($i = 0; $i < $count_places; $i++) {
                    if(isset($content['field_places'][$i]['#markup'])){
                      print $content['field_places'][$i]['#markup']."; ";
                    }
                  }
                  ?>                    
                </span>
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
            <?php elseif (isset($content['field_places']['0']['#item'])):?>
              <div class="item-row">
                <span class="item-label"><?php print t("Address");?>:</span>
                <span class="item-value show_map">
                <?php 
                  foreach($content['field_places']['#items'] as $places){
                    print $places['entity']->field_address['und'][0]['value']."; ";
                  } 
                ?>               
                </span>
              </div>
            <?php endif;?>
            <?php if (isset($content['field_time']['#items']['0']['value'])):?>
              <div class="item-row"> 
                <span class="item-label"><?php print t("Start");?>:</span>
                <span class="item-value"><?php print ($content['field_time']['#items'][0]['value']);?></span>
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
  <?php if(isset($content['field_latlng']['#items'][0]) || isset($content['field_places']['#items'][0])):?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCBHA4KKBAltxjI2LHONR2AhNJekCfx1Vw&sensor=false"></script>
  <script type="text/javascript">
    <?php
    print "var Address = [";
    if(isset($content['field_latlng']['#items'][0])){
      foreach ($content['field_latlng']['#items'] as $latlng) { print "'".$latlng['value']."',"; }
    }else{
      foreach($content['field_places']['#items'] as $places){
        foreach ($places['entity']->field_latlng['und'] as $latlng) { print "'".$latlng['value']."',"; }
      }      
    }
    print "];";
    ?>
    var markers = new Array();
    var Locations = new Array(); 
    function initialize() {
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(35.126413, 33.429859);
      var mapOptions =  {zoom: 15, center: latlng}
      map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);      
      codeAddress(Address[0]);      
      for (var i = 0; i < Address.length; i++) {
        setMarkers(Address[i]);
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function setMarkers(address){
      geocoder.geocode( {address:address}, function(results, status) 
      {
        if (status == google.maps.GeocoderStatus.OK){
          var marker = new google.maps.Marker(
          {
            icon: '/sites/all/themes/cyprus_new/img/pin.svg',
            map: map,
            position: results[0].geometry.location,
            title: address
          });
        } else {
          console.log('Geocode was not successful for the following reason: ' + status);
       }
      });
    } 
    function codeAddress(address) {
      geocoder.geocode( {address:address}, function(results, status){
        if (status == google.maps.GeocoderStatus.OK)   map.setCenter(results[0].geometry.location);
        else console.log('Geocode was not successful for the following reason: ' + status);
      });
    }
  </script>
  <script type="text/javascript">
  (function($) {
      $(function() {  
        $('.show_map').click(function(){
            $('.body').css('width', $('.body').css('width'));
            $('body').css('overflow-y', 'hidden');
            $('<div id="mybox_overlay"></div>')
            .css('top',$(document).scrollTop()).css('opacity','0').animate({'opacity':'0.75'},'slow').appendTo('body');
            google.maps.event.trigger(map, 'resize');
            $('<span class="lb-close"></span>').prependTo('.map-wrapper');
            //$('.map-wrapper').show();
            $('.map-wrapper').css('visibility','visible');
        });        
     });
  })(jQuery);   
  </script>
  <?php endif;?>
  <div class="tags-block">
    <div class="statistic">
      <div class="metrika metrika-watch"><?php print file_get_contents($theme_path."/img/views.svg");?><span class="count"><?php print $totalcount;?></span></div>
    </div>    
    <a href="<?php print $prefix;?>/events?city=<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid;?>"><?php print $translated_term_city->name;?></a>
    <?php foreach ($content['field_section']['#items'] as $section):?>
      <?php $term_section = taxonomy_term_load($section['taxonomy_term']->tid);
            $translated_term_section = i18n_taxonomy_localize_terms($term_section); ?>
      <a href="<?php print $prefix;?>/events?section=<?php print $section['taxonomy_term']->tid;?>"><?php print $translated_term_section->name;?></a>
    <?php endforeach; ?>
    <?php foreach ($content['field_category']['#items'] as $category):?>
      <?php $term_category = taxonomy_term_load($category['taxonomy_term']->tid);
            $translated_term_category = i18n_taxonomy_localize_terms($term_category); ?>
      <a href="<?php print $prefix;?>/events?category=<?php print $category['taxonomy_term']->tid;?>"><?php print $translated_term_category->name;?></a>
    <?php endforeach; ?>
    <?php foreach ($content['field_tags']['#items'] as $tags):?>
       <?php $term_tag = taxonomy_term_load($tags['taxonomy_term']->tid);
            $translated_term_tag = i18n_taxonomy_localize_terms($term_tag); ?>
      <a href="<?php print $prefix;?>/tags/<?php print str_replace(" ", "-", $tags['taxonomy_term']->name);?>"><?php print $translated_term_tag->name;?></a>
    <?php endforeach; ?>
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
      $('#edit-when-value-date').val('<?php print format_date(strtotime($content['field_when']['#items'][0]['value']), 'date');?>');
      $('#edit-type').val('<?php print $content['field_event_type']['#items'][0]['taxonomy_term']->tid; ?>');
      $('#edit-city').val('<?php print $content['field_city']['#items'][0]['taxonomy_term']->tid; ?>');
     })
  })(jQuery);    
  </script>
</div>
</div>
<?php 
  /* Популярные события в Афише */
  //print views_embed_view('cyprus', 'top_events');  
  /* Популярные места в том же городе */
  //print views_embed_view('cyprus', 'top_places');
  /* Популярные обзоры из того же раздела */
  //print views_embed_view('cyprus', 'top_reviews');
?>