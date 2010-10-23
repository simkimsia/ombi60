<?php echo $form->create(null, array('url'=>array('action'=>'quick'))); ?>
<div class="head">
	<h1><?php
		if (isset($post)) { 
			printf(__d('lil_blogs', 'Comments for %s', true), $html->link($post['Post']['title'], array('controller'=>'posts', 'action'=>'admin_index', $post['Post']['blog_id'])));
		} else {
			printf(__d('lil_blogs', '%s comments', true), $blog['Blog']['name']);
		} 
	?></h1>
	<div>
	<?php
		echo $form->input('action', array('type'=>'select', 'div'=>false, 'label'=>false, 'empty'=>__d('lil_blogs', 'With selected comments:', true), 'options'=>
			array('spam'=>__d('lil_blogs', 'Mark them as spam', true), 'ham'=>__d('lil_blogs', 'Allow and publish them', true), 'delete'=>__d('lil_blogs', 'Delete them', true))));
		echo $form->submit(__d('lil_blogs', 'Go', true), array('div'=>false));
	?>
	</div>
</div>
<div class="index">
<script type="text/javascript">
	function DoSelectAll() {
		var checkboxes = document.getElementsByName("data[Comment][comments][]");
		for (var i=0; i < checkboxes.length; i++) {
			checkboxes[i].checked = document.getElementById("SelectAll").checked;
		} 
	}
</script>
<?php
	$pagination_url = Router::getParam('pass');
	if (!empty($this->params['named']['blog_id'])) {
		$pagination_url['blog_id'] = $this->params['named']['blog_id'];
	}
	if (isset($this->params['named']['status'])) {
		$pagination_url['status'] = $this->params['named']['status'];
	}
?>
<table cellspacing="0" cellpadding="0" id="AdminCommentsIndex">
	<thead>
		<tr>
			<th><input type="checkbox" id="SelectAll" onclick="DoSelectAll();" /></th>
			<th><?php __d('lil_blogs', 'ID'); ?></th>
			<th class="left"><?php __d('lil_blogs', 'Author'); ?></th>
			
			<th class="left"><?php __d('lil_blogs', 'Comment'); ?></th>
			<th class="left"><?php __d('lil_blogs', 'In response to'); ?></th>
			<th><?php echo $paginator->sort(__d('lil_blogs', 'Status', true), 'status', array('url' => $pagination_url)); ?></th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<?php
		$i = 1; 
		if (!empty($comments)) foreach($comments as $item) {
	?>
	<tr<?php if($i++%2==0) echo ' class="altrow"'; ?>>
		<td class="center"><?php echo $form->input('comments][', array('type'=>'checkbox', 'label'=>false, 'div'=>false, 'value'=>$item['Comment']['id'])); ?></td>
		<td class="center small"><?php echo $item['Comment']['id']; ?></td>
		<td class="td_admin_comment_author"><?php 
			echo '<b>'.$sanitize->html($item['Comment']['author']).'</b>';
			echo '<div class="small light">'.$item['Comment']['email'].'</div>';
			echo '<div class="small light">'.$item['Comment']['ip'].'</div>';
		?></td>
		<td class="td_admin_comment_body"><?php
			echo '<div class="small light">'.__d('lil_blogs', 'Submitted', true).' '.$time->niceShort($item['Post']['created']).'</div>';
			echo '<div class="admin_comment_body">'.$text->truncate($sanitize->html($item['Comment']['body']), 200, '...', true).'</div>';
		?></td>
		<td class="td_admin_comment_post"><?php
			echo $html->link($item['Post']['title'], array('controller' => 'posts', 'action' => 'edit', $item['Post']['id'], 'admin' => true));
			echo '<div class="small light">'.__d('lil_blogs', 'Comments', true).': '.$item['Post']['no_comments'].'</div>';
		?></td>
		<td class="center small"><?php echo $item['Comment']['status'] == 0 ? __d('lil_blogs', 'Junk', true) : ($item['Comment']['status'] == 1 ? __d('lil_blogs', 'Awaiting moderation', true) : __d('lil_blogs', 'Live', true)); ?></td>
		<td class="center"><?php echo $html->link($html->image('/lil_blogs/img/edit.gif', array('alt'=>__d('lil_blogs', 'Edit', true))), array('action'=>'admin_edit', $item['Comment']['id']), array('title'=>__d('lil_blogs', 'Edit', true)), null, false); ?></td>
		<td class="center"><?php echo $html->link($html->image('/lil_blogs/img/delete.gif', array('alt'=>__d('lil_blogs', 'Delete', true))), array('action'=>'admin_delete', $item['Comment']['id']), array('title'=>__d('lil_blogs', 'Delete', true)), null, false); ?></td>
	</tr>
<?php 
	} else {
?>
		<tr><td colspan="8" class="light"><?php __('No comments that match your criteria.'); ?></td></tr>
<?php
	}
?>

	<tfoot>
		<tr>
			<td colspan="8" class="paging">
				<?php 
					echo $paginator->prev('<< '.__d('lil_blogs', 'previous', true), array('class'=>'prev', 'url' => $pagination_url), null, array('class'=>'prev light'));
					echo $paginator->next(__d('lil_blogs', 'next', true).' >>', array('class'=>'next', 'url' => $pagination_url), null, array('class'=>'next light'));
					echo '<div class="counter">' . $paginator->counter(array(
						'format' => __d('lil_blogs', 'Page <b>%page%</b> of <b>%pages%</b>, total <b>%count%</b> records.', true))).'</div>';
				?>
			</td>
		</tr>
	</tfoot>
</table>
</div>
<?php
	echo $form->end();
?>
