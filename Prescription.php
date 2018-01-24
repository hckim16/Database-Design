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

    $dpArr = array($_POST['year'], $_POST['month'], $_POST['day']);
    $datePrescribed = implode('-', $dpArr);
    
    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "idPatient"         => $_POST['idPatient'],
            "idPhysician"       => $_POST['idPhysician'],
            "idDrug"            => $_POST['idDrug'],
            "dp"                => $datePrescribed,
            "dosage"            => $_POST['dosage'],
            "frequency"         => $_POST['frequency'],
            "interaction"       => $_POST['interaction']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Prescription",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection->prepare($sql);
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
	<blockquote><?php echo $_POST['idPatient']; ?> successfully added.</blockquote>
<?php 
} ?>

<div class="container">
    <div class="row">
        <head>
            <h1>Prescription Order</h1>
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
                                                            <th scope="row"><label for="idPatient">Patient Last Name</label></th>
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
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="idPhysician">Physician Last Name</label></th>
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
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="idDrug">Drug Name</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT drug_name,idDrug FROM Drug order by drug_name";
                                                                    echo "<select name=idDrug value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[idDrug]>$row[drug_name]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="dp">Date Prescribed</label></th>
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
                                                        	<th scope="row"><label for="dosage">Dosage</label></th>
                                                        	<td><input type="text" name="dosage" id="dosage"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="frequency">Frequency</label></th>
                                                        	<td><input type="text" name="frequency" id="frequency"></td>
                                                    	</tr>
                                                        <tr>
                                                            <th scope="row"><label for="interaction">Interaction</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT description,interaction FROM DrugInteraction order by description";
                                                                    echo "<select name=interaction value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[interaction]>$row[description]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
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

<a href="Patient.php">Back to Patient Management</a>



