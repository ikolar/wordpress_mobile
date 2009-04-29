<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="si-SI" lang="si-SI">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="shortcut icon" href="http://www.blog.siol.net/favicon.ico" type="image/x-icon" />
  <style type="text/css">
    body { font-family: Helvetica, Arial, sans-serif; }
    img#blog_avatar { display: inline; vertical-align: top; padding: 5px 10px 0 0; width: 32px; }
    img { border: 0; }
    div#content img { max-width: 100%; }
    body { margin-top: 0; font-size: larger; width-max: 400px; }
    h1 { margin: 0; }
    h2.title { font-size: xx-large; }
    h2, h3, div.excerpt_header { background: blue; margin: 1.5em 0 0 0; }
    h2 a, h3 a, div.excerpt_header a { color: white; text-decoration: none; }

    ul#blogi { margin: 1em 0 1em 0; padding: 0; }
    ul#blogi li { list-style: none; margin-bottom: 1em; display: inline; }
    ul#blogi li img { padding-right: 0.5em; height: 80px; height: 80px; }
    ul#blogi a { text-decoration: none; }

    /* post dates with katarina-blog.si, and such */
    div.data, div.published_sm { margin: 1em 0 -1.5em 0; }
    div.published_sm div { display: inline; margin-right: 3px; }
  </style>
<?php
  $blog = preg_replace('/[^a-zA-Z0-9_.\/-]+/', "", strtolower($_REQUEST['blog']));
  $blog2 = preg_replace("/\//", "\\/", $blog);
  if ($blog != null) {
    $uri = $_REQUEST['uri'];

    $avatar = "http://blog.siol.net/wp-content/avatars/1-mini.jpg";
    $avatars_file = "AVATARS";
    $fh = fopen($avatars_file, 'r') or die("Could not open file ");
    while ($line = fgets($fh)) {
      $matches = array();
      if (preg_match("/^$blog2\t+(.*)/", $line, &$matches))
        $avatar = $matches[1];
    }
    fclose($fh);

    $server = "http://$blog.blog.siol.net/";
    if (preg_match('/\./', $blog)) {
      $server = $blog;
      if (! strpos($server, "http://") == 0) {
        $server = "http://" . $server;
      }
    }

    $_avatar = preg_replace('/\//', "\/", $avatar);
    $_server = preg_replace('/\//', "\/", $server);
    
    passthru("wget -q -O - \"$server/$uri\" | sed -nre 's/(<title>)?([^<]+)<\/title>/  <title>\\2<\/title>\\n<\/head>\\n<body>\\n\\n  <a href=\".\/\">(nazaj)<\/a><h1><img id=\"blog_avatar\" src=\"$_avatar\"\/>\\2<\/h1>$_server/p; /(<div id=\"content\"|<div id=\"columns\"|<div class=\"post\"|<div class=\"content\")/,/(sidebar|<div id=\"bottombarmenuwrapper\"|<div id=\"footer\")/p' | sed -rf clean.sed | sed -re '/<ul (class|id)=\"[^\"]*menu/,/<\/ul>/d'| sed -re '/(\.jpg|\.png|\.gif)\"/!s@<a href=\"http://(www.)?($blog2)/?([^\"]+)@<a href=\"$PHP_SELF?blog=\\2\&uri=\\3@gi; s/\s*onclick=\"javascript[^\"]+\"\\s*//g; s/\sheight=\"?[0-9]+\"?\s*//g;'");
  } else {
    $title = "Mobilni blogos"
?>
  <title><?= $title ?></title>
</head>
<body>

  <h1><?= $title ?></h1>

  <ul id="blogi">
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=techcrunch.com">
      <img src="images/avatars/avatar_techcrunch.com.gif">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=had.si/blog">
      <img src="http://s3.amazonaws.com/twitter_production/profile_images/53913785/logo_bigger.jpg">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=katarina-blog.si">
      <img src="images/avatars/avatar_katarina.jpg">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=susi">
      <img src="http://susi.blog.siol.net/wp-content/avatars/2010.jpg">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=bbk">
      <img src="http://bbk.blog.siol.net/wp-content/avatars/11868.gif">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=sadie007">
      <img src="http://sadie007.blog.siol.net/wp-content/avatars/1381.jpg">
    </a>
  </li>
  <li>
    <a href="<?php echo $PHP_SELF ?>?blog=irena">
      <img src="http://irena.blog.siol.net/wp-content/avatars/2.jpg"/>
    </a>
  </li>
</ul>

<form action="" method="get">
  <input type="text" name="blog"/><input type="submit" value="Ta blog hočem!"/>
</form>

<hr/>
Komentarji na <a href="mailto:ike@kiberpipa.org">ike@kiberpipa.org</a>
<?php } ?>

</body>
</html>