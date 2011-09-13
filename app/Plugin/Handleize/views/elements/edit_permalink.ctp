<?php
$label = $this->Form->label('handle', 'Permalink/handle');
$textbox = $this->Form->text($modelName.'.'.$handleField, array('class' => 'small'));
$prefix = Router::url('/products/', true);
$suffix = ' ( ' . $this->Html->link(__('What is this?'), '#') . ' )';
echo $this->Html->div('input text', $label.$prefix.$textbox. $suffix ,array(), true);
?>
