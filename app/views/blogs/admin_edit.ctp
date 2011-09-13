<div class="blogs">
    <div class="text_center">
        <h2><?php echo __($this->request->data['Blog']['title']);?></h2>
        <?php echo $this->Html->link(__('View'), array('action' => 'view', $this->Form->value('Blog.id'))); ?>|
        <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Blog.id')), null, sprintf(__('Are you sure you want to delete blog?'))); ?>|
        <?php echo $this->Html->link(__('Back to Blogs'), array('controller'=>'webpages','action' => 'index')); ?>
    </div>
<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php echo __('Edit this blog'); ?></legend>
	  <?php
		  echo $this->Form->input('Blog.id');
		  echo $this->Form->input('Blog.title', array('label' => __('Title')));
	
		  $label = $this->Form->label('handle', 'Permalink/handle');
		  $textbox = $this->Form->text('Blog.short_name', array('class' => 'small'));
		  $prefix = Router::url('/blogs/', true);
      $suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
		  echo $this->Html->div('input text', $label. $prefix. ' '. $textbox. $suffix ,array(), true);
	  ?>
	</fieldset>
  
<div class="submit">
    <?php echo $this->Form->submit(__('Update'), array('div' => FALSE,));?>&nbsp;or&nbsp;
    <?php echo $this->Html->link(__('Cancel'), array('controller'=>'webpages','action' => 'index')); ?>
  </div>  
<?php echo $this->Form->end();?>
</div>
