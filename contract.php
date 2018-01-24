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
            "duration"      => $_POST['duration'],
            "type"          => $_POST['type']
        );
        $sql1 = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "Contract",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection1->prepare($sql1);
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
	<blockquote><?php echo $_POST['name']; ?> successfully added.</blockquote>
<?php 
} ?>

<div class="container">
    <div class="row">
        <head>
            <h1>Medical Staff Management</h1>
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
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseOne">Surgeon Contract</a>
                                    </h4>
                                </div>
                                <div id = "collapseOne" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                            	<tbody>
                                                	<form method="post">
                                                    	<tr>
                                                        	<th scope="row"><label for="duration">Contract Duration (No. of Months)</label></th>
                                                			<td><input type="text" name="duration" id="duration"></td>
                                                    	</tr>
                                                    	<tr>
                                                        	<th scope="row"><label for="type">Contract Type</label></th>
                                                        	<td><input type="text" name="type" id="type"></td>
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
                </div>
            </div>
        </body>

<a href="ClinicStaff.php">Back to Medical Staff Management</a>

    </div>
</div>




