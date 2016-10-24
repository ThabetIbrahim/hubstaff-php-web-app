<div style = "text-align: center" >
	<h1>Back <a href = "<?php echo $home ?>" >Home</a></h1>
	<?php 
		foreach($screenshots->screenshots as $screenshot)
		{
			echo "<img src = '".$screenshot->url."' />";
		}
	?>
	
</div>
