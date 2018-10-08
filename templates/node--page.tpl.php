<div class="container white-container">  
  <div class="article-content node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix">
    <h1 class="main-title"><?php print $title; ?></h1>  
    <?php  print $content['body']['#items'][0]['value']; ?>    
  </div>
  <?php 
  /* Популярные места */
  print views_embed_view('main', 'pop_places');
  /* Лучшее за месяц*/
  print views_embed_view('main', 'pop_reviews');
  
?>
</div>

