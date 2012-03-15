<h1 class="center">Saved Themes</h1>
<div class="rule"></div>
<div id="action-links">
	<ul>
	    <li id="customer"><?php echo $this->Html->link(__('Upload new theme'), array('action'=>'new')); ?></li>
		<li id="themestore"><?php echo $this->Html->link(__('Get more themes'), array('action'=>'new')); ?></li>
	</ul>

</div>
<h2>Published Themes</h2>
<p>These themes are <strong>live</strong> on your store. Changes you make to these themes will be seen by your customers automatically.</p>
<div class="columns clear" >
	<?php foreach($themes as $key=>$theme): ?>
		<?php 
		$theme = $theme['SavedTheme'];
		$column = '';
		if ($key%2==1) {$column = 'lastcol'; }
		?>
	<div class="col1-2 <?php echo $column; ?>">	
		<div class="content-box">
		<div class="box-body">
			<div class="box-header clear">
				<h2><?php echo $theme['name']; ?></h2>
			</div>
			<div class="box-wrap clear">
				<div class="columns clear">
					<div class="col1-3">
						<div class="mark" style="padding:5px;">
						<?php echo $this->Html->image('admin/theme-placeholder.png', array('alt' => 'Theme'));?>
						</div>
					</div>
					<div class="col2-3 lastcol">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.</p>
					</div>
				</div>



			</div> <!-- end of box-wrap -->
		</div> <!-- end of box-body -->
		</div> <!-- end of content-box -->
	</div><!-- end of col1-2 -->
	<?php endforeach; ?>

</div><!-- end of columns clear -->