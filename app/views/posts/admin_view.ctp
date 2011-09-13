<div class="webpages">
    <div class="text_center">
        <h2>
          <?php echo $post['Post']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Blog']['id'], $post['Post']['id'])); ?>|
        <?php echo $this->Html->link(__('All articles'), array('controller' => 'blogs', 'action' => 'view', $post['Blog']['id'])); ?>|
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete this post?'), $post['Post']['id'])); ?>
          
  </div>
  <div class="view_textarea">
    <?php echo $post['Post']['content']; ?>
  </div>
  <div>
    <fieldset>
        <legend>Properties</legend>
        <label><?php echo __('Article Visibility');?></label>
 		<span class="hint">If you want to hide this article from your clients, choose</span>
 		<br>
 	<?php 
        echo $this->Form->input('Post.visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false, 'selected' => $post['Post']['visible'])); 
         ?>
	 
	 <?php 
	    echo $this->Ajax->observeField( 'PostVisible', 
		array(
		    'url' => array( 'action' => 'toggle',
				   'controller' => 'posts',
				   'admin' => true,
				   $post['Post']['id']),
		    //'complete' => 'alert(request.responseText)'
		) 
	    ); 
	?>
        <br>
        <?php        
  		echo $this->Form->input('Post.author', array('options' => $authors, 'selected' => $post['Author']['full_name']));  		
        //print $webpage['Author']['full_name'];?>
        <?php //print $post['Author']['full_name'];?>
        <br>
    </fieldset>
  </div>	
</div>

<!--<div class="posts view">
<h2><?php echo __('Post');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Blog'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($post['Blog']['title'], array('controller' => 'blogs', 'action' => 'view', $post['Blog']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Author'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($post['Author']['name'], array('controller' => 'authors', 'action' => 'view', $post['Author']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['visible']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['slug']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('No Comments'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['no_comments']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Allow Comments'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['allow_comments']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Allow Pingback'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['allow_pingback']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $post['Post']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Authors'), array('controller' => 'authors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author'), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Comments');?></h3>
	<?php if (!empty($post['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Author'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($post['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $comment['id'];?></td>
			<td><?php echo $comment['post_id'];?></td>
			<td><?php echo $comment['body'];?></td>
			<td><?php echo $comment['author'];?></td>
			<td><?php echo $comment['url'];?></td>
			<td><?php echo $comment['email'];?></td>
			<td><?php echo $comment['ip'];?></td>
			<td><?php echo $comment['status'];?></td>
			<td><?php echo $comment['created'];?></td>
			<td><?php echo $comment['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>-->
