<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

require_once '../includes/Bootstrap.php';
if (isset($_GET["del"])) {
   $del = $_GET["del"];
   if (is_array($del)) {
      foreach ($del as $k => $v) {
         $Factory->delete((int) $v);
      }
   } else {
      $Factory->delete((int) $del);
   }
   header("Location: index.php");
}
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
               <th class="col_E" style="text-align: left;"><input type="checkbox" name="checkaAll" id="checkAll" style="width:15px;" value=""  /></th>
               <th class="col_E">Bdc</th>
               <th class="col_E">Date validation</th>
               <th class="col_E">Sté</th>
               <th class="col_E">Qté</th>
               <th class="col_E">Article</th>
               <th class="col_E">Sites</th>
               <th class="col_E" style=" width:100px;">Assigné à</th>
               <th class="col_E" style=" width:100px;">Statut</th>
               <th class="col_E" >Note</th>
               <th class="col_E" style=" width:100px;">Actions</th>
            </thead>
            <tbody>
               <?php
               foreach ($outputs as $k => $output) {
                  echo "<tr>";
                  //--------------------------------------------------
                  echo "<td>";
                  echo '<input type="checkbox" name="del" style="width:15px;" value="' . $output["id"] . '"  />';
                  echo "</td>";
                  //--------------------------------------------------
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
                  echo '      <a class="del"  href="?del=' . $output["id"] . '"><img src="../assets/delete.png"  alt="Supprimer"  id="' . $output["id"] . '" /></a>';
                  echo "</td>";
                  //--------------------------------------------------
                  echo "</tr>";
               }
               ?>
            </tbody>
         </table>
      </form>
      <a href="index.php?" class="remove"><img src="../assets/remove.png"  alt="add" style="position: fixed; bottom: 90px; right: 5px;" /></a>
      <a href="upload.php" class="edit"><img src="../assets/upload.png"  alt="add" style="position: fixed; bottom: 45px; right: 5px;" /></a>
      <a href="edit.php?add" class="edit"><img src="../assets/blue-add.jpg"  alt="add" style="position: fixed; bottom: 5px; right: 5px;" /></a>
   </body>
</html>
