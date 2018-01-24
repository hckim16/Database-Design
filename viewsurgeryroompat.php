<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
				FROM InPatient as a 
				INNER JOIN Patient as b ON a.idPatient = b.idPatient
				INNER JOIN Physician as c ON a.idPhysician = c.idPhysician
				INNER JOIN Nurse as d ON a.idNurse = d.idNurse
				INNER JOIN SurgerySchedule as e on a.inPatient = e.inPatient
				WHERE b.idPatient = :idPatient";
		
		$idPatient = $_POST['idPatient'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':idPatient', $idPatient, PDO::PARAM_STR);
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
					<th>Patient ID No.</th>
					<th>Patient Name</th>
					<th>Surgeon ID No.</th>
					<th>Nurse 1 ID No.</th>
					<th>Nurse 2 ID No.</th>
					<th>Surg Code No.</th>
					<th>Date of Surg</th>
					<th>Time of Surg</th>
					<th>Room</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["idPatient"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["idPhysician"]); ?></td>
				<td><?php echo escape($row["idNurse"]); ?></td>
				<td><?php echo escape($row["idNurse2"]); ?></td>
				<td><?php echo escape($row["idSurgeryCode"]); ?></td>
				<td><?php echo escape($row["dos"]); ?></td>
				<td><?php echo escape($row["tos"]); ?></td>
				<td><?php echo escape($row["location"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['idPatient']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please Select Patient to View Surgery Schedule</h2>

<form method="post">
	<label for="idPatient">Patient Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT last_name,idPatient FROM Patient order by last_name";
         echo "<select name=idPatient value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[idPatient]>$row[last_name]</option>"; 
         }
         echo "</select>";
         ?>    
         </td>
	<input type="submit" name="submit" value="View Results">
</form>
	
<a href="in_patient.php">Back to In-Patient Management</a>

