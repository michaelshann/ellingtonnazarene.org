<div id="slider_fullwidth">
		<div id="slideshow" class="slideshow" style="width: 100%; position: relative; height: 560px;">
<?php

    echo  $this->Html->link(
  		$this->Html->div("slide", "&nbsp;", 
  		array('style' => 'width: 100%; height: 560px; background-image: url(/img/slider/valentine_dinner.jpg);')),
  		array('controller' => 'Pages', 'action' => 'display', 'valentinedinner'), array('escape' => false, 'style' => 'height: 560px;')
  	);	
 ?>
		</div>
</div>
<div class='static_content'>
<h1> Valentine's Day Dinner </h1>
<h2 class='h1nospace'> February 14, 2015 </h2>
<p>
	
</p>
</div>