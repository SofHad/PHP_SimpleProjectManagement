<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

require_once '../includes/Bootstrap.php';
   if (isset($_POST) && !empty($_POST)) {
      $id = (int) $_POST["id"];
      $Factory->updateUser($_POST, $id);
      $Factory->close();
   } elseif (isset($_GET["id"]) || empty($_GET["id"])) {
      $id = (int) $_GET["id"];
      $sql = "SELECT * FROM " . $Factory->table . "  WHERE id='$id' ";
      $outputs = $Factory->getSQL($sql);
      $outputs = $outputs[0];
   } else {
      $Factory->notFound();
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
      <form action="<?php $_SERVER["REQUEST_URI"] ?>" method="post">
         <table class="tbl_comparison" style="text-align: left;">
            <tbody>
               <!--            BDC-->
               <tr>
                  <td style="width:30%;">
                     <label for="bdc">BDC</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["bdc"])) echo $outputs["bdc"]; ?>
                  </td> 
               </tr>

               <!--            VALIDATION-->
               <tr>
                  <td style="width:30%;">
                     <label for="validation">Date validation</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["validation"])) echo $outputs["validation"]; ?>
                  </td> 
               </tr>


               <!--            ste-->
               <tr>
                  <td style="width:30%;">
                     <label for="ste">Sté</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["ste"])) echo $outputs["ste"]; ?>
                  </td> 
               </tr>


               <!--            qte-->
               <tr>
                  <td style="width:30%;">
                     <label for="qte">Qté</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["qte"])) echo $outputs["qte"]; ?>
                  </td> 
               </tr>

               <!--            Article-->
               <tr>
                  <td style="width:30%;">
                     <label for="article">Article</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["article"])) echo $outputs["article"]; ?>
                  </td> 
               </tr>


               <!--            Sites-->
               <tr>
                  <td style="width:30%;">
                     <label for="sites">Sites</label>
                  </td> 
                  <td>
                     <?php if (isset($outputs["sites"])) echo $outputs["sites"]; ?>
                  </td> 
               </tr>

               <!--            Note-->
               <tr>
                  <td style="width:30%;">
                     <label for="note">Note</label>
                  </td> 
                  <td>
                     <input type="text" id="note" name="note" value="<?php if (isset($outputs["note"])) echo $outputs["note"]; ?>" />
                  </td> 
               </tr>


               <!--            Etat-->
               <tr>
                  <td style="width:30%;">
                     <label for="etat">Statut</label>
                  </td> 
                  <td>
                     <select id="etat" name="etat">
                        <?php
                        if (!isset($outputs["etat"])) {
                           $etat= null;
                        } else {
                           $etat= $outputs["etat"];
                        }
                        echo $Factory->getOptions($etat, $Factory->statut);
                        ?>
                     </select>
                  </td> 
               </tr>

               <!--           -->
               <tr>
                  <td style="width:30%;">
                     <label for="assigne">Assigné à</label>
                  </td> 
                  <td>
                        <?php
                        if (isset($outputs["assigne"])) {
                           echo  $outputs["assigne"];
                        }
                        ?>
                  </td> 
               </tr>
         </table>
         <table>
            <!--           -->
            <tr>
               <td style="padding-top: 15px ;">
                  <input type="submit" id="submit" name="submit" value="SAUVEGARDER" />
               </td> 
               <td style="padding-top: 15px ;">
                  <input type="submit" id="cancel" name="cancel" value="ANNULER" />
               </td> 
            </tr>
            </tbody>
         </table>
         <input type="hidden" id="id" name="id" value="<?php if (isset($outputs["id"])) echo $outputs["id"]; ?>" />
      </form>

   </body>
</html>
