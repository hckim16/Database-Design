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
					<th>Patient ID Number</th>
					<th>Patient Last Name</th>
					<th>Physician ID Number</th>
					<th>Nurse ID Number</th>
					<th>Nursing Unit</th>
					<th>Wing</th>
					<th>Room</th>
					<th>Bed</th>
					<th>Check-In Date</th>
					<th>Check-Out Date</th>
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
				<td><?php echo escape($row["nursing_unit"]); ?></td>
				<td><?php echo escape($row["wing"]); ?></td>
				<td><?php echo escape($row["room"]); ?></td>
				<td><?php echo escape($row["bed"]); ?></td>
				<td><?php echo escape($row["date_in"]); ?></td>
				<td><?php echo escape($row["date_out"]); ?></td>
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

<h2>Please Select Patient to View Room Information</h2>

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

