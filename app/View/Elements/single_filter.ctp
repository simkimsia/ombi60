<?php

// $modelName Order etc,
// $fieldName status as in Order.status
// $displayValues = array('paid' => '1') in the dropdown
// $displayNameForAny = ;

$currentValue = null;
if (isset($this->request->query[$fieldName])) {
	$currentValue = $this->request->query[$fieldName];
}

if ($currentValue == null) {
	if (!isset($displayNameForAny)) {
		$displayNameForAny = 'any';
	}
	$currentDisplay = $displayNameForAny;
} else {
	$valuesDisplay = array_flip($displayValues);
	$currentDisplay = $valuesDisplay[$currentValue];
}



?>
<select onchange="document.location.href = this.value;" size="1" >
	<option disabled="disabled"><?php echo $currentDisplay; ?></option>
	<?php foreach($displayValues as $displayName=>$value) : ?>
		<?php 

			$value = $this->Html->addQueryToCurrentUrl(array($fieldName=>$value)); 
			/*
			$selected = '';
			if ($currentValue == $pageLength) {
				$selected = ' selected="selected"';
			}*/

		?>
		<option value="<?php echo $value; ?>" ><?php echo $displayName; ?></option>
	<?php endforeach; ?>
	<option>---</option>
	<option value="<?php echo $this->Html->removeQueryFromCurrentUrl($fieldName); ?>">Show All</option>
</select>