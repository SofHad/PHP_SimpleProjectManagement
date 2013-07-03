<?php
header("Location: voir/") ;
require_once '../includes/Bootstrap.php';

$sql = "SELECT * FROM " . TABLE . "  ORDER BY id ";
$outputs = $Factory->getSQL($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

      <title></title>

      <link rel="stylesheet" media="screen" href="css/main.css" />
   </head>
   <body>
      <table class="tbl_comparison" style="text-align: left;">
         <thead>
            <th class="col_E">Bdc</th>
            <th class="col_E">Date validation</th>
            <th class="col_E">Sté</th>
            <th class="col_E">Qté</th>
            <th class="col_E">Article</th>
            <th class="col_E">Sites</th>
            <th class="col_E" style=" width:100px;">Statut</th>
            <th class="col_E" style=" width:100px;">Assigné à</th>
         </thead>
         <tbody>
            <?php
            foreach ($outputs as $k => $output) {
               echo "<tr>" ;
               //--------------------------------------------------
               echo "<td>";
               echo $output["bdc"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
                //--------------------------------------------------
               echo "<td>";
               echo $output["validation"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
                 //--------------------------------------------------
               echo "<td>";
               echo $output["ste"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
               //--------------------------------------------------
               echo "<td>";
               echo $output["qte"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
                              
               //--------------------------------------------------
               echo "<td>";
               echo $output["article"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
                                             
               //--------------------------------------------------
               echo "<td>";
               echo $output["sites"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
               //--------------------------------------------------
               echo "<td>";
               echo $output["etat"] ;
               echo "</td>" ;
              //--------------------------------------------------
               
               //--------------------------------------------------
               echo "<td>";
               echo $output["assigne"] ;
               echo "</td>" ;
              //--------------------------------------------------
                 echo "</tr>" ;
            }
            ?>
         </tbody>
      </table>
   </body>
</html>
