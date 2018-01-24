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
    
    $dosArr = array($_POST['year'], $_POST['month'], $_POST['day']);
    $dateOfSurgery = implode('-', $dosArr);

    $stime = $_POST['tos'];
    $the_time = date('h:i A', strtotime($tos));

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "idPatient"         => $_POST['idPatient'],
            "idSurgeon"         => $_POST['idSurgeon'],
            "idNurse"           => $_POST['idNurse'],
            "idNurse2"          => $_POST['idNurse2'],
            "idSurgeryCode"     => $_POST['idSurgeryCode'],
            "dos"               => $dateOfSurgery,
            "tos"               => $the_time,
            "location"          => $_POST['location']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "SurgerySchedule",
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
            <h1>Book Surgery</h1>
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
                                                            <th scope="row"><label for="idSurgeon">Surgeon Last Name</label></th>
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
                                                        </tr>
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
                                                            <th scope="row"><label for="idNurse2">Nurse Last Name</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection1 = new PDO($dsn, $username, $password, $options);
                                                                    $sql1="SELECT last_name,idNurse FROM Nurse as a 
                                                                            INNER JOIN Staff as b ON a.EmNo = b.EmNo
                                                                            order by last_name";
                                                                    echo "<select name=idNurse value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection1->query($sql1) as $row){
                                                                    echo "<option value=$row[idNurse]>$row[last_name]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="idSurgeryCode">Surgery Code Name</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT surgcodename,idSurgeryCode FROM SurgeryCode order by surgcodename";
                                                                    echo "<select name=idSurgeryCode value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[idSurgeryCode]>$row[surgcodename]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="dos">Day of Surgery</label></th>
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
                                                            <th scope="row"><label for="tos">Time of Surgery</label></th>
                                                            <td><select name="tos">
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
                                                            <th scope="row"><label for="location">Location</label></th>
                                                            <td><input type="text" name="location" id="location"></td>
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

<a href="in_patient.php">Back to In-Patient Management</a>



