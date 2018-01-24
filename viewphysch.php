<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
				FROM Staff as a 
				INNER JOIN Physician as b  
				INNER JOIN schedPhy as c 
				ON b.idPhysician = c.idPhysician and a.EmNo = b.EmNo
				WHERE b.idPhysician = :idPhysician";
		
		$idPhysician = $_POST['idPhysician'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':idPhysician', $idPhysician, PDO::PARAM_STR);
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
		<h2>Available Times</h2>

		<table>
			<thead>
				<tr>
					<th>Physician ID Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Day of the Week</th>
					<th>Available Time</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["idPhysician"]); ?></td>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["dayOfWeek"]); ?></td>
				<td><?php echo escape($row["stime"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['idPhysician']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please select Physician to see schedule</h2>

<form method="post">
<label for="idPhysician">Physician Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT last_name,idPhysician FROM Physician as a 
               INNER JOIN Staff as b ON a.EmNo = b.EmNo
               order by last_name";
         echo "<select name=idPhysician value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[idPhysician]>$row[last_name]</option>"; 
         }
         echo "</select>";
         ?>    
    </td>
	<input type="submit" name="submit" value="View Results">
</form>
	
<a href="ClinicStaff.php">Back to Medical Staff Management</a>

