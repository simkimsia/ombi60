

<div class="savedThemes index">
	
	<div class="">
	<ul id="themes-list" class="theme-thumbs">
	
	
	
	<?php
	
	echo $this->element('themes_ajax_list');
	
	?>
	</ul>
	</div>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Saved Theme'), array('action' => 'add')); ?></li>
		
		
		
	</ul>
</div>

<script>
	var intervalId = '';
	
	var currentUrl = '<?php echo $this->request->here . '/index/page:'; ?>';
	
	var newUrl = '';

	function afterDelete(response) {
		var json_object = $.parseJSON(response);
	
		if (json_object.success) {
			
			var contents = $.parseJSON(json_object.contents);
			
			var id = '#theme-' + contents.id;
			
			$(id).remove();
			
		} else {
			
			var contents = $.parseJSON(json_object.contents);
			
			var errors = contents.reason;
			
			alert(errors);
		}	
	}
	
	function fetchNextPage(currentPage) {
		
		newUrl = currentUrl + currentPage;
		
		$.ajax({
			url: newUrl ,
			success: function(data) {
				// append page 2 themes
				$('#themes-list').append(data);
			}
		});
	}
	
	$(document).ready(function() {
		
		var currentPage = 1;
		var totalThemes = <?php echo $themesTotal;?>;
		var themePerPage = <?php echo $limit; ?>;
		
		var contentHeight = 500;  
		var pageHeight = $(window).height();
		var scrollPosition = $(window).scrollTop();
		
		intervalID = window.setInterval(function() {
			
			scrollPosition = $(window).scrollTop();
		      
			//console.log('result' + (contentHeight - pageHeight - scrollPosition));
			if (totalThemes > (currentPage*themePerPage) && ((contentHeight - pageHeight - scrollPosition) < 300)) {
				currentPage++;
				fetchNextPage(currentPage);
				contentHeight += 400;
			} else if (totalThemes <= (currentPage*themePerPage)){
				clearInterval(intervalID);
			} 
		}, 2000);

		
	});
	
</script>