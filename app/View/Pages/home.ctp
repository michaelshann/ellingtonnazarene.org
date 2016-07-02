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
		
			// WELCOME
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/welcome.png);')),
  					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  				);
  				
  			// AUDIO SERMONS	
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' => 
  						'width: 100%; height: 560px; background-image: url(/img/slider/audiosermon.jpg);')),
  					array('controller' => 'AudioSermons', 'action' => 'index'), array('escape' => false, 'style' => 'height: 560px;')
  				);
  			
  			// CHILDRENS CHRISTMAS	
  			//echo  $this->Html->link(
  			//		$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/childrenschirstmas.jpg);')),
  			//		array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  			//	);
  				
  			// Wild Game Dinner	
  			//echo  $this->Html->link(
  			//   	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/wildgame.png);')),
  			//   	array('controller' => 'pages', 'action' => 'display', 'wildgame'), array('escape' => false, 'style' => 'height: 560px;')
  			//   );
  			
  				
  			// DIRECTORY	
  			echo  $this->Html->link(
  			   	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/directory.jpg);')),
  			   	array('controller' => 'DirectoryFamilies', 'action' => 'index'), array('escape' => false, 'style' => 'height: 560px;')
  			   );
  			
  			// EASTER
  			echo  $this->Html->link(
  					$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/easter.jpg);')),
  					array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false, 'style' => 'height: 560px;')
  				);			
  			
  			// CRAFT FAIR
  			//echo  $this->Html->link(
			//	$this->Html->div("slide", "&nbsp;", array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/country_christmas.jpg);')),
			//	array('controller' => 'pages', 'action' => 'display', 'craftfair'), array('escape' => false, 'style' => 'height: 560px;')
			//);
  				
  				
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
		// Wild Game Dinner
		$right_text = "<h3>Easter Services</h3>
			As this Easter week approaches we would love for you to celebrate with us.  Sunday we will be having our sunrise service at 7:30 with breakfast to follow, with a easter egg hunt for the kids then 
			the normal Sunday Morning services.";
			
		echo $this->Html->link(
			$this->Html->div('right-tri-block', $right_text),
			array('controller' => 'pages', 'action' => 'display', 'home'), array('escape' => false));	

		// Wednesday Nights
		/*$right_text = "<h3>Wednesday Night Services</h3>
			Join us on Wednesday Nights here we have events for all ages, from Caravans and teen group to an adult prayer meeting.";
			
		echo $this->Html->link(
			$this->Html->div('right-tri-block', $right_text),
			array('controller' => 'pages', 'action' => 'display', 'ourservices'), array('escape' => false));	
		*/	
	?>
	</div>
</div>