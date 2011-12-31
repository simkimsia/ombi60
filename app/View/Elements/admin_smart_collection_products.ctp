<div>
  <fieldset>
    <legend><?php echo __(count($products). " Products in this collection"); ?></legend>
    <?php
      if (count($products) > 0) {
        ?>
          <ul id="smart-products">
            <?php
              foreach ($products as $product) {
                ?>
                <li>
                  <div class="smart-products-desc">
                    <?php
                    $image = "";
                    if (!empty($product['CoverImage'])) {
                      $image = "";
                      //print(WWW_ROOT.'uploads/products/thumb/icon/'.$product['ProductImage'][0]['filename']);
                      if (file_exists(WWW_ROOT.'uploads/products/thumb/icon/'.$product['CoverImage']['filename'])) {
                        $image = '/uploads/products/thumb/icon/'.$product['CoverImage']['filename'];
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
                  <div class="smart-products-desc">
                      <?php echo $this->Html->link($product['title'],array('controller' => 'products','action' => 'view',$product['id'],'admin' => true),array('class' => '')); ?>
                      <?php 
                        if (0 == $product['visible']) {
                            ?><span style="background: #CCCCCC"><?php echo __('Hidden');    ?></span><?php
                            
                        }        
                      ?>  
                  </div>
                  <div style="clear: both;"></div>
                </li>
                <?php
              }
            ?>
          </ul>
        <?php
      }
    ?>
  </fieldset>
  
</div>