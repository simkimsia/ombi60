<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Welcome to OMBI60!</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/layout.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/imagepreloader.js"></script>
<script type="text/javascript">
	preloadImages([
		'images/link-left-bg-hover.png', 
		'images/link-right-bg-hover.png', 
		'images/link-tail-bg-hover.png', 
		'images/link-1-hover.jpg',]);
</script>
</head>
<!--[if lt IE 7]>
   <script type="text/javascript" src="/git/ombi60_on_git/mainsite/js/ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png, .main-box-left, .main-box-right, .main-box-top-tail, .main-box-top-right, .main-box-top-left, .main-box-bottom, .main-box-bottom-right, .main-box-bottom-left, .link, .policy strong');
   </script>
<![endif]-->
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="/git/ombi60_on_git/mainsite/css/style-ie.css" />
<![endif]-->
<body id="page1">
<?php echo $this->element('head');?>
<?php echo $content_for_layout; ?>
<?php echo $this->element('foot');?>
</body>

</html>
