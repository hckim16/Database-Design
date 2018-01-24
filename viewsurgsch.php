<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
				FROM schedSurg as s 
				INNER JOIN Surgeon as b  
				INNER JOIN Staff as a 
				ON s.idSurgeon = b.idSurgeon and b.EmNo = a.EmNo
				WHERE b.idSurgeon = :idSurgeon";
		
		$idSurgeon = $_POST['idSurgeon'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':idSurgeon', $idSurgeon, PDO::PARAM_STR);
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
					<th>Surgeon ID Number</th>
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
				<td><?php echo escape($row["idSurgeon"]); ?></td>
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
		<blockquote>No results found for <?php echo escape($_POST['idSurgeon']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Please Select Surgeon</h2>

<form method="post">
<label for="idSurgeon">Surgeon Name</label>
	<td><?php
         require "config.php";
         $connection = new PDO($dsn, $username, $password, $options);
         $sql="SELECT last_name,idSurgeon FROM Surgeon as a 
               INNER JOIN Staff as b ON a.EmNo = b.EmNo
               order by last_name";
         echo "<select name=idSurgeon value=''></option>";
         echo "<option value='' selected>Select</option>";
         foreach ($connection->query($sql) as $row){
         echo "<option value=$row[idSurgeon]>$row[last_name]</option>"; 
         }
         echo "</select>";
         ?>    
    </td>
	<input type="submit" name="submit" value="View Results">
</form>


	
<a href="ClinicStaff.php">Back to Medical Staff Management</a>

