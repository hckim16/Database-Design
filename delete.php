<html>
   
   <head>
      <title>Delete Staff Record</title>
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

               $sql = "DELETE FROM Staff where EmNo = :EmNo";

               $EmNo = $_POST['EmNo'];

               $statement = $connection->prepare($sql);
               $statement->bindParam(':EmNo', $EmNo, PDO::PARAM_STR);
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
                        <td width = "100">Employee Number</td>
                        <td><input name = "EmNo" type = "text" 
                           id = "EmNo"></td>
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

      <a href="ClinicStaff.php">Back to Medical Staff Management</a>
      
   </body>
</html>