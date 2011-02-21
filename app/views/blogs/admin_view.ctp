<div class="internal_forms main-container-div index">
    <div class="text_center">
        <h2><?php echo $blog['Blog']['name']; ?></h2>
        <?php echo $this->Html->link(__('Write a new article', true), array('controller' => 'posts', 'action' => 'add', 'blog_id'=>$blog['Blog']['id'])); ?>|
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $blog['Blog']['id'])); ?>|
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $blog['Blog']['id']), null, sprintf(__('Are you sure you want to delete this blog?', true), $blog['Blog']['id'])); ?>|
        <?php echo $this->Html->link(__('Back to Blogs', true), array('controller'=>'webpages','action' => 'index')); ?>
    </div>


<?php if (!empty($blog['Post'])):?>
    <div class="pagination-margin">
      <span class="paginator-top">
        <?php
        echo $paginator->counter(array(
        'format' => __('Showing %current% articles out of %count% total. Page %page% of %pages%', true)
        ));
        ?>
      </span>
      <?php
      if ($paginator->params['paging']['Post']['pageCount'] > 1) {
      ?> 
        <span class="top-paging">
            <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
         |  <?php echo $paginator->numbers();?>
            <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
        </span>
      <?php 
      } 
      ?>
    </div>
	<table cellpadding = "0" cellspacing = "0" class="products-table">
	<tr>
		<th width="45%"><?php __('Title'); ?></th>
		<th class="center_align" width="15%"><?php __('Created'); ?></th>
		<th class="center_align" width="15%"><?php __('Modified'); ?></th>
		<th class="center_align" width="25%"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blog['Post'] as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
        <?php echo $this->Html->link($post['title'], array('controller' => 'posts', 'action' => 'view', $post['blog_id'], $post['id']));
           if (!(bool)$post['status']) { ?>
            <span class="hidden_gray">Hidden</span>
        <?php }?>
      </td>
			<td><?php echo date('D, M dS Y, h:i', strtotime($post['created']));?></td>
			<td><?php echo date('D, M dS Y, h:i', strtotime($post['modified']));?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'posts', 'action' => 'edit', 'blog_id'=>$post['blog_id'],'id'=>$post['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'posts', 'action' => 'delete', 'blog_id'=>$post['blog_id'],'id'=>$post['id']), null, sprintf(__('Are you sure you want to delete this article?', true), $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	<?php
    if ($paginator->params['paging']['Post']['pageCount'] > 1) {
    ?> 
    <div class="bottom-paging">
        <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
     |  <?php echo $paginator->numbers();?>
        <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
    <?php 
    } 
    ?>
	<?php endif; ?>
    
</div>
