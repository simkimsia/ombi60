<div class="head">
	<h1><?php printf(__d('lil_blogs', 'Posts for "%s"', true), $sanitize->html($blog['Blog']['name'])); ?></h1>
</div>
<div class="index">
	<table cellspacing="0" cellpadding="0" width="100%" id="AdminPostsIndex">
		<thead>
			<tr>
				<th><?php __d('lil_blogs', 'ID'); ?></th>
				<th class="left"><?php __d('lil_blogs', 'Name'); ?></th>
				<th><?php __d('lil_blogs', 'Author'); ?></th>
				<th><?php __d('lil_blogs', 'Status'); ?></th>
				<th><?php __d('lil_blogs', 'Date'); ?></th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
	<?php
		$i = 1;
		foreach($data as $item) { 
	?>
		<tr<?php if($i++%2==0) echo ' class="altrow"'; ?>>
			<td class="center"><?php echo $item['Post']['id']; ?></td>
			<td<?php if ($item['Post']['status']==0) echo ' class="light"' ?>>
				<?php 
					if ($item['Post']['status']==0) {
						echo $sanitize->html($item['Post']['title']);
					} else {
						echo $html->link($item['Post']['title'], array(
							'admin'=>false, 
							'controller'=>'posts', 
							'action'=>'view', 
							'blogname'=>$blog['Blog']['short_name'], 
							'post'=>$item['Post']['slug']
						), array('class' => 'big'));
					}
					echo '<br />';
					echo $sanitize->html($item['Post']['slug']);
				?>
			</td>
			<td class="small"><?php
				echo $sanitize->html($item['Author'][Configure::read('LilBlogsPlugin.authorDisplayField')]);
			?></td>
			<td class="center small"><?php if ($item['Post']['status']==0) __d('lil_blogs', 'Draft'); else __d('lil_blogs', 'Live'); ?></td>
			<td class="nowrap center small<?php if ($item['Post']['status']==0) echo ' light' ?>"><?php echo $time->niceShort($item['Post']['created']); ?></td>
			<td class="center"><?php echo $html->link($html->image('/lil_blogs/img/edit.gif', array('alt'=>__d('lil_blogs', 'Edit', true))), array('action'=>'admin_edit',$item['Post']['id']), array('title'=>__d('lil_blogs', 'Edit', true)), null, false); ?></td>
			<td class="center"><?php echo $html->link($html->image('/lil_blogs/img/delete.gif', array('alt'=>__d('lil_blogs', 'Delete', true))), array('action'=>'admin_delete',$item['Post']['id']), array('title'=>__d('lil_blogs', 'Delete', true)), null, false); ?></td>
			<td class="center"><?php 
				echo $html->link($item['Post']['no_comments'], array(
					'controller'=>'comments', 
					'action'=>'admin_index',
					$item['Post']['id']), 
					array(
						'title'=>__d('lil_blogs', 'Comments', true), 
						'class' => 'PostsIndexCommentCount'
					), null, false); ?></td>
		</tr>
	<?php } ?>
	<tfoot>
		<tr>
			<td colspan="8" class="paging">
				<?php 
					echo $paginator->prev('<< '.__d('lil_blogs', 'previous', true), array('class'=>'prev'), null, array('class'=>'prev light'));
					echo $paginator->next(__d('lil_blogs', 'next', true).' >>', array('class'=>'next'), null, array('class'=>'next light'));
					echo '<div class="counter">' . $paginator->counter(array(
						'format' => __d('lil_blogs', 'Page <b>%page%</b> of <b>%pages%</b>, total <b>%count%</b> records.', true))).'</div>';
				?>
			</td>
		</tr>
	</tfoot>
	</table>
</div>