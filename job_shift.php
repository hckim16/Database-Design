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

    $work_dateArr = array($_POST['year'], $_POST['month'], $_POST['day']);
    $scheduledDay = implode('-', $work_dateArr);

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "EmNo"              => $_POST['EmNo'],
            "work_date"         => $scheduledDay, 
            "start_shift"       => $_POST['start_shift'],
            "end_shift"         => $_POST['end_shift']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "job_shift",
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
                                                <form method="post">
                                                    	<tr>
                                                            <th scope="row"><label for="EmNo">Staff Id</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT last_name,EmNo FROM Staff order by EmNo";
                                                                    echo "<select name=EmNo value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[EmNo]>$row[EmNo]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="work_date">Work Date</label></th>
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
                                                                        for($year = 2022; $y <= $year; $y++){
                                                                            echo "<option value = '".$y."'>".$y."</option>";
                                                                        }
                                                                    ?>
                                                                </select></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="start_shift">Start Work Time</label></th>
                                                            <td><select name="start_shift">
                                                                    <option value="">Select</option>
                                                                    <option value="00:00:00">00:00:00</option>
                                                                    <option value="01:00:00">01:00:00</option>
                                                                    <option value="02:00:00">02:00:00</option>
                                                                    <option value="03:00:00">03:00:00</option>
                                                                    <option value="04:00:00">04:00:00</option>
                                                                    <option value="05:00:00">05:00:00</option>
                                                                    <option value="06:00:00">06:00:00</option>
                                                                    <option value="07:00:00">07:00:00</option>
                                                                    <option value="08:00:00">08:00:00</option>
                                                                    <option value="09:00:00">09:00:00</option>
                                                                    <option value="10:00:00">10:30:00</option>
                                                                    <option value="11:00:00">11:00:00</option>
                                                                    <option value="12:00:00">12:00:00</option>
                                                                    <option value="13:00:00">13:00:00</option>
                                                                    <option value="14:00:00">14:00:00</option>
                                                                    <option value="15:00:00">15:00:00</option>
                                                                    <option value="16:00:00">16:00:00</option>
                                                                    <option value="17:00:00">17:00:00</option>
                                                                    <option value="18:00:00">17:00:00</option>
                                                                    <option value="19:00:00">17:00:00</option>
                                                                    <option value="20:00:00">17:00:00</option>
                                                                    <option value="21:00:00">17:00:00</option>
                                                                    <option value="22:00:00">17:00:00</option>
                                                                    <option value="23:00:00">17:00:00</option>
                                                                </select></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="end_shift">Start Work Time</label></th>
                                                            <td><select name="end_shift">
                                                                    <option value="">Select</option>
                                                                    <option value="00:00:00">00:00:00</option>
                                                                    <option value="01:00:00">01:00:00</option>
                                                                    <option value="02:00:00">02:00:00</option>
                                                                    <option value="03:00:00">03:00:00</option>
                                                                    <option value="04:00:00">04:00:00</option>
                                                                    <option value="05:00:00">05:00:00</option>
                                                                    <option value="06:00:00">06:00:00</option>
                                                                    <option value="07:00:00">07:00:00</option>
                                                                    <option value="08:00:00">08:00:00</option>
                                                                    <option value="09:00:00">09:00:00</option>
                                                                    <option value="10:00:00">10:30:00</option>
                                                                    <option value="11:00:00">11:00:00</option>
                                                                    <option value="12:00:00">12:00:00</option>
                                                                    <option value="13:00:00">13:00:00</option>
                                                                    <option value="14:00:00">14:00:00</option>
                                                                    <option value="15:00:00">15:00:00</option>
                                                                    <option value="16:00:00">16:00:00</option>
                                                                    <option value="17:00:00">17:00:00</option>
                                                                    <option value="18:00:00">17:00:00</option>
                                                                    <option value="19:00:00">17:00:00</option>
                                                                    <option value="20:00:00">17:00:00</option>
                                                                    <option value="21:00:00">17:00:00</option>
                                                                    <option value="22:00:00">17:00:00</option>
                                                                    <option value="23:00:00">17:00:00</option>
                                                                </select></td>
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



