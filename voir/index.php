<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

require_once '../includes/Bootstrap.php';
$sql = "SELECT * FROM " . $Factory->table . "  ORDER BY id ";
$outputs = $Factory->getSQL($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

      <title></title>

      <link rel="stylesheet" media="screen" href="../css/main.css" />

      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
      <script src="../js/main.js"></script>
   </head>
   <body>
      <form id="liste">
         <table class="tbl_comparison" style="text-align: left;">
            <thead>
               <th class="col_E">Bdc</th>
               <th class="col_E">Date validation</th>
               <th class="col_E">Sté</th>
               <th class="col_E">Qté</th>
               <th class="col_E">Article</th>
               <th class="col_E">Sites</th>
               <th class="col_E" style=" width:100px;">Assigné à</th>
               <th class="col_E" style=" width:100px;">Statut</th>
               <th class="col_E" >Note</th>
               <th class="col_E" style=" width:100px;">Mise à jour</th>
            </thead>
            <tbody>
               <?php
               foreach ($outputs as $k => $output) {
                  echo "<tr>";
                  //--------------------------------------------------
                  echo "<td>";
                  echo $output["bdc"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo "<td>";
                  echo $output["validation"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo "<td>";
                  echo $output["ste"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo '<td style="text-align:center;" >';
                  echo $output["qte"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo "<td>";
                  echo $output["article"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo "<td>";
                  echo $output["sites"];
                  echo "</td>";
                  //--------------------------------------------------
                  //-------------------------------------------------
                  echo '<td style="text-align:center;">';
                  echo $output["assigne"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo '<td style="text-align:center;">';
                  echo $output["etat"];
                  echo "</td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo '<td style="text-align:center;"><span style="color:#f9400e">';
                  echo $output["note"];
                  echo "</span></td>";
                  //--------------------------------------------------
                  //--------------------------------------------------
                  echo '<td style="text-align:center;">';
                  echo '       <a class="edit" href="edit.php?id=' . $output["id"] . '"><img src="../assets/edit.png" id="' . $output["id"] . '"  alt="Editer"/></a>&nbsp;&nbsp;';
                  echo "</td>";
                  //--------------------------------------------------
                  echo "</tr>";
               }
               ?>
            </tbody>
         </table>
      </form>
   </body>
</html>
