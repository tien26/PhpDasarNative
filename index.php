<?php 
session_start();
//jika ga ada session tidak boleh masuk
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
//Exit untuk ,menghentikan program yang dibawahnya
	exit;
}
require 'functions.php';
// (database)sort by ASC(dari kecil kebesar) DESC(dari besar kekecil)
$mahasiswa = query("SELECT * FROM mahasiswa");


 //tombol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari ($_POST["keyword"]);
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	
</head>
<body>

<a href="logout.php">Log Out</a>
<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="", method="POST">
	
	<input type="text" name="keyword" size="40" autofocus placeholder="Masukan Keyword Pencarian" autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="tombol-cari">Cari Data</button>

</form>

<br>
<div id="container">
<table border="1" cellpadding="5" cellspacing="0">
	
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>Gambar</th>
		<th>Nis</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>
	<?php $i=1; ?>
<?php foreach ($mahasiswa as $row ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<td><a href="ubah.php?id= <?= $row["id"]; ?>">Ubah</a> | 
			<a href="hapus.php?id= <?= $row["id"]; ?>" onclick="return confirm('Apakah Yakin Akan Menghapus ?');">Hapus</a></td>
		<td><img src="gambar/<?=$row["gambar"]; ?>" width="50"></td>
		<td><?= $row["nis"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["email"]; ?></td>
		<td><?= $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
<?php endforeach; ?>

</table>
</div>
<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/script.js"></script>


</body>
</html>