<?php
/**
 * @file
 * Returns the HTML for the basic html structure of a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728208
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]><html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<?php global $language_content; $lang = $language_content->language; $theme_path = path_to_theme();?>
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>

  <?php if ($default_mobile_metatags): ?>
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width">
  <?php endif; ?>
  <meta http-equiv="cleartype" content="on">

  <?php print $styles; ?>
  <?php print $scripts; ?>
  <?php if ($add_html5_shim and !$add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5.js"></script>
    <![endif]-->
  <?php elseif ($add_html5_shim and $add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/html5-respond.js"></script>
    <![endif]-->
  <?php elseif ($add_respond_js): ?>
    <!--[if lt IE 9]>
    <script src="<?php print $base_path . $path_to_zen; ?>/js/respond.js"></script>
    <![endif]-->
  <?php endif; ?>
  
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php print $base_path . $theme_path; ?>/img/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?php print $base_path . $theme_path; ?>/img/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="<?php print $base_path . $theme_path; ?>/img/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="<?php print $base_path . $theme_path; ?>/img/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?php print $base_path . $theme_path; ?>/img/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?php print $base_path . $theme_path; ?>/img/favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="&nbsp;"/>
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="<?php print $base_path . $theme_path; ?>/img/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="<?php print $base_path . $theme_path; ?>/img/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="<?php print $base_path . $theme_path; ?>/img/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="<?php print $base_path . $theme_path; ?>/img/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="<?php print $base_path . $theme_path; ?>/img/mstile-310x310.png" />

</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<div class="body">
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  
  </div>
</body>
</html>
