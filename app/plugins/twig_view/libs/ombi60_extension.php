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
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'productImgUrl';
    }
}
