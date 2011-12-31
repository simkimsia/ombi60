<ul class="custom_product_list" style="display:block;">
  <?php
  //print_r($products);
  if (!empty($products)) {
    foreach ($products as $product) {
      ?>
        <?php if (in_array($product_group_id,$product['selected_collections'])) { ?>
          <li id="possible-product-<?php echo $product['id'];?>" class="tiny_with_thumb added">
       <?php } else { ?>
             <li id="possible-product-<?php echo $product['id'];?>" class="tiny_with_thumb">
        <?php } ?>
               
          <span class="imagebox">
            <?php
                $image = "";
              if (!empty($product['CoverImage'])) {
                $image = "";
                if (file_exists(WWW_ROOT.'uploads/products/thumb/icon/'.$product['CoverImage']['filename'])) {
                  $image = '../uploads/products/thumb/icon/'.$product['CoverImage']['filename'];
                } else {
                  $image = '/uploads/products/thumb/icon/default-0.jpg';
                }
              } else {
                 $image = '/uploads/products/thumb/icon/default-0.jpg';
              }
              ?>
            <?php 
              if (isset($image) && !empty($image)) {
              echo $this->Html->image($image);
              }
             ?>
            <?php //echo $this->Html->image($product);
            
            ?>
          </span>
          <!--<div class="description"> -->
          <?php //if (isset($product['description'])) { echo $product['description'];} ?> 
          <?php echo $this->Html->link($product['title'],array('controller' => 'collections','action' => 'admin_add_product_in_group',$product_group_id,$product['id']),array('id' => 'go_'.$product['id'],'class' => 'goWithProduct','escape' => true)); ?>                 
          
          <!--</div> -->
          <br/>
        </li>
        <br>
      <?php
    }
  }
  ?>
  
</ul>
