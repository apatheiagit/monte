<?php $page_type = arg(0); ?>
<?php global $user; $clear_class = ""; $theme_path = path_to_theme();
      global $language_content; $lang = $language_content->language; if ($lang == 'en') $prefix = '/en'; else $prefix = '';
?>
<div class="somit somit-header <?php print $page_type; ?> ">  
  <div class="upper-header topMenu">
    <div class="container">
    <span class="wrap-toggle-btn hidden-sm hidden-md hidden-lg"><span class="toggle-btn"></span></span>      
      <div class="row">        
        <div class="col-xs-12 col-sm-2 col-md-3 col-logo">
           <a href="<?php print $prefix;?>/" class="top-logo hidden-sm "><img src="/<?php print $theme_path;?>/logo.svg"  alt="MontenegroForTravellers"></a>
           <a href="<?php print $prefix;?>/" class="mini-logo hidden-lg hidden-md hidden-xs"><img src="/<?php print $theme_path;?>/img/logo-mini.svg"  alt="MontenegroForTravellers"></a>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-6 main-header">        
          <div class="main-menu">        
            <?php print render($page['header']); ?>       
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 lang-block">                  	
      		<?php
            $lang_block = module_invoke('locale', 'block_view', 'language');
            print $lang_block['content'];
          ?>    
          <div class="search-block"><span class="search-buttn"></span></div>    	
        </div>
      </div>    
    </div>
  </div>
</div>
<div class="somit somit-body <?php print $page_type; ?>">     
  <?php print render($page['navigation']); ?>
  <?php print render($page['highlighted']); ?>
  <?php print $messages; ?>
  <?php /*print $breadcrumb; */?> 
  <?php print render($tabs); ?>
  <?php print render($page['top']); ?>
  <?php print render($page['content']); ?>
  <?php print render($page['bottom']); ?>
</div>
<div class="somit somit-footer">
  <div class="container">
  <div class="top-string">
    <div class="row">      
      <div class="col-sm-5 col-md-5">
        <div class="bottom-descr"> 
          <p>© 2011-<?php print date("Y"); ?> <a href="http://www.montenegrofortravellers.com">www.montenegrofortravellers.com</a></p>
        </div>
      </div>      
      <div class="col-sm-7 col-md-7">        
        <?php print render($page['header']); ?>
      </div>
    </div>
  </div>
  <div class="bottom-string">
    <div class="row">
      <div class="col-sm-7 col-md-6">
        <?php if ($lang == "en"):?>
          <div class="bottom-rights">Reproduction or use of any materials only with the permission of the publisher: <a href="mailto:editor@montenegrofortravellers.com">editor@montenegrofortravellers.com</a></div>
        <?php else: ?>
          <div class="bottom-rights">Перепечатка и использование любых материалов только с&nbsp;разрешения редакции: <a href="mailto:editor@montenegrofortravellers.com">editor@montenegrofortravellers.com</a></div>
        <?php endif;?>  
      </div>
      <div class="col-sm-5 col-md-6 social-block">         
        <div class="small-share-block share-links">          
          <?php if ($lang == 'en'):?>
             <a class="fa fa-vk" title="Перейти в группу Вконтакте" href="https://vk.com/montenegrofortravellers" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_vk.svg");?>
              <span class="visuallyhidden">ВКонтакте</span></a>
            <a class="fa fa-facebook" title="Перейти в группу в Фейсбуке" href="https://www.facebook.com/montenegrofortravellers/" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_facebook.svg");?>
              <span class="visuallyhidden">Facebook</span></a>                 
            <a class="fa fa-twitter" title="Перейти в группу в Twitter" href="https://twitter.com/cyprusfortravel" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_twitter.svg");?>
              <span class="visuallyhidden">Twitter</span></a>            
          <?php else:?>
            <a class="fa fa-vk" title="Перейти в группу Вконтакте" href="https://vk.com/montenegrofortravellers" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_vk.svg");?>
              <span class="visuallyhidden">ВКонтакте</span></a>
            <a class="fa fa-facebook" title="Перейти в группу в Фейсбуке" href="https://www.facebook.com/montenegrofortravellers/" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_facebook.svg");?>
              <span class="visuallyhidden">Facebook</span></a>                    
            <a class="fa fa-twitter" title="Перейти в группу в Twitter" href="https://twitter.com/cyprusfortravel" rel="nofollow" target="_blank">
              <?php print file_get_contents($theme_path."/img/f_twitter.svg");?>
              <span class="visuallyhidden">Twitter</span></a>
            
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="totopcontroller">
  <div class="container">
    <div class="icon-to-top"><?php print file_get_contents($theme_path."/img/totop.svg");?></div>
  </div>
</div>