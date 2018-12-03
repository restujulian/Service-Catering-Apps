<?php
	header('Access-Control-Allow-Origin: *');
   	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	class database{
 
		var $host = "localhost";
		var $uname = "root";
		var $pass = "";
		var $db = "cateringku";
		var $connect = false;
	 
		function __construct(){ //untuk memberi nilai awal dari properti
			$this->connect = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		}
		function searchMahasiswa($id){
			$sql = "SELECT * from menu WHERE id_kategori = '$id'";
			$d= mysqli_query($this->connect, $sql);
			$hasil = array();
			while($row = mysqli_fetch_array($d)){
				$hasil[] = $row;
			}
			return $hasil;
		}
	}
?>