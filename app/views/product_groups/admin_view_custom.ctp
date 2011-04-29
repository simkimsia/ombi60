<?php
  echo $this->Html->script(array('admin_view_custom'), array('inline' => false));
?>
<style>
  .collections #search #startsearch{
    float: left; 
    width: 350px; 
    border: 1px solid #e4e4e4; 
    padding: 7px; 
    margin-right: 21px;
  }
  .collections #search #startsearch h2 {
    font-size: 110%;
    font-weight: bold;
    color: #000000;    
    margin: 5px 10px;
  }
  .collections #search #startsearch p {
    margin: 5px 10px;
  }
  
  .collections #search #startsearch input[type=text] {
    width: 70%;
    margin: 10px 10px 10px 0px;
  }

  .collections #search #startsearch ul {
    padding: 10px;
  }

  .collections #search #startsearch ul li{
    list-style: none;
  }
  .collections #search #startsearch ul li .imagebox{
    float: left;
    width: 50px;
    min-height: 20px;
  }

  .collections #search #startsearch ul li .description{
    float: left;
    width: 200px;
  }

  .collections #search #startsearch ul li .go{ 
    float: left;
    width: 30px;
    background: url('../img/');
  }
  .collections #search #searchresult{
    float: left; 
    width: 795px; 
    border: 1px solid #e4e4e4; 
    padding: 5px;
  }
</style>
<?php

?>
<div class="collections">
    <div class="text_center">
        <h2>
          <?php echo $productGroup['ProductGroup']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit_custom', $productGroup['ProductGroup']['id'])); ?>
        &nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productGroup['ProductGroup']['id']), null, sprintf(__('Are you sure you want to delete this collection?', true), $productGroup['ProductGroup']['id'])); ?>&nbsp;|&nbsp;
          <?php echo $this->Html->link(__('Back to Collections', true), array('action' => 'index')); ?>
  </div>
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
    </div>
    <div id="searchresult">
        <!--Product Group List page-->
       
        <?php echo $this->element('admin_product_group_list'); ?>
        
    </div>
    <div style="clear: both;"></div>
  </div>
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php __('Page Visibility');?></label>
 		<span class="hint">If you want to hide this collection from your clients, choose hidden.</span>
 		<br>
 	<?php 
        echo $this->Form->input('ProductGroup.visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $productGroup['ProductGroup']['visible'])); 
         ?>
	 
	 <?php 
	    echo $this->Ajax->observeField( 'ProductGroupVisible', 
		array(
		    'url' => array( 'action' => 'toggle',
				   'controller' => 'product_groups',
				   'admin' => true,
				   $productGroup['ProductGroup']['id']),
		    //'complete' => 'alert(request.responseText)'
		) 
	    ); 
	?>
        <br>        
        
        
    </fieldset>
  </div>	
</div>
