<?php
	if (isset($blog)) {
?>
<div class="panel">
	<h1<?php
		if (in_array($this->params['controller'], array('posts', 'categories'))) echo ' class="active"';
	?>><?php echo $html->link(__d('lil_blogs', 'Posts', true), array('controller' => 'posts', 'action' => 'index', 'admin' => true, $blog['Blog']['id'])); ?></h1>
	<?php
		if (in_array($this->params['controller'], array('posts', 'categories'))) {
	?>
	<ul>
		<?php
			echo '<li';
			if ($this->params['controller']=='posts' && in_array($this->params['action'], array('admin_edit', 'admin_index'))) echo ' class="active"';
			echo '>';
			echo $html->link(__d('lil_blogs', 'Edit', true), array('controller' => 'posts', 'action' => 'index', 'admin' => true, $blog['Blog']['id']));
			echo '</li>';
		?>
		<?php
			echo '<li';
			if ($this->params['controller']=='posts' && in_array($this->params['action'], array('admin_add'))) echo ' class="active"';
			echo '>';
			echo $html->link(__d('lil_blogs', 'Add New', true), array('controller' => 'posts', 'action' => 'add', 'admin' => true, $blog['Blog']['id']));
			echo '</li>';
		?>
		<?php
			echo '<li';
			if ($this->params['controller']=='categories') echo ' class="active"';
			echo '>';
			echo $html->link(__d('lil_blogs', 'Edit Categories', true), array('controller' => 'categories', 'action' => 'index', 'admin' => true, $blog['Blog']['id']));
			echo '</li>';
		?>
	</ul>
	<?php
		}
	?>
</div>
<div class="panel">
	<h1<?php
		if ($this->params['controller']=='comments') echo ' class="active"';
	?>><?php echo $html->link(__d('lil_blogs', 'Comments', true), array('controller' => 'comments', 'action' => 'index', 'admin' => true, 'blog_id' => $blog['Blog']['id'])); ?></h1>
	<?php
		if ($this->params['controller']=='comments') {
			echo '<ul>' . PHP_EOL;
			echo '<li' . (!isset($this->params['named']['status'])?' class="active"':'') . '>';
			echo $html->link(sprintf(__('All (%d)', true), $count_all), array_merge(isset($post)?array($post['Post']['id']):array('blog_id' => $blog['Blog']['id']), array('status' => null)));
			echo '</li>' . PHP_EOL;
			
			echo '<li' . ((isset($this->params['named']['status']) && ($this->params['named']['status'] == BLOGSPAM_HAM))?' class="active"':'') . '>';
			echo $html->link(sprintf(__('Ham (%d)', true), $count_ham), array_merge(isset($post)?array($post['Post']['id']):array('blog_id' => $blog['Blog']['id']), array('status' => BLOGSPAM_HAM)));
			echo '</li>' . PHP_EOL;
			
			echo '<li' . ((isset($this->params['named']['status']) && ($this->params['named']['status'] == BLOGSPAM_SPAM))?' class="active"':'') . '>';
			echo $html->link(sprintf(__('Spam (%d)', true), $count_spam), array_merge(isset($post)?array($post['Post']['id']):array('blog_id' => $blog['Blog']['id']), array('status' => BLOGSPAM_SPAM)));
			echo '</li>' . PHP_EOL;
			
			echo '<li' . ((isset($this->params['named']['status']) && ($this->params['named']['status'] == BLOGSPAM_UNKNOWN))?' class="active"':'') . '>';
			echo $html->link(sprintf(__('Unclassified (%d)', true), $count_unknown), array_merge(isset($post)?array($post['Post']['id']):array('blog_id' => $blog['Blog']['id']), array('status' => BLOGSPAM_UNKNOWN)));
			echo '</li>' . PHP_EOL;
		}
	?>
</div>
<?php
	}
?>
