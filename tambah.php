<?php 
session_start();
//jika ga ada session tidak boleh masuk
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
//Exit untuk ,menghentikan program yang lain
	exit;
}

require 'functions.php';
//cek apakah tombol submit sudah di tekan /belum
if (isset($_POST["submit"])) {
	
	 //pengecekan keberhasilan insert
	if ( tambah($_POST) > 0) {
	 	echo "
	 		<script>
	 		alert('Data Berhasil Ditambahan');
	 		document.location.href = 'index.php';
	 		</script>
	 	";
	 } else{
	 	echo "<script>
	 		alert('Data Gagal Ditambahan');
	 		document.location.href = 'index.php';
	 		</script>";
	 }

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>

	<h1>Tambah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nis">NIM : </label>
				<input type="text" name="nis" id="nis" required>
			</li>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="email">Email : </label>
				<input type="text" name="email" id="email" required>
			</li>
			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="gambar">Gambar : </label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
			<button type="submit" name="submit">Tambah Data</button>
			</li>
		</ul>

	</form>

</body>
</html>