
<?php if(isset($logged)){
	?>
	<h2>Welcome back <?php echo $email; ?> <span style = "font-size: 13px" ><a href = "#" >Sign out</a></span></h2>
	<?php if(!isset($auth_token)){ ?>
	<form method = "post" action = "index.php/home/connect" >
		<input type = "text" name = "email" placeholder="Account Email Address"  >
		<input type = "password" name = 'password' placeholder = "Account Password"  >
		<input type = "text" name = "app_token" placeholder="App Token"  >
		<input type = "submit" value = "Connect to Hubstaff"  >
	</form>
	<?php
	}else{
		?>
		<h3>Your Hubstaff auth token is <?php echo $auth_token; ?></h3>
		<a href = "<?php echo $act_url ?>" >View Activities</a>
		<a href = "<?php echo $screenshots_url ?>" >View Screenshots</a>
		
		<?php
	}
}else { ?>

	<form method = "post" action = "index.php/home/login" >
		<input type = "text" name = "email"  >
		<input type = "password" name = "password"  >
		<input type = "submit" value = "login"  >
	</form>
	<button>Sign up</button>

<?php } ?> 