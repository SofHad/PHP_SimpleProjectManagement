<?php
/*
  # ------------------------------------------------------------------------
  # SimpleProjectManagement
  # ------------------------------------------------------------------------
  # Developer : Sofiane Haddag, sofiane.haddag@yahoo.fr
 */

class uploader {

   private $name, $type, $tmp_name, $error, $size, $u_dir, $ext, $filepath;
   private $data, $inputs, $internal = array();
   public $internalErrors, $diff = array();
   public $step;

   const ERcsv = "Veuillez fournir un fichier de type CSV";

   /**
    * init
    *
    */
   public function init() {
      $this->name = $this->data ["upload"]["name"];
      $this->type = $this->data ["upload"]["type"];
      $this->tmp_name = $this->data ["upload"]["tmp_name"];
      $this->error = $this->data ["upload"]["error"];
      $this->size = $this->data ["upload"]["size"];
      $this->u_dir = "u/";
      $this->ext = "csv";
      $this->step = 0;
   }

   /**
    * getFilepath
    *
    */
   public function getFilepath() {

      return $this->filepath;
   }

   /**
    * init
    *
    */
   public function add($data, $Factory) {
      $this->data = $data["bdc"];
      if (empty($this->data))
         $Factory->close();
      $this->filepath = $data["filepath"];
      $rfile = fopen($this->filepath, "r");

      while (!feof($rfile)) {
         $line = fgets($rfile, 4096);
         $line = utf8_encode($line);
         $ex = explode(";", $line);
         if ((!empty($ex[0]) ) && ( substr(trim($ex[0]), 0, 2) == "BC" )) {
            $bdc = trim($ex[0]);
            $exLine["bdc"] = trim($ex[0]);
            $exLine["validation"] = $ex[1];
            $exLine["ste"] = $ex[2];
            $exLine["qte"] = $ex[3];
            $exLine["article"] = $ex[4];
            $exLine["sites"] = $ex[5];
            $exLine["assigne"] = $ex[6];
            $exLine["etat"] = $ex[7];
            if (in_array($exLine["bdc"], $this->data)) {
               $this->insert($exLine, $Factory);
            }
         }
      }
     $Factory->close();
   }

   /**
    * init
    *
    */
   public function handle($data, $Factory) {
      $this->data = $data;
      $this->init();

      //check
      if ($this->check()) {
         $this->filepath = $this->u_dir . time() . ".csv";
         move_uploaded_file($this->tmp_name, $this->filepath);
         $rfile = fopen($this->filepath, "r");
         //internal
         $sql = "SELECT bdc FROM " . $Factory->table . "  ";
         $out = $Factory->getSQL($sql);
         if (!empty($out)) {
            foreach ($out as $k => $v) {
               $this->internal[$v["bdc"]] = $v["bdc"];
            }
         }
         //$strOut = implode('|', array_map(function($el){ return $el['bdc']; }, $out));
         while (!feof($rfile)) {
            $line = fgets($rfile, 4096);
            $ex = explode(";", $line);
            if ((!empty($ex[0]) ) && ( substr(trim($ex[0]), 0, 2) == "BC" )) {
               $bdc = trim($ex[0]);
               $this->inputs[$bdc] = $bdc;
            }
         }
         $this->diff = array_diff($this->inputs, $this->internal);
         $this->step = 1;
      } else {
         $this->internalErrors[] = self::ERcsv;
      }
   }

   /**
    * check
    *
    */
   public function check() {

      return ( "csv" === substr($this->name, -3)) ? true : false;
   }

   function insert($input, $Factory) {

      try {
         $sql_inserer = "INSERT INTO " . $Factory->table . "
      (
         bdc,	 	 
         validation,	
         ste,	
         qte,	
         article,	
         sites,
         assigne,
         etat
      ) 
      VALUES 
      (
         :bdc,	 	 
         :validation,	
         :ste,	
         :qte,	
         :article,	
         :sites,
         :assigne,
         :etat
      )";
         $cnx = $Factory->getCnx();
         $o_prepare = $cnx->prepare($sql_inserer);
         $o_prepare->bindValue(":bdc", $Factory->clean($input["bdc"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":validation", $Factory->clean($input["validation"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":ste", $Factory->clean($input["ste"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":qte", $Factory->clean($input["qte"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":article", $input["article"], PDO::PARAM_STR);
         $o_prepare->bindValue(":sites", $Factory->clean($input["sites"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":assigne", $Factory->clean($input["assigne"]), PDO::PARAM_STR);
         $o_prepare->bindValue(":etat", $Factory->clean($input["etat"]), PDO::PARAM_STR);
         $o_prepare->execute();
         return true;
      } catch (PDOException $ep_error) {
         $Factory->error($ep_error);
      }
   }

}

?>
