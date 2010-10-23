<?php
	Configure::write('LilBlogsPlugin.commentedEmail', 'text@example.com');
	Configure::write('LilBlogsPlugin.emailDelivery', 'mail');
	Configure::write('LilBlogsPlugin.emailSmtpOptions', array(
		'port'=>'25',
		'timeout'=>'30',
		'host' => 'your.smtp.server',
		'username'=>'your_smtp_username',
		'password'=>'your_smtp_password',
		'client' => 'smtp_helo_hostname'
	));
	
	Configure::write('LilBlogsPlugin.useAdminLayout', true);

	Configure::write('LilBlogsPlugin.rssItems', 20);
	Configure::write('LilBlogsPlugin.mainPageItems', 5);
	
	Configure::write('LilBlogsPlugin.excerptLength', null);
	Configure::write('LilBlogsPlugin.excerptDelimiter', '<!-- MORE -->');
	
	Configure::write('LilBlogsPlugin.tablePrefix', '');
	Configure::write('LilBlogsPlugin.userTable', array('className'=>'LilBlogs.Author', 'foreignKey'=>'author_id'));
	
	Configure::write('LilBlogsPlugin.authorAdminField', 'admin');
	Configure::write('LilBlogsPlugin.authorDisplayField', 'name');
	Configure::write('LilBlogsPlugin.authorsBlogTable', 'authors_blogs');
	
	Configure::write('LilBlogsPlugin.allowAuthorsAnything', false);
	
	Configure::write('LilBlogsPlugin.slug', 'auto'); // auto, manual
	
	// spam filter - currently available Bayes and Snook
	Configure::write('LilBlogsPlugin.spamFilter', 'Bayes');
	
	// wysiwyg editor - TinyMCE ...
	Configure::write('LilBlogsPlugin.editor', null);
	
	// ability to disable blogs and categories tables
	Configure::write('LilBlogsPlugin.noCategories', false);
	Configure::write('LilBlogsPlugin.noBlogs', false);
	
	Configure::write('LilblogsPlugin.plugins', array());

	if (!defined('CAKE_UNIT_TEST')) {
		define('CAKE_UNIT_TEST', false);
	}
?>