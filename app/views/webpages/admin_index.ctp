<div class="webpages">
  <div class="text_center">
    <h2>
      <?php __('Blogs & Pages'); ?>
    </h2>
      <?php 
        echo $this->Html->link(__('Create new Blog', true), array('controller'=>'blogs','action' => 'add'));
        echo ' | '. $this->Html->link(__('Create new Page', true), array('action' => 'add'));
      ?>

  </div>
  <div class="list-pages">
	<h2><?php __('Pages');?></h2>
  <p>A page is a standalone part of your shop informing your customers about your business or products.</p>
  <p>Examples: "About Us" section, Warranty, Terms of Service</p>
  
  <br>
    
    <?php
    if (!empty($webpages)) {
    ?>
    <?php echo $this->element('action_buttons', array('modelName' => 'Webpage', 'deleteConfirm' => sprintf(__('Are you sure you want to delete this page?', true)), 'deleteURL' => ''));?>
    
	<table cellpadding="0" cellspacing="0" class="products-table" id="webpages-table">
	    <tr>
		        <th>&nbsp;</th>
			    <th><?php echo $this->Paginator->sort('title');?></th>
			    <th class="text_center"><?php echo $this->Paginator->sort('modified');?></th>
	    </tr>
	    <?php
	    $i = 0;
	    foreach ($webpages as $webpage):
		    $class = null;
		    $hidden = (!$webpage['Webpage']['visible']) ;
		    $hiddenCheckboxClass = '';
		    if ($hidden) {
		      $hiddenCheckboxClass = ' hidden';
		    }
		    if ($i++ % 2 == 0) {
			    $class = ' class="altrow"';
		    }
	    ?>
	    <tr<?php echo $class;?>>
		    <td width="5%" align="center"><?php echo $form->input('check_box_id', array('value' => $webpage['Webpage']['id'], 'class' => 'checkbox_check' . $hiddenCheckboxClass, 'type' => 'checkbox', 'label' => FALSE, 'div' => FALSE, 'style' => 'margin: 5px 6px 7px 20px;'));?></td>
		    <td width="60%">
          <?php echo $this->Html->link($webpage['Webpage']['title'], array('action' => 'view', $webpage['Webpage']['id'])); 
            
	      if ($hidden) {
	      ?>
                <span class="hidden_gray">Hidden</span>
          <?php } ?>
            </td>
		    <td width="35%" class="text_center"><?php echo date('D, M dS Y, h:i', strtotime($webpage['Webpage']['modified']));?></td>
	    </tr>
    <?php endforeach; ?>
	    </table>
	    
	    <?php 
        if ($paginator->params['paging']['Webpage']['pageCount'] > 1) {
        ?>
            <div class="text_center" style="width: 85%;">
                <?php echo $this->element('pagination', array('modelName' => 'Webpage'));?> 
            </div>
              
        <?php
        }
        ?>
    <?php
    }
    ?>
	

<div class="blogs">
	<h2><?php __('Blogs');?></h2>
	<p>A blogs is a series of articles for content that changes frequently such as news and updates about your shop.</p>
	<table cellpadding="0" cellspacing="0" class="products-table">
	<tr>
		
			<th><?php __('Title');?></th>
			<th class="text_center"><?php __('Modified');?></th>
			<th class="actions text_center"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($blogs as $blog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		
		<td width="33%">
		<?php echo $this->Html->link(__($blog['Blog']['title'], true), array('controller'=>'blogs','action' => 'view', $blog['Blog']['id'])); ?>
		</td>

		<td width="33%" class="text_center"><?php echo date('D, M dS Y, h:i', strtotime($blog['Blog']['modified']));?></td>
		
		
		<td class="actions">
		    <?php echo $this->Html->link(__('Write a new article', true), array('controller' => 'posts', 'action' => 'add', 'blog_id'=>$blog['Blog']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('controller'=>'blogs','action' => 'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete this blog?', true))); ?>
		</td>
	</tr>
	
<?php endforeach; ?>
	</table>
    </div>
</div>
