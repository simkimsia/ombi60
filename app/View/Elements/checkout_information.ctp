<?php
	$totalAmountWithShipping = $currentCart['Cart']['amount'];
?>
<div id="checkout_warning">
    <?php echo $this->Html->image('lock.gif', array('class' => 'margin_right_5'));?>
    <span class="font_bold"><?php echo __('You are using our secure server ');?></span>
</div>
<div class="clear">&nbsp;</div>
<div class="checkout_products">
    <div class="products_list_left">
        <span class="youarebuying">You're buying...</span>
        <ul>
		<?php
		$items = $currentCart['CartItem'];
		foreach($items as $key=>$item) :
			$image = $item['CoverImage'];
			$imagePath = 'no-image.jpeg';
			if (!empty($image['filename'])) {
				$imagePath = '/' . $image['dir'] . '/thumb/small/' . $image['filename'];
			}
		?>
            <li>
                <div class="left product_thumb">
                    <?php echo $this->Html->image($imagePath, array('class' => 'product_image'));?>
                </div>
                <div class="left product_thumb">
                    <span class="font_bold"><?php echo $item['product_title']; ?></span>
                    <br />
                    <span><?php echo $item['product_quantity'] . ' x ' . $item['product_price']; ?></span>
                </div>
                <div class="clear"></div>
            </li>
		<?php
		endforeach;
		?>
          
        </ul>
    </div>
    <div class="product_list_right">
        <span class="bold_green">
        <?php echo $total = $this->Number->format($totalAmountWithShipping, array('places' => 2, 'escape' => false, 'decimals' => '.', 'before' => '$'));
        ?>
        
        <?php //echo $this->Number->currency($total, 'SGD'); ?></span>
        <br />
        <?php
        if (isset($is_shipping_included) && $is_shipping_included) {
            ?>
                <span class="red_text">including shipping for <span class="cost"><?php echo $shipping_cost?></span></span>
            <?php
        }
        ?>
        <br />
        <span class="steps">Step <?php echo $step;?> of 2</span>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="clear">&nbsp;</div>
