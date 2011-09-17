<div id="ajaxBusy" style="margin: 0px; padding: 0px 2px; background-color: rgb(207, 67, 66); font-size: 9pt; color: white; position: fixed; right: 0px; top: 0px; width: auto; display:none;">Loading</div>
<?php if(isset($error)) { ?>
 <div class="flashError flashMessage"><?php echo $error ?></div>
<?php } ?>
<h4><?php echo count($group_products); ?> Products in this category </h4><br />
<?php 
  if (!empty($group_products) && is_array($group_products) ) { ?>
    <ul id="products" class="products_for_collections">
    <?php foreach($group_products as $product) { 
     
    ?>
      <li id="product_<?php echo $product['Product']['id'];?>" class="product_in_collection"> 
          <!-- <span class="imagebox"> -->
          <div class="small-product-image">
            <?php
               $image = "";
              if (!empty($product['ProductImage'])) {
                $image = "";
                //print(WWW_ROOT.'uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename']);
                if (file_exists(WWW_ROOT.'uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename'])) {
                  $image = '/uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename'];
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
          
            </div>
               
          <?php //if (isset($product['Product']['description'])) { echo $product['Product']['description'];} ?> 
          <?php echo //$this->Html->link($product['Product']['title'],array('controller' => 'collections','action' => 'admin_remove_product_from_group',$product_group_id,$product['Product']['id']),array('id' => 'remove'.$product['Product']['id'],'class' => 'removeProduct','escape' => true)); 
           $this->Html->link($product['Product']['title'],array('controller' => 'products','action' => 'view',$product['Product']['id'],'admin' => false),array('class' => 'floatLeft')); 
           
           
          ?> <?php echo $this->Html->link($this->Html->image('admin/delete.png'),array('controller' => 'collections','action' => 'admin_remove_product_from_group',$product_group_id,$product['Product']['id']),array('id' => 'remove_'.$product['Product']['id'],'class' => 'removeProduct','escape' => FALSE,'style' => 'float:right;')); ?> <br />               
          <div class="productnote">
          <?php 
           $vendor = ClassRegistry::init('Vendor');
           if (!empty($product['Product']['vendor_id'])) {               
              $vendor->id =  $product['Product']['vendor_id'];  
              $vendorName =  $vendor->field('title');
              echo $vendorName . ',';
            }
          ?>
          <?php echo $product['Product']['code']; ?>
          </div>
          <!--</div> -->

      </li>
    <?php } ?>  
    </ul>
<?php } ?>
