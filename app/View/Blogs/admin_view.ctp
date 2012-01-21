<div class="internal_forms">
    <div class="text_center">
        <h2><?php echo $blog['Blog']['title']; ?></h2>
        <?php echo $this->Html->link(__('Write a new article'), array('controller' => 'posts', 'action' => 'add_to_blog', 'blog_id'=>$blog['Blog']['id'])); ?>|
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id'])); ?>|
        <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete this blog?'))); ?>|
        <?php echo $this->Html->link(__('Back to Blogs'), array('controller'=>'webpages','action' => 'index')); ?>
    </div>


<?php if (!empty($posts)):?>
    <?php echo $this->element('action_buttons', array('modelName' => 'Post', 'deleteConfirm' => sprintf(__('Are you sure you want to delete this blog?')), 'deleteURL' => '/admin/blogs/delete/'.$blog['Blog']['id']));?>
	<table cellpadding = "0" cellspacing = "0" class="products-table">
	<tr>
	    <th>&nbsp;</th>
		<th width="60%"><?php echo __('Title'); ?></th>
		<th class="center_align" width="15%"><?php echo __('Created'); ?></th>
		<th class="center_align" width="15%"><?php echo __('Modified'); ?></th>
		<!--<th class="center_align" width="25%"><?php echo __('Actions');?></th>-->
	</tr>
	<?php
		$i = 0;
		foreach ($posts as $post):
			$post = $post['Post'];
			
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
		    <td width="5%" align="center"><?php echo $this->Form->input('check_box_id', array('value' => $post['blog_id'], 'class' => 'checkbox_check', 'type' => 'checkbox', 'label' => FALSE, 'div' => FALSE, 'style' => 'margin: 5px 6px 7px 20px;'));?></td>
			<td>
        <?php echo $this->Html->link($post['title'], array('controller' => 'posts', 'action' => 'view', $post['blog_id'], $post['id']));
           if (!(bool)$post['visible']) { ?>
            <span class="hidden_gray">Hidden</span>
        <?php }?>
      </td>
			<td><?php echo date('D, M dS Y, h:i', strtotime($post['created']));?></td>
			<td><?php echo date('D, M dS Y, h:i', strtotime($post['modified']));?></td>
			<!--<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', 'blog_id'=>$post['blog_id'],'id'=>$post['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'posts', 'action' => 'delete', 'blog_id'=>$post['blog_id'],'id'=>$post['id']), null, sprintf(__('Are you sure you want to delete this article?'), $post['id'])); ?>
			</td>-->
		</tr>
	<?php endforeach; ?>
	</table>
    <?php 
    if ($this->Paginator->params['paging']['Post']['pageCount'] > 1) {
    ?>
        <div class="text_center" style="width: 85%;">
            <?php echo $this->element('pagination', array('modelName' => 'Post'));?> 
        </div>
    <?php
    }
    ?>
	<?php endif; ?>
    
</div>
