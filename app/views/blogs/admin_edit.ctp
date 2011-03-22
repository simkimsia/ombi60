<div class="blogs">
    <div class="text_center">
        <h2><?php __($this->data['Blog']['title']);?></h2>
        <?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('Blog.id'))); ?>|
        <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Blog.id')), null, sprintf(__('Are you sure you want to delete blog?', true))); ?>|
        <?php echo $this->Html->link(__('Back to Blogs', true), array('controller'=>'webpages','action' => 'index')); ?>
    </div>
<?php echo $this->Form->create('Blog');?>
	<fieldset>
 		<legend><?php __('Edit this blog'); ?></legend>
	  <?php
		  echo $this->Form->input('id');
		  echo $this->Form->input('name', array('label' => __('Title', true)));
	
		  $label = $this->Form->label('handle', 'Permalink/handle');
		  $textbox = $this->Form->text('Blog.short_name', array('class' => 'small'));
		  $prefix = Router::url('/blogs/', true);
      $suffix = ' ( ' . $this->Html->link(__('What is this?', true), '#') . ' )';
		  echo $this->Html->div('input text', $label. $prefix. ' '. $textbox. $suffix ,array(), true);
	  ?>
	</fieldset>
  <!--<fieldset>
 		<legend><?php __('Properties'); ?></legend>
    <label><?php __('Blog Visibility');?></label>
 		<div class="example-text">If you want to hide this blog and its articles from your clients, choose hidden.</div>
    <?php echo $this->Form->input('visible',array('options' => array('1'=>'Published', '0'=>'Hidden'), 'label' => false)); ?>
  </fieldset>-->
<div class="submit">
    <?php echo $this->Form->submit(__('Update', true), array('div' => FALSE,));?>&nbsp;or&nbsp;
    <?php echo $this->Html->link(__('Cancel', true), array('controller'=>'webpages','action' => 'index')); ?>
  </div>  
<?php echo $this->Form->end();?>
</div>
