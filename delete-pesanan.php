<?php
   header('Access-Control-Allow-Origin: *');
   header('Content-type: application/json');
   // Define database connection parameters
   $hn      = 'localhost';
   $un      = 'root';
   $pwd     = '';
   $db      = 'cateringku';
   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn 	= "mysql:host=" . $hn . ";port=3306;dbname=" . $db . ";charset=" . $cs;
   $opt 	= array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo  = new PDO($dsn, $un, $pwd, $opt);

   $json    =  file_get_contents('php://input');
   $obj     =  json_decode($json);

   // Attempt to query database table and retrieve data
    // Sanitise URL supplied values
   $id      = $_GET['id_pemesanan'];


   // Attempt to run PDO prepared statement
   try {
      $sql  = "DELETE FROM `pemesanan` WHERE `id_pemesanan` = '$id'";
      $stmt    = $pdo->prepare($sql);
      $stmt->bindParam(':id_pesanan', $id, PDO::PARAM_STR);
      $stmt->execute();

      echo json_encode(array('message' => 'Congratulations the record ' . $id . ' was added to the database'));
   }
   // Catch any errors in running the prepared statement
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }

?>