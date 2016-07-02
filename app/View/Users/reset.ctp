<h2 class="hightitle"><?php __('Forget Password'); ?></h2>
<div class="forgotpw form" >
<?php //echo $this->Form->create('User', array('action' => 'reset')); ?>

<?php
if(isset($errors)){
echo '<div class="error">';
echo "<ul>";
foreach($errors as $error){
 echo"<li><div class='error-message'>$error</div></li>";
}
echo"</ul>";
echo'</div>';
}
?>
<?php echo $this->Form->create('User', array('action' => 'reset')); 
	  echo $this->Form->input('password', array('label' => 'New Password'));
	  echo $this->Form->end('Submit');?>

</div>