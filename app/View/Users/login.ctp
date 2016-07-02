
<div class="users_form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
      <?php echo $this->Form->input('username', array('after' => 
      									$this->Html->div('login_links', $this->Html->link("Forgot Username", 
      										array('controller' => 'Users', 'action' => 'forgotuser'),
	  										array('escape' => false)))));
      echo $this->Form->input('password', array('after' => 
								      $this->Html->div('login_links', 
								      $this->Html->link("Forgot Password", 
								      array('controller' => 'Users', 'action' => 'forgotpw')))));
?> <span class='submit buttonlinks'> <?php
	  echo $this->Form->submit(__('Login'), array('div' => false, 'after' => 
	  		  " &nbsp; &nbsp; &nbsp; - OR - &nbsp; " . 
		      $this->Html->link(" Register",array('controller' => 'Users', 'action' => 'Add'))
			  ));
?> </span> <?php
      echo $this->Form->end(); 
   
?>
	  </fieldset>
</div>