<?php


$pluralName = Inflector::pluralize(strtolower($modelName));
$tableId = $pluralName.'Table';
$tableLengthId = $tableId . '_length';
$divFilterId = $pluralName . '_filters';

$pageLengthChoices = array(5, 10, 25, 50, 100);


?>
<div id="<?php echo $divFilterId; ?>" class="content-box mark">
	<div class="columns clear bt-space5">
		<div class="col2-3 table-filters">
			<?php echo $showingFilters?>
		</div>
		<div id="<?php echo $tableLengthId; ?>" class="right col1-3 lastcol">
			<select onchange="document.location.href = this.value;" size="1" name="<?php echo $tableLengthId; ?>">
				<?php foreach($pageLengthChoices as $pageLength) : ?>
					<?php 
	
						$value = $this->Html->addQueryToCurrentUrl(array('iDisplayLength'=>$pageLength)); 
						$selected = '';
						if ($currentPageLength == $pageLength) {
							$selected = ' selected="selected"';
						}
	
					?>
					<option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $pageLength; ?></option>
				<?php endforeach; ?>
			</select>
			<?php echo $pluralName; ?> per page
		</div>
	</div>
</div>