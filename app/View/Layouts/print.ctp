<?php 
    $logo_title = 'Ellington Church of the Nazarene';

	echo $this->Html->charset(); ?>
	<title>
		<?php echo $logo_title ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<link rel="icon" 
      type="image/png" 
      href="/img/favicon.png">
      <?php echo $this->fetch('content'); ?>