<html>
   
   <head>
      <title>Remove Room/Bed Assignment</title>
   </head>
   
   <body>
      <?php

         if (isset($_POST['delete']))
         {
   
            try 
            {  
               require "config.php";
               require "common.php";

               $connection = new PDO($dsn, $username, $password, $options);

               $sql = "DELETE FROM InPatient where idPatient = :idPatient";

               $idPatient = $_POST['idPatient'];

               $statement = $connection->prepare($sql);
               $statement->bindParam(':idPatient', $idPatient, PDO::PARAM_STR);
               $statement->execute();
               echo "Record deleted successfully";
            }
            catch(PDOException $error) 
            {
               echo $sql . "<br>" . $error->getMessage();
            }
   
         }else {
            ?>
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "400" border = "0" cellspacing = "1" 
                     cellpadding = "2">
                     
                     <tr>
                        <td width = "100">Patient ID Number</td>
                        <td><input name = "idPatient" type = "text" 
                           id = "idPatient"></td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "delete" type = "submit" 
                              id = "delete" value = "Delete">
                        </td>
                     </tr>
                     
                  </table>
               </form>
            <?php
         }
      ?>

      <a href="in_patient.php">Back to In-Patient Management</a>
      
   </body>
</html>