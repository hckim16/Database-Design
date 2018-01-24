<?php
/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
if (isset($_POST['submit']))
{
    
    require "config.php";
    require "common.php";
    
    try 
    {
        $connection1 = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "street"        => $_POST['street'],
            "city"          => $_POST['city'],
            "state"         => $_POST['state'],
            "zip"           => $_POST['zip'],
            "phone"         => $_POST['phone']
        );
        $sql1 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Address",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection1->prepare($sql1);
        $statement->execute($new_user);
        
        $currentId1 = $connection1->lastInsertId();
        $connection2 = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "first_name"    => $_POST['first_name'],
            "last_name"     => $_POST['last_name'],
            "gender"        => $_POST['gender'],
            "ssn"           => $_POST['ssn'],
            "idposition"      => $_POST['idposition'],
            "salary"        => $_POST['salary'],
            "idAddress"     => $currentId1
        );
        $sql2 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Staff",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection2->prepare($sql2);
        $statement->execute($new_user);
        
        $currentId2 = $connection2->lastInsertId();
        $connection3 = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "EmNo"          => $currentId2,
            "specialty"     => $_POST['specialty'],
            "duration"      => $_POST['duration'],
            "type"          => $_POST['type']
        );
        $sql3 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Surgeon",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection3->prepare($sql3);
        $statement->execute($new_user);
	}
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>



<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['first_name']; ?> successfully added.</blockquote>
<?php 
} ?>

<div class="container">
    <div class="row">
        <head>
            <h2>Add New Surgeon Record</h2>
            <script type='text/javascript' src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </head>
        <body style="margin: 30px">
            <div class="container">
                <div class="tab-content">
                    <div class="tab-pane active" id="summary">
                            <div class="panel panel-default">
                                <div class = "panel-body">
                                     <div class="container">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <form method="post">
                                                    	<tr>
                                                        	<th scope="row"><label for="first_name">First Name</label></th>
                                                			<td><input type="text" name="first_name" id="first_name"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="last_name">Last Name</label></th>
                                                        	<td><input type="text" name="last_name" id="last_name"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="gender">Gender</label></th>
                                                        	<td><input type="text" name="gender" id="gender"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="ssn">Social Security Number</label></th>
                                                        	<td><input type="text" name="ssn" id="ssn"></td>
                                                    	</tr>
                                                    	<tr>
                                                            <th scope="row"><label for="idposition">Position</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT job,idposition FROM Job_title order by job";
                                                                    echo "<select name=idposition value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[idposition]>$row[job]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                    	<tr>
                                                    		<th scope="row"><label for="salary">Salary</label></th>
                                                        	<td><input type="text" name="salary" id="salary"></td>
                                                    	</tr>
                                                    	<tr>
                                                    		<th scope="row"><label for="specialty">Specialty</label></th>
                                                        	<td><input type="text" name="specialty" id="specialty"></td>
                                                    	</tr>
                                                        <tr>
                                                            <th scope="row"><label for="duration">Contract Duration (No. of Months)</label></th>
                                                            <td><input type="text" name="duration" id="duration"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="type">Contract Type</label></th>
                                                            <td><input type="text" name="type" id="type"></td>
                                                        </tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="street">Street</label></th>
                                                        	<td><input type="text" name="street" id="street"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="city">City</label></th>
                                                        	<td><input type="text" name="city" id="city"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="state">State</label></th>
                                                        	<td><input type="text" name="state" id="state"></td>
                                                    	</tr>
                                                   		<tr>
                                                        	<th scope="row"><label for="zip">Zip Code</label></th>
                                                        	<td><input type="text" name="zip" id="zip"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="phone">Phone Number</label></th>
                                                        	<td><input type="text" name="phone" id="phone"></td>
                                                    	</tr>
                                                    	<input type="submit" name="submit" value="Submit" button type="button" class="btn btn-success">
                                                </form>
                                            </tbody>
                                		</table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </body>
    </div>
</div>

<a href="ClinicStaff.php">Back to Medical Staff Management</a>



