Need to close your store?
Once your account is cancelled, all parts of your store will be permanently deleted.
<?php
echo $this->Html->link('Please cancel my account (I understand this is irreversible)',
		       array('controller'=>'shops',
			     'action'=>'cancelaccount',
			     'admin'=>true));
		       ?>