<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

require_once '../includes/Bootstrap.php';
require_once '../includes/uploader.php';

$upload = new uploader ();

if (isset($_FILES["upload"]["name"])) {
   $upload->handle($_FILES, $Factory);
   $filepath = $upload->getFilepath();
} elseif (isset($_POST["step"]) && (int) $_POST["step"] == 1) {
   $upload->add($_POST, $Factory);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

      <title>Editer</title>

      <link rel="stylesheet" media="screen" href="../css/main.css" />
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
      <script src="../js/main.js"></script>
   </head>
   <body>
      <div class="errors">
         <?php
         if (isset($upload->internalErrors)) {
            foreach ($upload->internalErrors as $error) {
               echo "<ul>";
               echo "<li>" . $error . "</li>";
               echo "</ul>";
            }
         }
         ?>
      </div>
      <form action="<?php $_SERVER["REQUEST_URI"] ?>" method="post" enctype="multipart/form-data" >
         <?php if (!isset($upload->step) || $upload->step != 1) { ?>
            <table class="tbl_comparison" style="text-align: left;">
               <tbody>
                  <!--            BDC-->
                  <tr>
                     <td>
                        <input type="file"  name="upload" value="" />
                     </td> 
                  </tr>
               </tbody>
            </table>
            <br /> <br /> <br /> <br />
            <input type="hidden" id="filepath" name="filepath" value="<?php if (isset($filepath)) echo $filepath; ?>" />
            <input type="submit" value="Envoyer" style="display: block; text-align: center;  ; margin: auto; text-transform: uppercase; ">  
            <?php } elseif (isset($upload->step) || $upload->step == 1) { ?>
               <table class="tbl_comparison" style="text-align: left;">
                  <thead>
                     <th class="col_E" colspan="2">Voici la liste des BDC à charger ?</th>
                  </thead>
                  <tbody>
                     <?php
                     if (!empty($upload->diff)) {

                        foreach ($upload->diff as $k => $v) {
                           echo "<tr>";
                           echo "<td>";
                           echo '<input type="checkbox" name="bdc[]" value="' . $v . '" checked="checked"  />';
                           echo "</td>";
                           echo "<td>";
                           echo $v;
                           echo "</td>";
                           echo "</tr>";
                        }
                     } else {
                        echo '<tr><td><strong>Rien à télécharger :</strong> soit tous les BDC existent ou votre fichier ne respecte pas le format d\'échange de données</td></tr>';
                     }
                     ?>
                     <!--            BDC-->
                  </tbody>
               </table>
               <br /> 
               <input type="hidden" id="filepath" name="filepath" value="<?php if (isset($filepath)) echo $filepath; ?>" />
               <input type="submit" value="IMPORTER" style="display: block; text-align: center;  ; margin: auto; text-transform: uppercase; ">  
               <?php } ?>
               <input type="hidden" id="step" name="step" value="<?php if (isset($upload->step)) echo $upload->step; ?>" />
               </form>

               </body>
               </html>
