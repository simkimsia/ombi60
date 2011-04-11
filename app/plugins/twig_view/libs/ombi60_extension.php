<?php

/**
 * Wrapper to $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $image['ProductImage']['filename'],
											array('id'=>'small_'.$key));
 */
function ombi60ProductImgUrl($filename, $size) {
        /*
        $html = new HtmlHelper();
        return $html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_URL . $size . '/' . $filename);
        */
        return '/img/' . UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_URL . $size . '/' . $filename;
}

/**
 * Wrapper to $this->Html->image(UP_ONE_DIR_LEVEL . PRODUCT_IMAGES_THUMB_SMALL_URL . $image['ProductImage']['filename'],
											array('id'=>'small_'.$key));
 */
function ombi60MoneyWithCurrency($price) {
        App::import('Model', 'Shop');
	$money = Shop::get('ShopSetting.money_in_html_with_currency');
	App::import('Helper', 'Number');
	$number = new NumberHelper();
	
	if (strpos($money, '{{amount}}') !== false) {
		$price = $number->precision($price, 2);
		$price = str_replace('{{amount}}', $price, $money);
	} else if (strpos($money, '{{amount_with_no_decimals}}') !== false){
		$price = $number->precision($price, 0);
		$price = str_replace('{{amount_with_no_decimals}}', $price, $money);
	} 
	
	return $price;
}

function ombi60Money($price) {
        App::import('Model', 'Shop');
	$money = Shop::get('ShopSetting.money_in_html');
	App::import('Helper', 'Number');
	$number = new NumberHelper();
	
	if (strpos($money, '{{amount}}') !== false) {
		$price = $number->precision($price, 2);
		$price = str_replace('{{amount}}', $price, $money);
	} else if (strpos($money, '{{amount_with_no_decimals}}') !== false){
		$price = $number->precision($price, 0);
		$price = str_replace('{{amount_with_no_decimals}}', $price, $money);
	} 
	
	return $price;
}


/**
 * this is for cakephp framework
 * Web path to the CSS files directory.
 */
if (!defined('CSS_URL')) {
	define('CSS_URL', 'css/');
}

if (!defined('JS_URL')) {
	define('JS_URL', 'js/');
}

if (!defined('IMAGES_URL')) {
	define('IMAGES_URL', 'img/');
}

function ombi60AssetUrl($filename) {
	// we need to use HtmlHelper existing in cakephp currently
	// in future we may use cdn otherwise or whatever
	App::import('Helper', 'Html');
	$htmlHelper = new HtmlHelper();
	
	// we need to set the theme as well
	App::import('Model', 'Shop');
	$shopId = Shop::get('Shop.id');
	$currentShop = Cache::read('Shop'.$shopId);
	$htmlHelper->theme = !empty($currentShop['FeaturedSavedTheme']['folder_name']) ? $currentShop['FeaturedSavedTheme']['folder_name'] : 'blue-white';
	
	// we need to differentiate between css, js and image files
	// check for .css, .js, and all possible image extensions based on the filename.
	if (preg_match("/\.css$/", $filename)) {
		
		if ($filename[0] !== '/') {
			$filename = CSS_URL . $filename;
		}
		
		if (strpos($filename, '?') === false) {
			if (substr($filename, -4) !== '.css') {
				$filename .= '.css';
			}
		}
		$url = $htmlHelper->assetTimestamp($htmlHelper->webroot($filename));
		
		return '/' . $url;
	}
	
	
	if (preg_match("/\.js$/", $filename)) {
		
		if ($filename[0] !== '/') {
			$filename = JS_URL . $filename;
		}
		
		if (strpos($filename, '?') === false) {
			if (substr($filename, -3) !== '.js') {
				$filename .= '.js';
			}
		}
		$url = $htmlHelper->assetTimestamp($htmlHelper->webroot($filename));
		
		return '/' . $url;
	}
	// should be limited to these file extensions for time being
	if (preg_match("/\.png|.jpg|.jpeg|.gif|.tiff$/", $filename)) {
		
		if ($filename[0] !== '/') {
			$filename = IMAGES_URL . $filename;
		}
		
		
		$url = $htmlHelper->assetTimestamp($htmlHelper->webroot($filename));
		
		return '/' . $url;
	}
}

