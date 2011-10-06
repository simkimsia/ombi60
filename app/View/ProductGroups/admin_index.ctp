<?php ?>
<div class="collections">
  <div class="text_center">
    <h2>
      <?php echo __('Product Collections'); ?>
    </h2>
      <?php 
        echo $this->Html->link(__('Create new Smart Collection'), array('action' => 'add_smart'));
        echo ' | '. $this->Html->link(__('Create new Custom Collection'), array('action' => 'add_custom'));
      ?>

  </div>
  <div class="list-smart-collections">
	<h2><?php echo __('Smart Collections');?></h2>
  <p>A smart collection is a collection of products that is based on certain rules.</p>
  <p>Examples: A collection where all the products are of a particular vendor, a collection where the prices are above a certain price</p>
  
  <br>
    
    <?php
//debug($smartCollections);
    if (!empty($smartCollections)) {
    ?>    
	<table cellpadding="0" cellspacing="0" class="products-table">
	    <tr>
		      <!--<th>&nbsp;</th>-->
			    <th><?php echo 'Title';?></th>
			    <th class="text_center"><?php echo 'Modified';?></th>
	    </tr>
	    <?php
	    $i = 0;
	    foreach ($smartCollections as $smartCollection):
		    $class = null;
		    if ($i++ % 2 == 0) {
			    $class = ' class="altrow"';
		    }
	    ?>
	    <tr<?php echo $class;?>>
		    <!--<td width="5%" align="center"><?php //echo $this->Form->input('check_box_id', array('value' => $collection['ProductGroup']['id'], 'class' => 'checkbox_check', 'type' => 'checkbox', 'label' => FALSE, 'div' => FALSE, 'style' => 'margin: 5px 6px 7px 20px;'));?></td>-->
		    <td width="60%">
          <?php echo $this->Html->link($smartCollection['ProductGroup']['title'], array('action' => 'view_smart', $smartCollection['ProductGroup']['id'])); 
                

                echo "<br />";
                echo "<span class='hint'>";
                echo count($smartCollection['ProductsInGroup']) . " product(s)";
                echo "</span>";
                unset($products);
                /*echo "<br />";
                echo "<span class='hint'>";
                echo count($smartCollection['SmartCollectionCondition']) . " product(s)";
                echo "</span>";*/

                if (!empty($smartCollection['SmartCollectionCondition'])) {                  
                  echo "<br />";
                  foreach ($smartCollection['SmartCollectionCondition'] as $smartCondition) {
                    echo "<span class='hint'>";
                    echo Inflector::camelize($smartCondition['field']) . " is ".$smartCondition['relation'] . " '". $smartCondition['condition']."'";
                    echo "</span>";
                    echo "<br />";
                  }
                }
                
            //if (!$collection['ProductGroup']['visible']) { ?>
                <!--<span class="hidden_gray">Hidden</span>-->
          <?php //} ?>
            </td>
		    <td width="35%" class="text_center"><?php echo date('D, M dS Y, h:i', strtotime($smartCollection['ProductGroup']['modified']));?></td>
	    </tr>
    <?php endforeach; ?>
	    </table>
	    
	    
    <?php
    }
    ?>
	

<div class="blogs">
	<h2><?php echo __('Custom Collections');?></h2>
	<p>A custom collection is a collection where you hand-pick the products to form a collection</p>
	<table cellpadding="0" cellspacing="0" class="products-table">
	<tr>
		
			<th><?php echo __('Title');?></th>
			<th class="text_center"><?php echo __('Modified');?></th>
			<!--<th class="actions text_center"><?php //__('Actions');?></th>-->
	</tr>
	<?php
	$i = 0;

	foreach ($customCollections as $collection):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td width="33%">
		<?php echo $this->Html->link(__($collection['ProductGroup']['title']), array('action' => 'view_custom', $collection['ProductGroup']['id'])); ?>
      <?php

        echo "<br />";
        echo "<span class='hint'>";
        echo count($collection['ProductsInGroup']) . " product(s)";
        echo "</span>";
      ?>
		</td>

		<td width="33%" class="text_center"><?php echo date('D, M dS Y, h:i', strtotime($collection['ProductGroup']['modified']));?></td>
		
		
		
	</tr>
	
<?php endforeach; ?>
	</table>
    </div>
</div>
