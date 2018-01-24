
<div class="container">
    <div class="row">
        <head>
            <h1>In-Patient Management</h1>
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
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseOne">Hospital Stay</a>
                                    </h4>
                                </div>
                                <div id = "collapseOne" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                            	<tbody>
                                                    <tr>
                                                        <td><a href="availroom.php">Available Rooms</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="inpatient.php">Hospital Room Assigment</a></td>
                                                    </tr>
                                                    <tr>
                                                         <td><a href="viewroom.php">View Patient Hospital Room Assigment</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="deleteinpatient.php">Remove Room Assignment</a></td>
                                                    </tr>
                                                </tbody>
                                			</table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="summary">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseTwo">Care Providers</a>
                                    </h4>
                                </div>
                                <div id = "collapseTwo" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tbody>
                                                        <tr>
                                                            <td><a href="Phyassign.php">Assign Physician</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="deletephyassign.php">Remove Physician</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="viewphyassign.php">View Physician Assignment</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="nurassign.php">Assign Nurse</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="viewnurassign.php">View Nurse Assignment</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="deletenurassign.php">Remove Nurse</a></td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="summary">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseThree">Surgery Status</a>
                                    </h4>
                                </div>
                                <div id = "collapseThree" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tbody>
                                                        <tr>
                                                            <td><a href="booksurgery.php">Book Surgery</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="surgerycode.php">Add New Surgery Code Information</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="viewsurgeryroomsur.php">View Scheduled Surgery By Surgeon</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="viewsurgeryroomroom.php">View Scheduled Surgery by Room</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="viewsurgeryroomday.php">View Scheduled Surgery by Day</a></td>
                                                        </tr>
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

<a href="index.php">Back to Newark Medical Associates</a>

    </div>
</div>



