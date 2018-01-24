<?php

	
	try 
	{	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM Address as a inner join Staff as s inner join Nurse as e
						ON a.idAddress = s.idAddress and s.EmNo = e.EmNo";

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
		<h2>List of Nurses Employed with Clinic</h2>

		<table>
			<thead>
				<tr>
					<th>EmNo</th>
					<th>idNurse</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Social Security Number</th>
					<th>Position</th>
					<th>Years/Experince</th>
					<th>Grade</th>
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
				<td><?php echo escape($row["EmNo"]); ?></td>
				<td><?php echo escape($row["idNurse"]); ?></td>
				<td><?php echo escape($row["first_name"]); ?></td>
				<td><?php echo escape($row["last_name"]); ?></td>
				<td><?php echo escape($row["gender"]); ?></td>
				<td><?php echo escape($row["ssn"]); ?></td>
				<td><?php echo escape($row["position"]); ?></td>
				<td><?php echo escape($row["year_exp"]); ?></td>
				<td><?php echo escape($row["grade"]); ?> </td>
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
	
<a href="ClinicStaff.php">Back to Medical Staff Management</a>

