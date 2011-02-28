<div id="checkout_warning">
    <?php echo $html->image('lock.gif', array('class' => 'margin_right_5'));?>
    <span class="font_bold"><?php __('You are using our secure server ');?></span>
</div>
<div class="clear">&nbsp;</div>
<div class="checkout_products">
    <div class="products_list_left">
        <span class="youarebuying">You're buying...</span>
        <ul>
            <li>
                <div class="left product_thumb">
                    <?php echo $html->image('no-image.jpeg', array('class' => 'product_image'));?>
                </div>
                <div class="left product_thumb">
                    <span class="font_bold">Product 1</span>
                    <br />
                    <span>2x $10.00</span>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="left product_thumb">
                    <?php echo $html->image('no-image.jpeg', array('class' => 'product_image'));?>
                </div>
                <div class="left product_thumb">
                    <span class="font_bold">Product 1</span>
                    <br />
                    <span>2x $10.00</span>
                </div>
                <div class="clear"></div>
            </li>
            <li>
                <div class="left product_thumb">
                    <?php echo $html->image('no-image.jpeg', array('class' => 'product_image'));?>
                </div>
                <div class="left product_thumb">
                    <span class="font_bold">Product 1</span>
                    <br />
                    <span>2x $10.00</span>
                </div>
                <div class="clear"></div>
            </li>
        </ul>
    </div>
    <div class="product_list_right">
        <span class="bold_green">
        <?php echo $total = $this->Number->format($totalAmountWithShipping, array('places' => 2, 'escape' => false, 'decimals' => '.', 'before' => '$'));
        ?>
        <?php //echo $this->Number->currency($total, 'SGD'); ?></span>
        <br />
        <span class="steps">Step 1 of 2</span>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="clear">&nbsp;</div>
