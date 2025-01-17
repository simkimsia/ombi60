<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<!-- Default Style -->
<!--<link href="style_default/style.css" type="text/css" media="screen" rel="stylesheet" />-->
<!-- Alternative Style -->
<!--<link href="style_alternative/style.css" type="text/css" media="screen" rel="stylesheet" />-->
<title>Error</title>
	
</head>

<body>
	
<div id="overallContainer" class="<?php if (!empty($classForContainer)) echo $classForContainer; ?>">
	
	<?php
                if (!empty($content_for_layout)) {
                        echo $content_for_layout;
                }
        ?>

</div>
</body>

</html>