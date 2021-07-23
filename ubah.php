<?php 
session_start();
//jika ga ada session tidak boleh masuk
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
//Exit untuk ,menghentikan program yang lain
	exit;
}

require 'functions.php';

//ambil data diurl
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id" )[0];



//cek apakah tombol submit sudah di tekan /belum
if (isset($_POST["submit"])) {
	
	 //pengecekan keberhasilan insert
	if ( ubah($_POST) > 0) {
	 	echo "
	 		<script>
	 		alert('Data Berhasil Diubah');
	 		document.location.href = 'index.php';
	 		</script>
	 	";
	 } else{
	 	echo "<script>
	 		alert('Data Gagal Diubah');
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

	<h1>Ubah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?= $mhs["gambar"]; ?>">


		<ul>
			<li>
				<label for="nis">NIM : </label>
				<input type="text" name="nis" id="nis" required value="<?= $mhs["nis"]; ?>">
			</li>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="email">Email : </label>
				<input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
			</li>
			<li>
				<label for="jurusan">Jurusan : </label>
				<input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar : </label><br>
				<img src="gambar/<?= $mhs['gambar']; ?>" width="40"><br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
			<button type="submit" name="submit">Ubah Data</button>
			</li>
		</ul>

	</form>

</body>
</html>