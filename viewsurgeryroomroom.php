<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM SurgerySchedule as a 
				INNER JOIN Patient as b ON a.idPatient = b.idPatient
				WHERE location = :location";						

		$location = $_POST['location'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':location', $location, PDO::PARAM_STR);
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
		<h2>Room and Bed Assignment</h2>

		<table>
			<thead>
				<tr>
					<th>Patient Name</th>
					<th>Surgeon ID No.</th>
					<th>Nurse 1 ID No.</th>
					<th>Nurse 2 ID No.</th>
					<th>Surg Code No.</th>
					<th>Date of Surg</th>
					<th>Time of Surg</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["idSurgeon"]); ?></td>
				<td><?php echo escape($row["idNurse"]); ?></td>
				<td><?php echo escape($row["idNurse2"]); ?></td>
				<td><?php echo escape($row["idSurgeryCode"]); ?></td>
				<td><?php echo escape($row["dos"]); ?></td>
				<td><?php echo escape($row["tos"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please Select Room to View Surgery Schedule</h2>

<form method="post">
	<label for="location">Room Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT location FROM SurgerySchedule order by location";
         echo "<select name=location value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[location]>$row[location]</option>"; 
         }
         echo "</select>";
         ?>
	<input type="submit" name="submit" value="View Results">
</form>
	
<a href="in_patient.php">Back to In-Patient Management</a>

