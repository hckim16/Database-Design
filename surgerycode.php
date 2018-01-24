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

    try 
    {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "surgcodename "     => $_POST['surgcodename'],
            "isSurgeryType"     => $_POST['isSurgeryType'],
            "idSkill"           => $_POST['idSkill'],
            "category"          => $_POST['category'],
            "idanat_loc"        => $_POST['idanat_loc'],
            "special_needs"     => $_POST['special_needs']
        );
        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "SurgeryCode",
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
            <h1>Add Surgery Code Information</h1>
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
                                                            <th scope="row"><label for="surgcodename">New Surgery Code Name</label></th>
                                                            <td><input type="text" name="surgcodename" id="surgcodename"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="isSurgeryType">Surgery Type Name</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT surg_type_name,isSurgeryType FROM SurgeryType 
                                                                            order by surg_type_name";
                                                                    echo "<select name=isSurgeryType value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[isSurgeryType]>$row[surg_type_name]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="idSkill">Surgery Skill Name</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT sk_name,idSkill FROM Skill 
                                                                            order by sk_name";
                                                                    echo "<select name=idSkill value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[idSkill]>$row[sk_name]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="category">Category</label></th>
                                                            <td><select name="category">
                                                                    <option value="">Select</option>
                                                                    <option value="In-Patient">In-Patient</option>
                                                                    <option value="Out-Patient">Out-Patient</option>
                                                                
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="idanat_loc">Anatomical Location</label></th>
                                                            <td><?php
                                                                    require "config.php";
                                                                    $connection = new PDO($dsn, $username, $password, $options);
                                                                    $sql="SELECT location,idanat_loc FROM anat_loc 
                                                                            order by location";
                                                                    echo "<select name=idanat_loc value=''></option>";
                                                                    echo "<option value='' selected>Select</option>";
                                                                    foreach ($connection->query($sql) as $row){
                                                                    echo "<option value=$row[idanat_loc]>$row[location]</option>"; 
                                                                    }
                                                                    echo "</select>";
                                                                    ?>    
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"><label for="special_needs">Special Needs</label></th>
                                                            <td><input type="text" name="special_needs" id="special_needs"></td>
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



