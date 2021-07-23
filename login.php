<?php 
session_start();

require 'functions.php';
//cek cookie ada atau gk klo ada cek klo valid boleh masuk
if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key']; 
	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek cookie dan username(=== agar sama persis)
	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

//jika sudah login pindah ke index.php
if (isset($_SESSION["login"])) {
	header("location: index.php");
//exit untuk menghentikan code yang dibawahnya
	exit;
}

if (isset($_POST["login"])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");

	//cek username
	if (mysqli_num_rows($result) === 1 ) {
		
		//cek password
		$row = mysqli_fetch_assoc($result);
		
	if (password_verify($password, $row["password"])) {
		//aktifkan session variabel login
		$_SESSION["login"] = true;

		//cek remember/ingatnya jika cookie di klik
		if (isset($_POST['remember'])) {


			//buat cookie ('variabel','nilai/isi',durasi);
			//samarkan id nya biar aman
			setcookie('id',$row['id'],time()+60);
			//variabel key,jalankan hash, untuk tulisan$row['username']username yang diacak(key)
			setcookie('key',hash('sha256', $row['username']),time()+60 );
			
		}



		header("Location: index.php");
		exit();
	}

	}
	$error = true;


}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
</head>
<body>
<h1>Halaman Login</h1>

<?php if (isset($error) ): ?>
<p style="color: red ; font-style: italic;" >Username / Password Salah!</p>
<?php endif; ?>

<form method="POST" action="">

	<ul>
		<li>
			<label for="username">Username :</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">Password :</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">Ingat Saya</label>
		</li>
		<li>
			<button type="submit" name="login">Login</button>
		</li>
	</ul>
	

</form>
</body>
</html>