<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
   <title>Red5v2 Dashboard</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/fancybox.js"></script>
<script src="http://www.google.com/jsapi"></script>
   <?= $_scripts ?>
   <?= $_styles ?>
   <?php print $header ?>
</head>

<body>
<a id="left-panel-link" href="#left-panel"></a>
	<div id="left-panel" class="panel">  <?php print $menu ?> </div>
  	<div id="wrapper" >
     		<div id="content"><?php print $contentheader ?><div class="options"><?php print $options ?></div> <?php print $content ?> </div>
  	<div id="footer"><?php print $footer ?></div>
  	</div>


</body>
<!-- must be loaded at end of page -->
<script src="/slider/jquery.panelslider.min.js"></script>
<script>
	$('#left-panel-link').panelslider();
</script>

<script>
$( "#toggle-button" ).click(function() {
$( "div.options" ).slideToggle( "slow" );
});
</script>
</html>
