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
						FROM  Nurassign as a INNER JOIN Patient as b
						ON a.idPatient = b.idPatient
						INNER JOIN Nurse as c ON a.idNurse = c.idNurse
						WHERE c.idNurse = :idNurse";

		$sql1 = "SELECT * 
						FROM  Patient as a INNER JOIN Nurassign as b
						ON a.idPatient = b.idPatient
						INNER JOIN Nurse as c ON b.idNurse = c.idNurse
						WHERE c.idNurse = :idNurse";				

		$idNurse = $_POST['idNurse'];

		$statement = $connection->prepare($sql1);
		$statement->bindParam(':idNurse', $idNurse, PDO::PARAM_STR);
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
		<h2>Assigned Patients</h2>

		<table>
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['idNurse']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Select Nurse to view assigned Patients</h2>

<form method="post">
<label for="idNurse">Nurse Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT last_name,idNurse FROM Nurse as a 
               INNER JOIN Staff as b ON a.EmNo = b.EmNo
               order by last_name";
         echo "<select name=idNurse value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[idNurse]>$row[last_name]</option>"; 
         }
         echo "</select>";
         ?>    
    </td>
	<input type="submit" name="submit" value="View Results">
</form>
	
<a href="in_patient.php">Back to In-Patient Management</a>

