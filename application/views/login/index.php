<div  id="login_container">
    <div  id="header">
   
		<div id="logo"><h1><a href="/">AdmintTheme</a></h1></div>
		
    </div><!-- end header -->
	   
	    <div id="login" class="section">
	    	<?php
			if($error)
			{
				foreach($error as $valor)
				{
					?>
					<div id="fail" class="info_div"><span class="ico_cancel"><?php echo $valor;?></span></div>
					<?php
				}
			}
			?>
	    	
	    	<?php
			echo form_open('',array(
								'name'=>'loginform',
								'id'=>'loginform'
									)
							);
			?>			
			<label><strong>Username</strong></label>
			<?php echo form_input(array(
								'name'=>'user',
								'id'=>'user_login',
								'class'=>'input',
								'size'=>'28'
									)
							);?>
			<br />
			<label><strong>Password</strong></label>
			<?php echo form_password(array(
								'name'=>'pass',
								'id'=>'user_pass',
								'size'=>'28',
								'class'=>'input'
									)
							);?>
			
			<br />
			<!--<strong>Remember Me</strong><input type="checkbox" id="remember" class="input noborder" /> 
			
			<br />-->
			<?php
			echo form_submit(array(
								'name'=>'entrar',
								'id'=>'save',
								'class'=>'loginbutton submit',
								'value'=>'Log In'
									)
							);
			?>
					
			<?php
			echo form_close();
			?>
			
			<!--<a href="#" id="passwordrecoverylink">Forgot your username or password?</a>-->
	    </div>
	
</div><!-- end container -->