/**
 * returns <img src="url...", alt="" />
 **/
function ombi60ImgTag($url, $alt="") {
	// keep it simple, no need to escape characters or check if image exists
	return '<img src="'.$url.'" alt="'.$alt.'" />';
}

/**
 * returns <script src="url..."/>
 **/
function ombi60ScriptTag($url) {
	return '<script  type="text/javascript" src="'.$url.'"></script>';
}

/**
 * returns <script src="url..."/>
 **/
function ombi60CssTag($url) {
	return '<link rel="stylesheet" type="text/css" href="'.$url.'" />' ;
}

function ombi60LinkTo($title, $url, $titleAttribute="") {
	// we need to use HtmlHelper existing in cakephp currently
	// in future we may use cdn otherwise or whatever
	App::import('Helper', 'Html');
	$htmlHelper = new HtmlHelper();
	
	return $htmlHelper->link($title, $url, array('title'=>$titleAttribute));
}

function ombi60Camelize($input) {
	$input = ucwords($input);
	$input = preg_replace("/[^a-zA-Z0-9]/", "", $input);
	return lcfirst($input);
}

function ombi60Handle($input) {
	$input = strtolower($input);
	$input = str_replace(' ', '-', $input);
	while (strpos($input, '--') !== false) {
		$input = str_replace('--', '-', $input);
	}
	$input = preg_replace("/[^a-zA-Z0-9\-]/", "", $input);
	return $input;
}

function ombi60Implode($glue, $pieces) {
	return implode($glue, $pieces);
}

function ombi60Pluralize($number, $singular, $plural) {
	if ($number == 1) {
		return $number . ' ' . $singular;
	} else {
		return $number . ' ' . $plural;
	}
}

function ombi60TruncateString($input, $length = 100, $endsWith = '...') {
	return substr($input, 0, $length) . $endsWith;
}

function ombi60TruncateWords($input, $words = 15, $endsWith = '...') {
	$tok = strtok($input, " \n\t");
	$count = 0;
	$result = '';
	while ($tok !== false && $count <= $words) {
		$count += 1;
		$result .= $tok;
		$tok = strtok(" \n\t");
	}
	
	return $result;
}

function ombi60WeightWithUnit($weight_in_grams) {
	App::import('Model', 'Shop');
	$unit = Shop::get('ShopSetting.unit_system');
	
	App::import('Helper', 'Number');
	$number = new NumberHelper();
	
	$result_weight = 0.0;
	if ($unit === 'metric') {
		$result_weight =  $weight_in_grams * 0.001;
		return $number->precision($result_weight, 1) . ' kg';
	} else {
		$result_weight =  $weight_in_grams * 0.00220462262;
		return $number->precision($result_weight, 1) . ' lb';
	}
}

/**
 * Product Image Url
 * Use: {{ product.images[0] | product_img_url : 'large' }}
 *
 * @author kimsia <kimcity@gmail.com>
 */
class Ombi60_Twig_Extension extends Twig_Extension
{
	
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'product_img_url' => new Twig_Filter_Function('ombi60ProductImgUrl'),
	    'money_with_currency' => new Twig_Filter_Function('ombi60MoneyWithCurrency'),
	    'money' => new Twig_Filter_Function('ombi60Money'),
	    'asset_url' => new Twig_Filter_Function('ombi60AssetUrl'),
	    'img_tag' => new Twig_Filter_Function('ombi60ImgTag'),
	    'script_tag' => new Twig_Filter_Function('ombi60ScriptTag'),
	    'css_tag' => new Twig_Filter_Function('ombi60CssTag'),
	    'link_to' => new Twig_Filter_Function('ombi60LinkTo'),
	    'camelize' => new Twig_Filter_Function('ombi60Camelize'),
	    'handleize' => new Twig_Filter_Function('ombi60Handle'),
	    'implode' => new Twig_Filter_Function('ombi60Implode'),
	    'pluralize' => new Twig_Filter_Function('ombi60Pluralize'),
	    'truncate' => new Twig_Filter_Function('ombi60Truncate'),
	    'truncatewords' => new Twig_Filter_Function('ombi60TruncateWords'),
	    'weight_with_unit' => new Twig_Filter_Function('ombi60WeightWithUnit'),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ombi60';
    }
}