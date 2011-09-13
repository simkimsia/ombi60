<div class="webpages main-container-div">
      <div class="text_center">
        <h2><?php echo $blog_name; ?> - <?php echo __('Add your New Article');?></h2>
        <?php echo $this->Html->link(__('Cancel'), array('controller'=>'blogs','action' => 'view', $blog_id));?>
    </div>

<?php echo $this->Form->create('Post', array('url'=>array('controller'=>'posts',
					     'action' => 'add',
					     'blog_id'=>$blog_id)));?>
	<fieldset>
 		<legend><?php echo __('New Article'); ?></legend>
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
	
		echo $this->Form->input('blog_id', array('type'=>'hidden', 'value'=>$blog_id));
		
		echo $this->Form->input('title');
		
		echo $this->Form->input('content', array('label' => 'Write your article'));
	
	?>
	</fieldset>
	<fieldset>
 		<legend><?php echo __('Properties'); ?></legend>
 		<label><?php echo __('Article Visibility');?></label>
 		<span class="hint">If you want to hide this article from your clients, choose</span>
    <?php 
      echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false)); 
  		echo $this->Form->input('Post.author', array('options' => $authors));
    ?>
  </fieldset>
  <div class="submit">
    <?php echo $this->Form->submit(__('Create article'), array('div' => false));?> &nbsp;<?php echo __('or'); ?>&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'blogs','action' => 'view', $blog_id));?>
  </div>
  <?php echo $this->Form->end(); ?>
</div>
