<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
				FROM schedNurse as s 
				INNER JOIN Nurse as n  
				INNER JOIN Staff as a 
				ON s.idNurse = n.idNurse and n.EmNo = a.EmNo
				WHERE n.idNurse = :idNurse";
		
		$idPhysician = $_POST['idNurse'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':idNurse', $idNurse, PDO::PARAM_STR);
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
					<th>Nurse ID Number</th>
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
				<td><?php echo escape($row["idNurse"]); ?></td>
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
		<blockquote>No results found for <?php echo escape($_POST["last_name"]); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please select Nurse to see schedule</h2>

<form method="post">


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
	
<a href="ClinicStaff.php">Back to Medical Staff Management</a>

