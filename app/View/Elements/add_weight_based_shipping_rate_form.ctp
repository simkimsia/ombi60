<tr id="weight-form-<?php echo $id ;?>" style="display:none;">
    <td colspan="4" style="padding: 0px;">
<?php 
echo $this->Form->create('ShippingRate', array('url'=>array('action'=>'add_weight_based',
                                               'country_id'=>$country),
                                               'style' => 'width: 100%',
                                               ));
                                               ?>
        <table class="new-rate-table">
            <tr>
                <td class="new-rate rate-name" width="50%">
                    <?php echo $this->Form->input('ShippingRate.name', array('div'=>false, 'size' => 50)); ?>
                </td>
                <td class="new-rate rate-weight" width="25%">
                <?php
                    echo $this->Form->label('Weight');
                    echo $this->Form->text('WeightBasedRate.displayed_min_weight', array('value'=>'0.0', 'size'=>'3'));
                    echo $unitForWeight . ' - ';
                    echo $this->Form->text('WeightBasedRate.displayed_max_weight', array('value'=>'25.0', 'size'=>'3'));
                    echo $unitForWeight;
                    echo $this->Form->input('WeightBasedRate.unit', array('type'=>'hidden', 'value'=>$unitForWeight));
                ?>
                </td>

                <td class="new-rate rate-price" width="25%">
                <?php
                    echo $this->Form->label('Shipping Price');
                    echo "$".$this->Form->text('ShippingRate.price', array('value'=>'0.00', 'size'=>'3'))."SGD";
                ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="submit">
                    <?php
                        echo $this->Form->input('ShippingRate.shipped_to_country_id', array('type'=>'hidden','value'=>$id));
                        echo $this->Ajax->submit('Add Shipping Rate', array('url'=>array('action'=>'add_weight_based',
                                                                       'country_id'=>$country),
                                                                       'complete' => "afterAddRate($id, request.responseText);",
                                                                       'div'=>false));
                    ?>
                    &nbsp;or&nbsp;<a href="#" onclick="$('#weight-form-<?php echo $id;?>').hide();return false;">Cancel</a>
                    </div>
                </td>
            </tr>
        </table>
    <?php echo $this->Form->end(); ?>
    </td>
</tr>
