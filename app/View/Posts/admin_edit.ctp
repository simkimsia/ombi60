<div class="webpages main-container-div">
    <div class="text_center">
      <h2><?php echo $this->request->data['Post']['title']; ?></h2>
      <?php echo $this->Html->link(__('View'), array('action' => 'view', $this->Form->value('Blog.id'), $this->Form->value('Post.id'))); ?>|
        <?php echo $this->Html->link(__('All articles'), array('controller' => 'blogs', 'action' => 'view', $this->Form->value('Blog.id'))); ?>|
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), null, sprintf(__('Are you sure you want to delete this post?'))); ?>
    </div>
    <?php echo $this->Form->create('Post', array('url'=>Router::url(array('controller'=>'posts',
							      'action'=>'edit',
							      'blog_id'=>$blog_id,
							      'id'=>$this->request->data['Post']['id']),true)));?>
	<fieldset>
 		<legend><?php echo __('Edit this article'); ?></legend>
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
		$prefix = Router::url('/blogs/'.$this->request->data['Blog']['short_name'].'/'.$this->request->data['Post']['id'].'-', true);		
        $suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
		echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
		echo $this->Form->input('content', array('label' => 'Write your own article'));
		
		
			
	?>
	</fieldset>
	<fieldset>
 		<legend><?php echo __('Properties'); ?></legend>
 		<label><?php echo __('Article Visibility');?></label>
 		<span class="hint">If you want to hide this article from your clients, choose hidden.</span>
 		
    <?php
		  echo $this->Form->input('Webpage.visible', array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false));
		  echo $this->Form->input('Webpage.author', array('options' => $authors));
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Update'), array('div' => false));?> &nbsp;<?php echo __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'blogs','action' => 'view', $this->Form->value('Blog.id'))); ?>
  </div>
  <?php echo $this->Form->end();?>
</div>




<!--<div class="posts">
    <div class="text_center">
        <h2>
          <?php echo $this->request->data['Post']['title']; ?>
        </h2>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Blog']['id'], $post['Post']['id'])); ?>|
        <?php echo $this->Html->link(__('All articles'), array('controller' => 'blogs', 'action' => 'view', $post['Blog']['id'])); ?>|
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, sprintf(__('Are you sure you want to delete this post?'), $post['Page']['id'])); ?>
  </div>
  
<?php echo $this->Form->create('Post', array('url'=>Router::url(array('controller'=>'posts',
							  'action'=>'edit',
							  'blog_id'=>$blog_id,
							  'id'=>$this->request->data['Post']['id']),true)));?>
	<fieldset>
 		<legend><?php echo __('Admin Edit Post'); ?></legend>
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
		echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden')));
		echo $this->Form->input('title');
		
		
		$label = $this->Form->label('handle', 'Permalink/handle');
		$textbox = $this->Form->text('Post.slug');
		$prefix = Router::url('/blogs/'.$this->request->data['Blog']['short_name'].'/'.$this->request->data['Post']['id'].'-', true);
		echo $this->Html->div('input text', $label.$prefix.$textbox ,array(), true);
		
		echo $this->Form->input('body');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', 'id'=>$this->Form->value('Post.id'), 'blog_id'=>$this->Form->value('Post.blog_id')), null, sprintf(__('Are you sure you want to delete %s?'), $this->Form->value('Post.title'))); ?></li>
		
	</ul>
</div>-->
