
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
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseOne">Add New Record </a>
                                    </h4>
                                </div>
                                <div id = "collapseOne" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                            	<tbody>
                                                    <tr>
                                                        <td><a href="Surgeon.php">Add New Surgeon Record</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="Physician.php">Add New Physician Record</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="Nurse.php">Add New Nurse Record</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="support.php">Add New Staff Record</a></td>
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
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseFour">View Staff Information</a>
                                    </h4>
                                </div>
                                <div id = "collapseFour" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="viewstaff.php">Staff</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewsurgeon.php">Surgeon</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewphysician.php">Physician</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewnurse.php">Nurse</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="delete.php">Delete Staff Record</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
                                        <a data-toggle="collapse" data-parent = "#accordion" href = "#collapseFive">View Staff Schedule</a>
                                    </h4>
                                </div>
                                <div id = "collapseFive" class = "panel-collapse collapse">
                                    <div class = "panel-body">
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="job_shift.php">Add Job Shift Schedule</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewjobshift.php">View Job Shift Schedule by Last Name</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewjobshiftpos.php">View Job Shift Schedule by Position</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="schPhy.php">Add Physician Availability</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewphysch.php">View Physician Schedule</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="schSurg.php">Add Surgeon Availability</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewsurgsch.php">View Surgeon Schedule</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="schNur.php">Add Nurse Availability</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="viewnursch.php">View Nurse Schedule</a></td>
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



