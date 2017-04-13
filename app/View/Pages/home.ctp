<script type="text/javascript">

$(document).ready(function() {
	$('#slideshow').rhinoslider({
		showTime: 5000,
		controlsPlayPause: false,
		autoPlay: true,
		styles: 'width: 100%'
	});

});

</script>

<div id="slider_fullwidth">
		<div id="slideshow" class="slideshow" style="width: 100%; position: relative; height: 560px;">

		<?php
//******************  SLIDER ***********************//
			// WELCOME
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/welcome.png);')),
  					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  				);

			// Revival
 // 			echo  $this->Html->link(
 // 					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/revival-2016.png);')),
 // 					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  //				);

        //     // SOFTBALL
  			// echo  $this->Html->link(
  			// 		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/softball.jpg);')),
  			// 		array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  			// 	);

  			// AUDIO SERMONS
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' =>
  						'width: 100%; height: 560px; background-image: url(/img/slider/audiosermon.jpg);')),
  					array('controller' => 'AudioSermons', 'action' => 'index'), array('escape' => false, 'style' => 'height: 560px;')
  				);

        //     // BOARD METING MONDAY 7PM
  			// echo  $this->Html->link(
  			// 		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/board_meeting_web_monday7.jpg);')),
  			// 		array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  			// 	);

  			// CHILDRENS CHRISTMAS
  			//echo  $this->Html->link(
  			//		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/childrenschirstmas.jpg);')),
  			//		array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  			//	);

  			// Wild Game Dinner
  			// echo  $this->Html->link(
  			//    	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/wgd.jpg);')),
  			//    	array('controller' => 'pages', 'action' => 'display', 'wildgame'), array('escape' => false, 'style' => 'height: 560px;')
  			//    );


  			// VBS
  			//echo  $this->Html->link(
  			//		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/vbs2016.jpg);')),
  			//		array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  			//	);

  			// DIRECTORY
  			echo  $this->Html->link(
  			   	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/directory.jpg);')),
  			   	array('controller' => 'DirectoryFamilies', 'action' => 'index'), array('escape' => false, 'style' => 'height: 560px;')
  			   );

            // Disctirct Mens Retreat
  //			echo  $this->Html->link(
  //					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/district_mens_retreat.jpg);')),
  //					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
   //         );

  			// EASTER
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/easter.jpg);')),
  					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  				);

			  // AG DAY
	  			echo  $this->Html->link(
					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/ag_day_web.jpg);')),
				   array('controller' => 'pages', 'action' => 'display', 'agday'), array('escape' => false, 'style' => 'height: 560px;')
				);


  			// CRAFT FAIR
  		//	echo  $this->Html->link(
		//		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/country_christmas.jpg);')),
			//    array('controller' => 'pages', 'action' => 'display', 'craftfair'), array('escape' => false, 'style' => 'height: 560px;')
		//	);

  			// FAMILY FUN DAY
			//echo  $this->Html->link(
			//	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/family_fun_day.jpg);')),
			//	array('controller' => 'pages', 'action' => 'display', 'familyfunday'), array('escape' => false, 'style' => 'height: 560px;')
			//);


			// CHURCH WORK DAY
			//echo  $this->Html->link(
			//	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/chuch_cleanup.jpg);')),
			//	array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
			//);

  		?>

 </div>
</div>

<div id="mainpage_content">
	<div id='tri-blocks'>
	<?php

		// LEFT TRIBLOCK   ------------------------------------------------------------------------------//
		// FACEBOOK
		$left_text = "<h3>Facebook Page</h3>
			Keep up to date with all thats going on here at Ellington on our Facebook page.";

		echo $this->Html->link(
			$this->Html->div('left-tri-block', $left_text),
			'https://www.facebook.com/ellingtonnazarene/', array('escape' => false, 'target' => '_blank'));


		// MIDDLE TRIBLOCK  -----------------------------------------------------------------------------//
		// AUDIO SERMONS
		$mid_text = "<h3>Audio Sermons</h3>
			Missed church and want to hear the sermon? Really enjoyed last Sunday's sermon and want to hear it again? Want to share a sermon with someone? Well we record our sermons and post them here!";

		echo $this->Html->link(
			$this->Html->div('middle-tri-block', $mid_text),
			array('controller' => 'AudioSermons', 'action' => 'index'), array('escape' => false));

		// RIGHT TRIBLOCK   -----------------------------------------------------------------------------//
		 //Wild Game Dinner
		$right_text = "<h3>Wild Game Dinner</h3>
			The Wild Game Dinner with guest speaker Ty Colling is coming up fast, March 25, 2017. Get your tickets soon before the price goes up on March 1.";

		// Wednesday Nights
		//$right_text = "<h3>Wednesday Night Services</h3>
		//	Join us on Wednesday Nights here at 6:30 for our weekly prayer meeting";
//
		echo $this->Html->link(
			$this->Html->div('right-tri-block', $right_text),
			array('controller' => 'pages', 'action' => 'display', 'wildgame'), array('escape' => false));


	?>
	</div>
</div>
