<div style = "text-align: center" >
	<h1>Back <a href = "<?php echo $home ?>" >Home</a></h1>
	<table style="margin: 0px auto;width: 64%;">
		<thead>
			<th>Project</th>
			<th>Total Time Worked</th>
			<th>Keyboard</th>
			<th>Mouse</th>
			<th>Percent Active</th>
		</thead>
		<tbody>
			<?php 
			foreach($activities->activities as $activity)
			{
				echo "<tr> <td>".$activity->project_id."</td><td>".$activity->tracked."</td><td>".$activity->keyboard."</td><td>".$activity->mouse."</td><td>".$activity->overall."</td>";
			} ?>
		</tbody>
	</table>
</div>
