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
   $kode       = "PSN-".date('dmY')."-".$_GET['kode_pesan'];
   $nama       = $_GET['nama_menu'];
   $total      = $_GET['subtotal'];


   // Attempt to run PDO prepared statement
   try {
      $sql  = "INSERT INTO `pemesanan`(`kode_pesan`, `nama`, `subtotal`) VALUES ('$kode','$nama','$total')";
      $stmt    = $pdo->prepare($sql);
      $stmt->bindParam(':kode_pesan', $kode, PDO::PARAM_STR);
      $stmt->bindParam(':nama_menu', $nama, PDO::PARAM_STR);
      $stmt->bindParam(':subtotal', $total, PDO::PARAM_STR);
      $stmt->execute();

      echo json_encode(array('message' => 'Congratulations the record ' . $nama . ' was added to the database'));
   }
   // Catch any errors in running the prepared statement
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }

?>