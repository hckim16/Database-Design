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

    $dobArr = array($_POST['year'], $_POST['month'], $_POST['day']);
    $dateOfBirth = implode('-', $dobArr);
 
    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "street"        => $_POST['street'],
            "city"          => $_POST['city'],
            "state"         => $_POST['state'],
            "zip"           => $_POST['zip'],
            "phone"         => $_POST['phone']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Address",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
        
        $currentId = $connection->lastInsertId();
        $connection1 = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "first_name"    => $_POST['first_name'],
            "last_name"     => $_POST['last_name'],
            "gender"        => $_POST['gender'],
            "dob"           => $dateOfBirth,
            "ssn"           => $_POST['ssn'],
            "idAddress"     => $currentId
        );
        $sql1 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Patient",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection1->prepare($sql1);
        $statement->execute($new_user);

        $currentId1 = $connection1->lastInsertId();
        $connection2 = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "blood_sugar"   => $_POST['blood_sugar'],
            "blood_type"    => $_POST['blood_type'],
            "idChol"        => $_POST['idChol'],
            "idIllness"     => $_POST['idIllness'],
            "idAllergy"     => $_POST['dAllergy'],
            "idPatient"     => $currentId1
        );
        $sql2 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "MedicalData",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection2->prepare($sql2);
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
            <h1>Add New Patient Records</h1>
            <script type='text/javascript' src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script src="js/jquery.js"></script> 
            <script src="js/moment.min.js"></script> 
            <script src="js/combodate.js"></script>
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
                                                            <th scope="row"><label for="dob">Date of Birth</label></th>
                                                            <td><select name = "month"><option>Month</option>
                                                                    <?php
                                                                        for($month = 1; $month <= 12; $month++){
                                                                            echo"<option value = '".$month."'>".$month."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <select name = "day"><option>Day</option>
                                                                    <?php
                                                                        for($day = 1; $day <= 31; $day++){
                                                                            echo "<option value = '".$day."'>".$day."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <select name = "year"><option>Year</option>
                                                                    <?php
                                                                        $y = date("Y", strtotime("+8 HOURS"));
                                                                        for($year = 1950; $y >= $year; $y--){
                                                                            echo "<option value = '".$y."'>".$y."</option>";
                                                                        }
                                                                    ?>
                                                                </select></td>
                                                        </tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="ssn">Social Security Number</label></th>
                                                        	<td><input type="text" name="ssn" id="ssn"></td>
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
                                                        <tr>
                                                            <th scope="row"><label for="blood_sugar">Blood Sugar</label></th>
                                                            <td><input type="text" name="blood_sugar" id="blood_sugar"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="blood_type">Blood Type</label></th>
                                                            <td><input type="text" name="blood_type" id="blood_type"></td>
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

<a href="Patient.php">Back to Patient Management</a>

    </div>
</div>




