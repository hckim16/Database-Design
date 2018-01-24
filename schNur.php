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

    $stime = $_POST['stime'];
    $the_time = date('h:i A', strtotime($stime));

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "idNurse"         => $_POST['idNurse'],
            "dayOfWeek"         => $_POST['dayOfWeek'],
            "stime"              => $the_time,
            "status"            => $_POST['status']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "schedNurse",
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
	<blockquote><?php echo $_POST['idNurse']; ?> successfully added.</blockquote>
<?php 
} ?>

<div class="container">
    <div class="row">
        <head>
            <h1>Available Schedule</h1>
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
                           <tr>
                               <th scope="row"><label for="start_work_time">Start Work Time</label></th>
                               <td><select name = "start"><option>Start Time</option>
                                       <?php
                                           for($start = 0; $start <= 24:; $start++){
                                               echo"<option value = '".$start."'>".$start."</option>";
                                           }
                                       ?>
                                   </select></td>
                           </tr>                     <form method="post">
                                                    	<tr>
                                                            <th scope="row"><label for="idNurse">Nurse Last Name</label></th>
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
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="dayOfWeek">Day of Week</label></th>
                                                            <td><select = "dayofWeek">
                                                                <option value = "select">Select</option>
                                                                <option value = "Sunday">Sunday</option>
                                                                <option value = "Monday">Monday</option>
                                                                <option value = "Tuesday">Tuesday</option>
                                                                <option value = "Wednesday">Wednesday</option>
                                                                <option value = "Thursday">Thursday</option>
                                                                <option value = "Friday">Friday</option>
                                                                <option value = "Saturday">Saturday</option>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="stime">Time</label></th>
                                                            <td><input type="time" name="stime" id="stime"></td>
                                                        </tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="status">Status(0 - available / 1 - Not)</label></th>
                                                        	<td><input type="text" name="status" id="status"></td>
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



