<?php
/* Webpage Fixture generated on: 2011-09-28 10:39:41 : 1317206381 */

/**
 * WebpageFixture
 *
 */
class WebpageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'meta_title' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'meta_keywords' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'meta_description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'author' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'real_author' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'handle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'visible' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'shop_id' => '1',
			'title' => 'welcome',
			'content' => '<div class="item">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Lorem ipsum dolor sit amet, consectetur 
					adipiscing elit. <a href="#">Sed semper est sed</a> eros sodales 
					in lacinia dolor egestas. Integer seper imperdiet enim eu 
					convallis. Suspendisse nec orci tellus. Aenean consectetur 
					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a 
					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna 
					quam. Etiam ac risus magna, nec pretium diam. <a href="#">
					Phasellus euismod</a> 
					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi 
					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. 
					Praesent aliquet sem sit amet massa scelerisque vitae semper 
					purus varius. Pellentesque habitant morbi tristique senectus et 
					netus et malesuada fames ac turpis egestas.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Jellyfish.jpg" alt="Picture 1" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>
<div class="itemAlt">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Proin mauris tortor, ultricies 
					interdum posuere eu, placerat vitae orci. Duis non laoreet 
					libero. Suspendisse aliquam congue metus non elementum. Cras 
					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci 
					tortor. Suspendisse potenti. Nulla luctus interdum massa in 
					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel 
					orci. <a href="#">Nullam sollicitudin</a> nibh ac dolor tempor 
					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class 
					aptent taciti sociosqu ad litora torquent per conubia nostra, 
					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing 
					ultrices. Nunc eros lectus, bibendum eu consequat id, 
					<a href="#">cursus non quam</a>. Nam vel dolor dolor. 
					Pellentesque ante tortor, mattis auctor condimentum ut, 
					convallis a dui. Mauris scelerisque dapibus libero, vitae 
					facilisis tellus mattis a. Pellentesque metus nulla, tristique 
					at venenatis et, egestas a diam.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Koala.jpg" alt="Picture 2" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>
<div class="item">
		
<table class="itemTable" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="itemLeftCell">
					Nulla auctor sapien lorem. Ut vitae 
					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam 
					eu magna tempus eleifend. Donec interdum interdum lacus eget 
					iaculis. Nulla facilisi. Phasellus <a href="#">eget lacus auctor</a> 
					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt 
					pellentesque, orci lorem vestibulum elit, ac tristique justo 
					magna at ante. <a href="#">Lorem ipsum</a> dolor sit amet, 
					consectetur adipiscing elit. Curabitur rutrum interdum tempus. 
					Nunc et sapien eros, et ultrices elit. <a href="#">Maecenas in 
					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut 
					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui 
					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus 
					fringilla sit amet. Vivamus faucibus nisl a enim lacinia 
					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae 
					orci ut nibh tristique laoreet.
				</td>
<td class="itemRightCell">
					<img src="user_generated_content/images/Hydrangeas.jpg" alt="Picture 3" width="192" height="144" />
				</td>
</tr>
</tbody>
</table>
</div>',
			'created' => '2010-09-01 11:38:15',
			'modified' => '2010-12-22 02:15:17',
			'meta_title' => NULL,
			'meta_keywords' => NULL,
			'meta_description' => NULL,
			'author' => '1',
			'real_author' => NULL,
			'handle' => 'shopfront',
			'visible' => 1
		),
		array(
			'id' => '2',
			'shop_id' => '2',
			'title' => 'Welcome',
			'content' => '<div>
                                <h2>Welcome</h2>
                                <p>Congratulations on starting your own e-commerce store and on your way towards buiding a business empire!</p>
                                <p>This is the front page of your store - the first thing your customers will see when they arrive</p>
                                <p>To start adding products or edit this page, head over to <a href="/">Admin</a></p>
                                <p>Enjoy our services, <br />
                                Team OMBI60</p>
                                </div>',
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:46',
			'meta_title' => NULL,
			'meta_keywords' => NULL,
			'meta_description' => NULL,
			'author' => '1',
			'real_author' => NULL,
			'handle' => 'shopfront',
			'visible' => 1
		),
		array(
			'id' => '3',
			'shop_id' => '2',
			'title' => 'About Us',
			'content' => '<p>The <strong>About Us</strong> page is important.</p>
				     <p>Customers visit About Us page when they are new to your online shop. They want to establish a level of trust in your business.  Since trust is crucial when selling online, it\'s a good idea to provide a fair amount of information about yourself and your business.  Here are a few things you should touch on:</p>
<ul>
	
  <li>Who you are</li>
	
  <li>Why you are selling these items</li>
	
  <li>Where your business is located</li>
	
  <li>How long you have been in business</li>
	
  <li>Who are the people on your team</li>
</ul>
<p>Go to the <a href="/admin/pages">Blogs &amp; Pages</a> in administration menu.</p>',
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:46',
			'meta_title' => NULL,
			'meta_keywords' => NULL,
			'meta_description' => NULL,
			'author' => '1',
			'real_author' => NULL,
			'handle' => 'about-us',
			'visible' => 1
		),
		array(
			'id' => '4',
			'shop_id' => '2',
			'title' => 'Terms of Service',
			'content' => '<p>The <strong>Terms of Service</strong> page is for you to enter any privacy statements or terms of service you wish to render.</p>
				     <p>Customers may need to know the limits of their patronage, so here are a few things you should touch on:</p>
<ul>
	
  <li>Who you are</li>
	
  <li>What you would consider as acceptable customer behavior</li>
	
  <li>Any limits as to whom you can serve or which regions you can serve</li>
	
  <li>What legal recourses you would seek if customers abuse your service</li>
  
  <li>What rights you reserve as a business owner</li>
</ul>
<p>Go to the <a href="/admin/pages">Blogs &amp; Pages</a> in administration menu.</p>',
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:46',
			'meta_title' => NULL,
			'meta_keywords' => NULL,
			'meta_description' => NULL,
			'author' => '1',
			'real_author' => NULL,
			'handle' => 'terms-of-service',
			'visible' => 1
		),
	);
}
