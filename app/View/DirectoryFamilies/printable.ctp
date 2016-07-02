<div class='static_content'>

<?php
	foreach($families as $family):
		//echo "Family Display Name: ";
		echo $family['DirectoryFamily']['family_display_name'];
		echo "<br/>";
			
		
		echo $family['DirectoryHome']['street_address'] . ' ' . $family['DirectoryHome']['city'] . ' ' . $family['DirectoryHome']['state'] . ' ' . $family['DirectoryHome']['zip'];
		echo "<br/>";
		
		if(!is_null($family['DirectoryHome']['phone']) && ($family['DirectoryHome']['phone'] != '' || $family['DirectoryHome']['phone'] != ' ')) {
		//	echo "Home Phone: ";
			echo $family['DirectoryHome']['phone'];	
			echo "<br />";
		}
		
		echo "Default Image Name: ";
			echo $this->Html->Link($family['DirectoryPicture']['image_name'],
				array('controller' => 'DirectoryPictures','action' => 'download', $family['DirectoryPicture']['id']), 
				array('escape' => false));
		echo "<br/>";	
		
		echo "<br/>";
	endforeach;
?>

</div>