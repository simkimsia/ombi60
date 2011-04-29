<?php if(isset($error)) { ?>
 <div class="flashError flashMessage"><?php echo $error ?></div>
<?php } ?>
<h4><?php echo count($group_products); ?> products in this category </h4>
<?php 
  if (!empty($group_products) && is_array($group_products) ) { ?>
    <ul id="products" class="products_for_collections">
    <?php foreach($group_products as $product) { 
     //print_r($group_products);
    ?>
      <li id="product_<?php echo $product['Product']['id'];?>" class="product_in_collection"> 
           <span class="imagebox">
            <?php
              if (!empty($product['ProductImage'])) {
                $image = "";
                if (file_exists(WWW_ROOT.'uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename'])) {
                  $image = '../uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename'];
                } else {
                  $image = '/uploads/products/thumb/icon/default-0.jpg';
                }
              }
              ?>
            <?php 
             if (isset($image)) {
              echo $this->Html->image($image);
             }
             ?>
            <?php //echo $this->Html->image($product);
            
            ?>
          </span>
          <!--<div class="description"> -->
          <?php //if (isset($product['Product']['description'])) { echo $product['Product']['description'];} ?> 
          <?php echo $this->Html->link($product['Product']['title'],array('controller' => 'collections','action' => 'admin_remove_product_from_group',$product_group_id,$product['Product']['id']),array('id' => 'remove'.$product['Product']['id'],'class' => 'removeProduct','escape' => true)); ?>  <br />               
          <?php echo $product['Product']['description']; ?>
          
          <!--</div> -->

      </li>
    <?php } ?>  
    </ul>
<?php } ?>

