<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tai Travis Frontend Engineer<?php if(isset($options['page_title'])) echo ' | '.$options['page_title'] ?></title>
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <meta property="og:title" content="Tai Travis Frontend Engineer Portfolio"/>
    <meta property="og:image" content="http://www.taitravis.com/img/graphics/fb-bgrd3.png"/>
    <meta property="og:site_name" content="Tai Travis Frontend Engineer"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="Tai builds and works on large websites."/>

    <link href="/cssdist/webf.css" rel="stylesheet" type="text/css">
    <link href="/cssdist/colorbox.css" rel="stylesheet" type="text/css">
    <!-- <link href="/bower_components/vex/dist/css/vex-theme-default.css" rel="stylesheet" type="text/css"> -->

    <link href="/cssdist/styley.css" rel="stylesheet" type="text/css">

     <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
      <script type="text/javascript">WebFont.load({
        google: {
          families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
        }});
    </script>
    <script src="/jsdist/modernizr-2.7.1.js" type="text/javascript"></script>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  </head>
  <body>
      <div class="hero">
      <div class="nav w-nav" data-animation="default" data-collapse="medium" data-contain="1" data-duration="400">
        <div class="w-container">

          <div class="logo w-nav-brand" href="index.html">
            <a class="logo-link" href="/" >TAI TRAVIS</a>
          </div>

          <nav class="nav-menu w-nav-menu" role="navigation">
            <a class="nav-link w-nav-link w--current" data-name="home" href="/">Portfolio</a>
            <a class="nav-link w-nav-link colorbox-trigger" data-name="about" href="/about.html" href="/about.html">About</a>
            <a class="nav-link w-nav-link colorbox-trigger" data-name="contact" href="/contactform/index.html">Contact</a>
          </nav>

          <div class="menu-button w-nav-button">
            <div class="w-icon-nav-menu">
            </div>
          </div>

        </div>
      </div>
      <?php if(isset($options['header_content'])) {
              echo $options['header_content'];
            }
        ?>
    </div><!-- /.hero -->

    <div class="w-container">
