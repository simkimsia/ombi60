<div class="webpages main-container-div">
    <div class="text_center">
      <h2><?php echo $this->data['Post']['title']; ?></h2>
      <?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('Blog.id'), $this->Form->value('Post.id'))); ?>|
        <?php echo $this->Html->link(__('All articles', true), array('controller' => 'blogs', 'action' => 'view', $this->Form->value('Blog.id'))); ?>|
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Post.id')), null, sprintf(__('Are you sure you want to delete this post?', true))); ?>
    </div>
    <?php echo $this->Form->create('Post', array('url'=>Router::url(array('controller'=>'posts',
							      'action'=>'edit',
							      'blog_id'=>$blog_id,
							      'id'=>$this->data['Post']['id']),true)));?>
	<fieldset>
 		<legend><?php __('Edit this article'); ?></legend>
	<?php
	
	$this->TinyMce->editor(array(
			'theme' => 'advanced',
			'mode' => 'textareas',
			'plugins' => ' table',
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
			'theme_advanced_buttons2' => '',
			'remove_linebreaks' => false,
			'theme_advanced_toolbar_location' => 'top',
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
	
		echo $this->Form->input('id');
		
		
		echo $this->Form->input('title');
  $label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Post.slug', array('class' => 'small'));
		$prefix = Router::url('/blogs/'.$this->data['Blog']['short_name'].'/'.$this->data['Post']['id'].'-', true);		
        $suffix = ' ( ' . $this->Html->link(__('What is this?', true), '#') . ' )';
		echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
		
		
		
			
	?>
	</fieldset>
	<fieldset>
 		<legend><?php __('Properties'); ?></legend>
 		<label><?php __('Article Visibility');?></label>
 		<span class="hint">If you want to hide this article from your clients, choose hidden.</span>
 		
    <?php
		  echo $this->Form->input('Webpage.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false));
		  echo $this->Form->input('Webpage.author', array('options' => $authors));
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Update', true), array('div' => false));?> &nbsp;<?php __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'blogs','action' => 'view', $this->Form->value('Blog.id'))); ?>
  </div>
  <?php echo $this->Form->end();?>
</div>




<!--<div class="posts">
    <div class="text_center">
        <h2>
          <?php echo $this->data['Post']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Blog']['id'], $post['Post']['id'])); ?>|
        <?php echo $this->Html->link(__('All articles', true), array('controller' => 'blogs', 'action' => 'view', $post['Blog']['id'])); ?>|
          <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete this post?', true), $post['Page']['id'])); ?>
  </div>
  
<?php echo $this->Form->create('Post', array('url'=>Router::url(array('controller'=>'posts',
							  'action'=>'edit',
							  'blog_id'=>$blog_id,
							  'id'=>$this->data['Post']['id']),true)));?>
	<fieldset>
 		<legend><?php __('Admin Edit Post'); ?></legend>
	<?php
	
	$this->TinyMce->editor(array(
			'theme' => 'advanced',
			'mode' => 'textareas',
			'plugins' => ' table',
			'theme_advanced_buttons1' => 'bold,italic,underline,undo,redo,link,unlink,forecolor,styleselect,removeformat,cleanup,code,table,fontselect,fontsizeselect',
			'theme_advanced_buttons2' => '',
			'remove_linebreaks' => false,
			'extended_valid_elements' => 'textarea[cols|rows|disabled|name|readonly|class]'));
	
		echo $this->Form->input('id');
		echo $this->Form->input('blog_id', array('type'=>'hidden', 'value'=>$blog_id));
		echo $this->Form->input('author_id');
		echo $this->Form->input('status',array('options' => array('1'=>'Published', '0'=>'Hidden')));
		echo $this->Form->input('title');
		
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Post.slug');
		$prefix = Router::url('/blogs/'.$this->data['Blog']['short_name'].'/'.$this->data['Post']['id'].'-', true);
		echo $this->Html->div('input text', $label.$prefix.$textbox ,array(), true);
		
		echo $this->Form->input('body');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', 'id'=>$this->Form->value('Post.id'), 'blog_id'=>$this->Form->value('Post.blog_id')), null, sprintf(__('Are you sure you want to delete %s?', true), $this->Form->value('Post.title'))); ?></li>
		
	</ul>
</div>-->
