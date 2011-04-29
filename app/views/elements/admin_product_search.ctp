<ul class="custom_product_list" style="display:block;">
  <?php
  //print_r($products);
  if (!empty($products)) {
    foreach ($products as $product) {
      ?>
        <?php if (in_array($product_group_id,$product['Product']['selected_collections'])) { ?>
          <li id="possible-product-<?php echo $product['Product']['id'];?>" class="tiny_with_thumb added">
       <?php } else { ?>
             <li id="possible-product-<?php echo $product['Product']['id'];?>" class="tiny_with_thumb">
        <?php } ?>
               
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
          <?php echo $this->Html->link($product['Product']['title'],array('controller' => 'collections','action' => 'admin_add_product_in_group',$product_group_id,$product['Product']['id']),array('id' => 'go_'.$product['Product']['id'],'class' => 'goWithProduct','escape' => true)); ?>                 
          
          <!--</div> -->
          <br/>
        </li>
        <br>
      <?php
    }
  }
  ?>
  
</ul>
