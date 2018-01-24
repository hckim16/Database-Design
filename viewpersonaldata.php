<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM Address as a inner join Patient as p
						ON a.idAddress = p.idAddress";

		//$position = $_POST['position'];

		$statement = $connection->prepare($sql);
		//$statement->bindParam(':position', $position, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}

?>

<?php  

	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Patient List</h2>

		<table>
			<thead>
				<tr>
					<th>idPatient</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Social Security Number</th>
					<th>Date of Birth</th>
					<th>Street</th>
					<th>City</th>
					<th>State</th>
					<th>Zip Code</th>
					<th>Phone Number</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["idPatient"]); ?></td>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["gender"]); ?></td>
				<td><?php echo escape($row["ssn"]); ?></td>
				<td><?php echo escape($row["dob"]); ?></td>
				<td><?php echo escape($row["street"]); ?> </td>
				<td><?php echo escape($row["city"]); ?> </td>
				<td><?php echo escape($row["state"]); ?> </td>
				<td><?php echo escape($row["zip"]); ?> </td>
				<td><?php echo escape($row["phone"]); ?> </td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['position']); ?>.</blockquote>
	<?php
	} 
?> 


      
   </body>
</html>
	
<a href="Patient.php">Patient Management</a>

