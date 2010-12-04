<div class="head">
	<h1><?php __d('lil_blogs', 'Edit Comment'); ?></h1>
</div>
<div class="form">
<?php
	echo $form->create('Comment');
	echo $form->hidden('id');
	echo $form->hidden('post_id');
	echo $form->input('author', array('label'=>__d('lil_blogs', 'Author', true).':'));
	echo $form->input('url', array('label'=>__d('lil_blogs', 'Url', true).':'));
	echo $form->input('email', array('label'=>__d('lil_blogs', 'Email', true).':'));
	echo $form->input('body', array('label'=>__d('lil_blogs', 'Body', true).':'));
	echo $form->input('status', array('options'=>array('0'=>__d('lil_blogs', 'Spam', true), '1'=>__d('lil_blogs', 'Awaiting Moderation', true), '2'=>__d('lil_blogs', 'Approved', true))));
	echo $form->submit(__d('lil_blogs', 'Save', true));
	echo $form->end();
?>
</div>
