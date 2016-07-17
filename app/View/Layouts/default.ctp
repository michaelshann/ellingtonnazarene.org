<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$logo_title = 'Ellington Church of the Nazarene';

if(AuthComponent::user('role') == 'admin') {
	$_SESSION['debug'] = 2;
} else {
	$_SESSION['debug'] = 0;
}


?>
<!DOCTYPE html>
<html>
<head>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-51486497-1', 'ellingtonnazarene.org');
	  ga('send', 'pageview');

	</script>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $logo_title ?>:
		<?php echo $title_for_layout; ?>
	</title>

	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="/img/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
	<link rel="manifest" href="/img/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<?php

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('rhinoslider.css');
		//echo $this->Html->css('nivo-slider');

	//	echo $this->Html->css('themes/default/default');
	//	echo $this->Html->css('themes/dark/dark');
	//	echo $this->Html->css('themes/bar/bar');
	//	echo $this->Html->css('themes/light/light');
		echo $this->Html->css('superfish.css');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Fresca|Alegreya+Sans+SC:700italic|Poiret+One|Antic+Didone');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->script('jquery.js');
	//	echo $this->Html->script('nivo-slider/jquery.nivo.slider.pack.js');
		echo $this->Html->script('superfish.js');
		echo $this->Html->script('hoverIntent.js');
		echo $this->Html->script('rhinoslider.js');
		echo $this->Html->script('mousewheel.js');
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			<?php
			echo  $this->Html->link(
					$this->Html->div("logo_div", "&nbsp;"),
					array('controller' => 'pages', 'action' => 'display', 'home')
					, array('escape' => false)
				);
			?>
			<div id="menu_div">
				<?php echo $this->element('menubar'); ?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright 2014 Ellington Church of the Nazarene
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
