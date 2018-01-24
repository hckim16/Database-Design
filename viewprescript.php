<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) 
{
	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM Prescription as a 
						INNER JOIN Patient as b ON a.idPatient = b.idPatient
						INNER JOIN Physician as c ON a.idPhysician = c.idPhysician
						INNER JOIN Drug as d ON a.idDrug = d.idDrug
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
}
?>

<?php 
if (isset($_POST['submit'])) 
{ 

	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Prescription History</h2>

		<table>
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Patient ID Number</th>
					<th>Date Prescribed</th>
					<th>Prescribing Physician ID</th>
					<th>Dosage</th>
					<th>Frequency</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["idPatient"]); ?></td>
				<td><?php echo escape($row["dp"]); ?></td>
				<td><?php echo escape($row["idPhysician"]); ?></td>
				<td><?php echo escape($row["dosage"]); ?></td>
				<td><?php echo escape($row["frequency"]); ?></td>
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

<h2>View Patient Prescription History</h2>

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
	
<a href="Patient.php">Back to Patient Management</a>





