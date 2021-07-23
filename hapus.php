<?php 
session_start();
//jika ga ada session tidak boleh masuk
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
//Exit untuk ,menghentikan program yang lain
	exit;
}

require 'functions.php';
$id = $_GET["id"];

if (hapus($id) >0) {
	echo "
	 		<script>
	 		alert('Data Berhasil Ditambahan');
	 		document.location.href = 'index.php';
	 		</script> 
	 		";
}else{
	echo "
	 		<script>
	 		alert('Data Gagal Dihapus');
	 		document.location.href = 'index.php';
	 		</script>
	 		";
}

 ?>