
<div class="forgotpw form">
<h3>Forgot Username</h3>
<?php echo $this->Form->create('User', array('action' => 'forgotuser')); 
      echo $this->Form->input('email');
      echo $this->Form->end('Recover');?>
</div>