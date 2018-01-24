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
    
    $dovArr = array($_POST['year'], $_POST['month'], $_POST['day']);
    $dateOfVisit = implode('-', $dovArr);

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);

        $hdl = $_POST['hdl'];
        $totChol = $_POST['hdl'] +  $_POST['ldl'] + $_POST['trig']/5;

        if($totchol/$hdl < 4)
            $heartRisk  = "No Risk";
        else if($totchol/$hdl >= 4 && $totchol/$hdl <= 5)
            $heartRisk  = "Low Risk";
        else if($totchol/$hdl > 5)
            $heartRisk  = "Moderate Risk";

        $new_user = array(
            "idPatient"         => $_POST['idPatient'],
            "dov"               => $dateOfVisit,
            "hdl"               => $_POST['hdl'],
            "ldl"               => $_POST['ldl'],
            "trig"              => $_POST['trig'],
            "totChol"           => $totChol,
            "heartRisk"         => $heartRisk
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Cholesterol",
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
            <h1>Add to Cholesterol History</h1>
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
                                                            <th scope="row"><label for="dov">Date of Visit</label></th>
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
                                                                        for($year = 1900; $y >= $year; $y--){
                                                                            echo "<option value = '".$y."'>".$y."</option>";
                                                                        }
                                                                    ?>
                                                                </select></td>
                                                        </tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="hdl">HDL Level</label></th>
                                                        	<td><input type="text" name="hdl" id="hdl"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="ldl">LDL Level</label></th>
                                                        	<td><input type="text" name="ldl" id="ldl"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="trig">Triglyceride Level</label></th>
                                                        	<td><input type="text" name="trig" id="trig"></td>
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



