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
		
		return $url;
	}
	
	
	if (preg_match("/\.js$/", $filename)) {
		
		if ($filename[0] !== '/') {
			$filename = JS_URL . $filename;
		}
		
		if (strpos($filename, '?') === false) {
			if (substr($filename, -4) !== '.js') {
				$filename .= '.js';
			}
		}
		$url = $htmlHelper->assetTimestamp($htmlHelper->webroot($filename));
		
		return $url;
	}
	// not fixed yet
	if (preg_match("/\.png$/", $filename)) {
		
		if ($filename[0] !== '/') {
			$filename = JS_URL . $filename;
		}
		
		if (strpos($filename, '?') === false) {
			if (substr($filename, -4) !== '.js') {
				$filename .= '.js';
			}
		}
		$url = $htmlHelper->assetTimestamp($htmlHelper->webroot($filename));
		
		return $url;
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
