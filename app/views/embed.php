<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <title><?= $viewname ?></title>

<script src="http://red5v2.reachbig.com/js/jquery.min.js" type="text/javascript"></script>
   <?= $_scripts ?>
   <?= $_styles ?>
<link href="http://red5.reachbig.com/css/embed.css" rel="stylesheet" type="text/css"></link>
<?php print $header ?>

</head>
<body>
<div id="options"><?php print $options ?></div>

      <?php print $content ?>
</body>
<script>
$( "#toggle-button" ).click(function() {
$( "div.options" ).slideToggle( "slow" );
});
</script>

</html>
