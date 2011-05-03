<?php
  echo $this->Html->script(array('admin_view_custom'), array('inline' => false));
?>
 <div id="search">
    <fieldset>
        <legend><?php __('Description', FALSE)?></legend>
        <div><?php print $productGroup['ProductGroup']['description'];?></div>
    </fieldset>
    
    <div id="startsearch">
        <!--Product Search page-->
        <h2><?php __('1. Start typing the name of a product')?></h2>
        <?php
            echo $this->Form->create('Product', array('url' => array('controller' => 'products', 'action' => 'search'), 'inputDefaults' => array('div' => false, 'label' => false)));
            echo $this->Form->input('title');
            echo $this->Form->input('product_group_id', array('value' => $productGroup['ProductGroup']['id'], 'type' => 'hidden'));
            echo $this->Form->submit('Search', array('url'=>array('controller' => 'products', 'action'=>'search'),
                                                //'complete' => "afterAddLink($linkListId, request.responseText);",
                                                'div'=>false,'id' => 'adminCustomViewSubmit'));
            //echo $this->Form->submit('Search', array('div' => false));
            echo $this->Form->end();
        ?>
        <p><?php __("You can narrow down the list of products by typing a few letters of a product's title.", false);?></p>
        <br />
        <h2><?php __('2. Select products you want to add', FALSE)?></h2>
        <div id="productsearchlist">
          <?php echo $this->element('admin_product_search');?>
        </div>
    </div> <!-- end startsearch -->
    <div id="searchresult">
        <!--Product Group List page-->
       
        <?php echo $this->element('admin_product_group_list'); ?>
        
    </div>
    <div style="clear: both;"></div>
  </div> <!-- end search -->
