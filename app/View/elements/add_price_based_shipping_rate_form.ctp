<?php echo $this->element('admin_scripts');?>
<tr id="price-form-<?php echo $id ?>" style="display:none;">
    <td colspan="4" style="padding: 0px;">
        <?php echo $this->Form->create('ShippingRate', array('url' => array('action'=>'add_price_based', 'country_id'=>$country), 'style' => 'width: 100%'));?>
        <table class="new-rate-table">
            <tr>
                <td class="new-rate rate-name" style="background: #EFEFEF;" width="50%"><?php echo $this->Form->input('ShippingRate.name', array('div'=>false, 'size'=>50));?></td>
                <td class="new-rate rate-weight" style="background: #EFEFEF;" width="25%">
                    <?php 
                    echo $this->Form->label('Purchase range');
                    echo "$".$this->Form->text('PriceBasedRate.min_price', array('value'=>'50.00', 'size' => 5)). "SGD";?>

                    &nbsp;<a href="#" id="max-purchase-link-<?php echo $id;?>" onclick="showMaxPurchase(<?php echo $id ;?>);return false;">and more</a>
                    <span id="max-purchase-<?php echo $id ?>" style="display:none;">
                        <?php echo "&nbsp;-&nbsp;$&nbsp;".$this->Form->text('PriceBasedRate.max_price', array('id'=>'max-price-input-'.$id, 'size' => 5)) . "SGD";?>
                    </span>
                </td>

                <td class="new-rate rate-price" style="background: #EFEFEF;" width="25%">
                <?php 
                echo $this->Form->label('Shipping Price');
                echo "$".$this->Form->text('ShippingRate.price', array('value'=>'0.00', 'size' => 5))."SGD";
                ?>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="submit">
                        <?php
                            echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden','value'=>$id));

                            echo $this->Ajax->submit('Add Shipping Rate', array('url'=>array('action'=>'add_price_based',
                                                                                             'country_id'=>$country),
                                                                                           'complete' => "afterAddRate($id, request.responseText);",
                                                                                           'div'=>false));
                        ?>
                        &nbsp;or&nbsp;<a href="#" onclick="$('#price-form-<?php echo $id?>').hide();return false;">Cancel</a>
                    </div>

                </td>
            </tr>
        </table>
    <?php echo $this->Form->end(); ?>
    </td>
</tr>

