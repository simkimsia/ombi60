<div class="head">
	<h1><?php __d('lil_blogs', 'Add a Post'); ?></h1>
</div>
<div class="form">
<?php
	echo $form->create();
	echo $form->hidden('blog_id');
	echo $form->input('title', array(
		'label' => __d('lil_blogs', 'Title', true).':', 
		'error' => __d('lil_blogs', 'Post title is required.', true),
		'class' => 'big'
	));
	if (Configure::read('LilBlogsPlugin.slug')=='manual') {
		echo $form->input('slug', array(
			'label' => __d('lil_blogs', 'Slug', true).':', 
			'error' => __d('lil_blogs', 'Post slug is required and must only use letters, numbers, underscores or hyphens.', true)
		));
	}
	echo $form->input('body', array(
		'label' => __d('lil_blogs', 'Body', true).':',
		'error' => __d('lil_blogs', 'Body of the post is required.', true)
	));
	echo $form->input('allow_comments', array(
		'label' => __d('lil_blogs', 'Allow Comments', true)
	));
	
	if (!Configure::read('LilBlogsPlugin.noCategories')) {
		echo $form->input('Category.Category', array(
			'label'   => __d('lil_blogs', 'Category', true).':',
			'options' => $categories,
			'empty'   => '-- '.__d('lil_blogs', 'none', true).' --'
		));
	}
	
	if (!$author_id_field = Configure::read('LilBlogsPlugin.userTable.foreignKey')) {
		$author_id_field = 'author_id';
	}
	echo $form->input($author_id_field, array(
		'label'   => __d('lil_blogs', 'Author', true).':',
		'options' => $authors
	));
	
	echo $form->input('status', array(
		'label'   => __d('lil_blogs', 'Status', true).':',
		'options' => array(
			'0'=>__d('lil_blogs', 'Draft', true),
			'2' =>__d('lil_blogs', 'Live', true)
		)
	));
	echo $form->submit(__d('lil_blogs', 'Create', true));
	echo $form->end();
?>
</div>
<?php
	if ($editor = Configure::read('LilBlogsPlugin.editor')) {
		echo $this->element('editors/'.strtolower($editor));
	}
?>