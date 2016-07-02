<script>
	jQuery(document).ready(function(){
		jQuery('ul.sf-menu').superfish();
	});
</script>

<ul class="sf-menu" id="example">
	<li>
		<?php echo $this->Html->link("About Us", array('controller' => 'Pages', 'action' => 'display','ourchurch')); ?>
		<ul>
			<li>
				<?php echo $this->Html->link("Our Church", array('controller' => 'Pages', 'action' => 'display','ourchurch'));?>
			</li>
			<li>
				<?php echo $this->Html->link("Our Pastor", array('controller' => 'Pages', 'action' => 'display', 'ourpastor'));?>
			</li>
			<li>
				<?php echo $this->Html->link("Our Services", array('controller' => 'Pages', 'action' => 'display', 'ourservices')); ?>
				<ul>
					<li>
						<?php echo $this->Html->link("Audio Sermons", array('controller' => 'AudioSermons', 'action' => 'index')); ?>
					</li>
				</ul>
			</li>
			
		</ul>
	</li>
	<li>
		<?php echo $this->Html->link("Events", array('controller' => 'Pages', 'action' => 'display', 'wildgame'));?>
		<ul>
			<?php 

			echo "<li>";
			
			echo $this->Html->link("Family Fun Day", array('controller' => 'Pages', 'action' => 'display', 'familyfunday'));
			//echo $this->Html->link("Children's Day", array('controller' => 'Pages', 'action' => 'display', 'childrensday'));

			echo "</li>";
			echo "<li>";
			
			echo $this->Html->link("Craft Fair", array('controller' => 'Pages', 'action' => 'display', 'craftfair'));
			
			echo "</li>";
			
			?>
			<li>
				<?php echo $this->Html->link("Wild Game Dinner", array('controller' => 'Pages', 'action' => 'display', 'wildgame'));?>
			</li>
		</ul>
	</li>
	<li>
		<?php echo $this->Html->link("Contact", array('controller' => 'Pages', 'action' => 'display', 'contact')); ?>
		<ul>
			<li>
				<?php echo $this->Html->link("The Church", array('controller' => 'Pages', 'action' => 'display', 'contact')); ?>
			</li>
			<li>
				<?php echo $this->Html->link("Prayer Request", array('controller' => 'PrayerRequests', 'action' => 'add', 'prayerchain')); ?>
			</li>
			<li>
				<?php echo $this->Html->link("Directory", array('controller' => 'DirectoryFamilies', 'action' => 'index')); ?>
			</li>
		</ul>
	</li>
	<?php
	if(AuthComponent::user('user_role_id') == 1) {
		echo "<li>";
			echo $this->Html->link("Admin",array('controller' => 'Pages', 'action' => 'display', 'admin'));
			echo "<ul>";
				echo "<li>";
					echo $this->Html->link("Users", array('controller' => 'Users', 'action' => 'index'));
				echo "</li>";
				echo "<li>";
					echo $this->Html->link("Add Family", array('controller' => 'DirectoryFamilies', 'action' => 'addFamily'));
				echo "</li>";
				echo "<li>";
					echo $this->Html->link("Slideshow", array('controller' => 'slideshow', 'action' => 'index'));
				echo "</li>";
				echo "<li>";
					echo $this->Html->link("Emergency Contact", array('controller' => 'DirectoryPeople', 'action' => 'emergency'));
			echo "</ul>";
		echo "</li>";
	}
	?>
	<li>
		<?php
		$id = AuthComponent::user('id');
		$name = AuthComponent::user('username');
		
		if(is_numeric($id)) {
			echo $this->Html->link($name, array('controller' => 'Users', 'action' => 'view', $id));
			echo "<ul><li>";
			echo $this->Html->link("Logout", array('controller' => 'Users', 'action' => 'logout'));	
			echo "</li>";
			echo "</ul>";
		} else { 
			echo $this->Html->link("Login", array('controller' => 'Users', 'action' => 'login'));
			echo "<ul><li>";
			echo $this->Html->link("Register", array('controller' => 'Users', 'action' => 'add'));	
		}
		?>
	</li>
</ul>