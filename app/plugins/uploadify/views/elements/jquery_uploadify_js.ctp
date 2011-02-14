<script type="text/javascript">

function convertmb(f) {
	
	return Math.round(f/1048576*100)/100;
}


$(document).ready(function() {
	var buttonId = '<?php echo '#'.$uploadifySettings['browseButtonId'];?>';
	$(buttonId).uploadify({
		'uploader'       : '<?php echo Router::url('/uploadify/scripts/uploadify.swf'); ?>',
		<?php if(isset($uploadifySettings['script'])) { ?>
		'script'         : '<?php
				$currentSess = '?sess='.$this->Session->id();
				echo $uploadifySettings['script'] . $currentSess ; ?>',
                <?php } ?>
                
                <?php if(isset($uploadifySettings['cancelImg'])) { ?>
		'cancelImg'      : '<?php echo $uploadifySettings['cancelImg']; ?>',
                <?php } else { ?>
                'cancelImg'      : '<?php echo Router::url('/uploadify/img/cancel.png'); ?>',
                <?php } ?>
                
                <?php if(isset($uploadifySettings['buttonText'])) { ?>
		'buttonText'      : '<?php echo $uploadifySettings['buttonText']; ?>',
                <?php } ?>
		<?php if(isset($uploadifySettings['folder']) && !empty($uploadifySettings['folder'])) { ?>
		'folder'         : '<?php echo $uploadifySettings['folder']; ?>',
                <?php } ?>
                
                <?php if(isset($uploadifySettings['queueID']) && $uploadifySettings['queueID']) { ?>
		'queueID'           : '<?php echo $uploadifySettings['queueID']; ?>',
                <?php } ?>
		
		<?php if(isset($uploadifySettings['auto']) && $uploadifySettings['auto']) { ?>
		'auto'           : true,
                <?php } ?>
		
		
		'fileDesc'           : 'Only image files are accepted.(*.png;*.jpg;*.jpeg;*.gif;*.ico;*.bmp;)',
		'fileExt'           : '*.png;*.jpg;*.jpeg;*.gif;*.ico;*.bmp;',
		'sizeLimit'	: 1048576,
		'onSelect' 	: function(event, queueID, fileObj) {
				
					if (fileObj["size"] > 1048576) {
						alert('Max file size: 1 Mb. ' + fileObj["name"] + ' is ' + convertmb(fileObj["size"]) + ' Mb');
						return false;
					}
					
				   },
				   
		<?php if(isset($uploadifySettings['onAllComplete']) && $uploadifySettings['onAllComplete']) { ?>		   
		'onAllComplete'	: function(event, data) {
					handlesUploadifyAllComplete(event, data);
				},
                <?php } ?>
		
		<?php if(isset($uploadifySettings['onComplete']) && $uploadifySettings['onComplete']) { ?>		   
		'onComplete'	: function(event, queueID, fileObj, response, data) {
					handlesUploadifyComplete(event, queueID, fileObj, response, data);
				},
                <?php } ?>
                
		'multi'          : true,
	});
});
</script>
