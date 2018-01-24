<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
				FROM job_shift as a 
				INNER JOIN Staff as b ON a.EmNo = b.EmNo
				WHERE b.EmNo = :EmNo";
		
		$EmNo = $_POST['EmNo'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':EmNo', $EmNo, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}

?>

<?php 
if (isset($_POST['submit'])) 
{ 

	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Job Shift</h2>

		<table>
			<thead>
				<tr>
					<th>Staff Employee Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Position</th>
					<th>Work Day</th>
					<th>Start Time</th>
					<th>End Time</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["EmNo"]); ?></td>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["position"]); ?></td>
				<td><?php echo escape($row["work_date"]); ?></td>
				<td><?php echo escape($row["start_shift"]); ?></td>
				<td><?php echo escape($row["end_shift"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['EmNo']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please select Staff to see schedule</h2>

<form method="post">
<label for="EmNo">Staff Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT last_name, EmNo FROM Staff order by last_name";
         echo "<select name=EmNo value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[EmNo]>$row[last_name]</option>"; 
         }
         echo "</select>";
         ?>    
    </td>
	<input type="submit" name="submit" value="View Results">
</form>
	
<a href="ClinicStaff.php">Back to Medical Staff Management</a>

