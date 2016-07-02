
<div class='sermons'>
<h1>Audio Sermons</h1>
<?php 
	$editlink = '';
	if(AuthComponent::user('user_role_id') == 1) {
		echo $this->Html->Link("Add Sermon", array('action' => 'add'));
				
	}
	echo "<br/>";
	echo "<div class='sermon_grid'>";
	foreach($sermons as $sermon):
		if(AuthComponent::user('user_role_id') == 1) {
			$editlink = $this->Html->Link("edit", array('action' => 'edit',  $sermon['AudioSermon']['id']));
		}
		
		$title = '';
		$later_space = '<br />
			&nbsp;<br />';
		if(isset($sermon['AudioSermon']['title']) && $sermon['AudioSermon']['title'] != '') {
			$title ="<h1>" . 
						 $sermon['AudioSermon']['title'] .
					"</h1>" . 
					"<h2>" .
						$this->Time->format('F j, Y',$sermon['AudioSermon']['date']) .
					"</h2>" .
					"<h2>" .
						$sermon['AudioSermon']['speaker'] .
					"</h2>" ;
			$later_space = '';
		} else {
			$title = "<h1>" .
						$this->Time->format('F j, Y',$sermon['AudioSermon']['date']) .
					"</h1>" . 
					"<h2>" .
						$sermon['AudioSermon']['speaker'] .
					"</h2>";
		}
		
		$sermon_desc = 
			$this->Html->image('speaker.png', array('alt' => 'icon')) .
			$title .
			"<audio controls class='audioplayer'>" .
			"<source src='/" . $sermon['AudioSermon']['filename'] . "' type='audio/mpeg'>" .
			"Your browser does not support the audio element." .
			"</audio>" .
			$later_space .
			$this->Html->link(
				"Download",
				array('action' => 'download', $sermon['AudioSermon']['id']
					))
				. "<br />" . $editlink;
		
		//echo $this->Html->link(
		//	$this->Html->div('audio_item', $sermon_desc), 	
		//	array('action' => 'listen' , $sermon['AudioSermon']['id']),
		//	array('escape' => false)
		//	); 
		
		echo $this->Html->div('audio_item', $sermon_desc); 
		
			
	endforeach;
	echo "</div>";
	
 ?>
</div>

