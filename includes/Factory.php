<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

class Factory {

   private $cnx, $config, $host, $db, $user, $password;
   public $assigner, $statut;
   public $table = "SimpleProjectManagement";

   function __construct() {

      //config
      $this->config = parse_ini_file("config.ini");
      $this->assigner = explode(",", $this->config["assigner"]);
      $this->statut = explode(",", $this->config["statuts"]);
      $this->host =$this->clean($this->config["host"]);
      $this->db = $this->clean($this->config["db"]);
      $this->user = $this->clean($this->config["user"]);
      $this->password = $this->clean($this->config["password"]);

      try {

         /**
          *  Création de la connexion
          *
          */
         $this->cnx = new PDO("mysql:host=" . $this->host . ";port= ;dbname=" . $this->db, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
         // Dialogue en UTF-8 avec la base :
         $this->cnx->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");
         // Déclenche les erreur comme des exceptions :
         $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $ep_error) {
         echo $ep_error->getMessage();
      }
   }

   public function getCnx() {
      return $this->cnx;
   }

   public function getSQL($sql) {

      try {
         $o_execution = $this->cnx->query($sql);
         $result = $o_execution->fetchAll(PDO::FETCH_ASSOC);
         return $result;
      } catch (PDOException $ep_error) {
         $this->error($ep_error);
      }
   }

   function add($input) {
      try {
         $sql_inserer = "INSERT INTO " . $this->table . "
      (
         bdc,	 	 
         validation,	
         ste,	
         qte,	
         article,	
         sites,	
         etat,	
         assigne,
         note
      ) 
      VALUES 
      (
         :bdc,	 	 
         :validation,	
         :ste,	
         :qte,	
         :article,	
         :sites,	
         :etat,	
         :assigne,
         :note
       
      )";
         $o_prepare = $this->cnx->prepare($sql_inserer);
         $o_prepare->bindValue(":bdc", $this->clean($input["bdc"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":validation", $this->clean($input["validation"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":ste", $this->clean($input["ste"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":qte", $this->clean($input["qte"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":article", $this->clean($input["article"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":sites", $this->clean($input["sites"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":etat", $this->clean($input["etat"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":assigne", $this->clean($input["assigne"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":note", $this->clean($input["note"]), PDO::PARAM_STR);
         $o_prepare->execute();
         return true;
      } catch (PDOException $ep_error) {
         $this->error($ep_error);
      }
   }

   function update($input, $id) {
      try {
         $sql = "UPDATE " . $this->table . " SET
         bdc = :bdc,	 	 
         validation = :validation,	
         ste = :ste,	
         qte = :qte,	
         article = :article,	
         sites = :sites,	
         etat = :etat,	
         assigne = :assigne,
         note = :note
         WHERE id='$id' ";
         $o_prepare = $this->cnx->prepare($sql);
         $o_prepare->bindValue(":bdc", $this->clean($input["bdc"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":validation", $this->clean($input["validation"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":ste", $this->clean($input["ste"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":qte", $this->clean($input["qte"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":article", $this->clean($input["article"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":sites", $this->clean($input["sites"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":etat", $this->clean($input["etat"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":assigne", $this->clean($input["assigne"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":note", $this->clean($input["note"]), PDO::PARAM_STR);
         $o_prepare->execute();
         return true;
      } catch (PDOException $ep_error) {
         $this->error($ep_error);
      }
   }

   function updateUser($input, $id) {
      try {
         $sql = "UPDATE " . $this->table . " SET	
         etat = :etat,	
         note = :note
         WHERE id='$id' ";
         $o_prepare = $this->cnx->prepare($sql);
         $o_prepare->bindValue(":etat", $this->clean($input["etat"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":note", $this->clean($input["note"]), PDO::PARAM_STR);
         $o_prepare->execute();
         return true;
      } catch (PDOException $ep_error) {
         $this->error($ep_error);
      }
   }

   function delete($id) {
      if (empty($id) || !is_integer($id)) {
         //return;
         echo "C'est pas un entier";
         exit;
      }
      try {
         $sql = "DELETE FROM " . $this->table . "
         WHERE id= :id ";
         $o_prepare = $this->cnx->prepare($sql);
         $o_prepare->bindValue(":id", $id, PDO::PARAM_INT);
         $o_prepare->execute();
         return true;
      } catch (PDOException $ep_error) {
         $this->error($ep_error);
      }
   }

   /**
    * Erreurs
    */
   public function error($ep_error) {
      echo "function error : <pre>";
      var_dump($ep_error);
   }

   /**
    * Erreurs
    */
   public function notFound() {
      echo "ERREUR";
   }

   /**
    * Erreurs
    */
   public function clean($str) {
      return trim(strip_tags($str));
   }

   /**
    * Close
    */
   public function close() {
      echo '<script type="text/javascript">   window.close() ; opener.location.reload();  </script>';
   }

   /**
    * Select
    */
   public function select($attr, $val) {
      $out = ' value = "' . $val . '" ';

      if ($val == $attr) {
         $out .= 'selected = "selected" ';
      }
      return $out;
   }

   /**
    * getAssigne
    */
   public function getOptions($option, $options) {
      $out = "";
      foreach ($options as $val) {
         $out .= "<option ";
         $out .= $this->select($option, $val);
         $out .=">";
         $out .= $val;
         $out .= "</option>";
      }
      return $out;
   }

}

?>
