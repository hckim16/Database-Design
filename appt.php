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

    $stime = $_POST['tov'];
    $the_time = date('h:i A', strtotime($tov));

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "idPhysician"       => $_POST['idPhysician'],
            "newPatient"         => $_POST['newPatient'],
            "dov"               => $dateOfVisit,
            "tov"               => $timeOfVisit,
            "reason"            => $_POST['reason']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Consultation",
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
            <h1>Schedule Appointment</h1>
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
                                                            <th scope="row"><label for="newPatient">New Patient Name</label></th>
                                                            <td><input type="text" name="newPatient" id="newPatient"></td>
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
                                                                        for($year = 2022; $y <= $year; $y++){
                                                                            echo "<option value = '".$y."'>".$y."</option>";
                                                                        }
                                                                    ?>
                                                                </select></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="tov">Appointment Time</label></th>
                                                            <td><select name="tov">
                                                                    <option value="">Select</option>
                                                                    <option value="09:00:00">09:00:00</option>
                                                                    <option value="09:30:00">09:30:00</option>
                                                                    <option value="10:00:00">10:00:00</option>
                                                                    <option value="10:30:00">10:30:00</option>
                                                                    <option value="11:00:00">11:00:00</option>
                                                                    <option value="11:30:00">11:30:00</option>
                                                                    <option value="12:00:00">12:00:00</option>
                                                                    <option value="12:30:00">12:30:00</option>
                                                                    <option value="13:00:00">13:00:00</option>
                                                                    <option value="13:30:00">13:30:00</option>
                                                                    <option value="14:00:00">14:00:00</option>
                                                                    <option value="14:30:00">14:30:00</option>
                                                                    <option value="15:00:00">15:00:00</option>
                                                                    <option value="15:30:00">15:30:00</option>
                                                                    <option value="16:00:00">16:00:00</option>
                                                                    <option value="16:30:00">16:30:00</option>
                                                                    <option value="17:00:00">17:00:00</option>
                                                                    </select></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="reason">Reason</label></th>
                                                            <td><input type="text" name="reason" id="reason"></td>
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






