
<div class="forgotpw form">
<h3>Forgot Password</h3>
<?php echo $this->Form->create('User', array('action' => 'forgotpw')); 
      echo $this->Form->input('email',array('style'=>'float:left'));
      echo $this->Form->end('Recover');?>
</div>