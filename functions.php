<?php 
//Koneksi ke database
//("nama host","username mysql-nya","password","nama Database-nya");
$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}
//Pemanggilan functions (require & include)


function tambah($data){
	global $conn;
	//ambil dat dari tiap elemen dalam form
	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	//upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	//query insert data
	$query = "INSERT INTO mahasiswa
	VALUES 
	('','$nama','$nis','$email','$jurusan','$gambar')
	 ";
	 mysqli_query($conn, $query);

	 return mysqli_affected_rows($conn); 
}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

//cek apakah upload gambar sudah diisi
	if ($error === 4 ) {
		echo "<script>
	 		alert('Pilih Gambar Terlebih Dahulu');
	 		</script>";
	 		return false;
	}

//cek apakah yang diupload adalah gambar
	$EkstensiGambarValid = ['jpg','jpeg','png'];
	//explode untuk memecah sebuah string menjadi array(delimiter)
	$ekstensiGambar = explode('.', $namaFile);
	//end untuk mengambil array terahir
	//strtolower memaksa string jenis tulisan bukan kapital
	$ekstensiGambar = strtolower( end($ekstensiGambar));
//jika tidak ada jenis ekstensigambarvalid tidak sama maka gagalkan 
	if (!in_array($ekstensiGambar, $EkstensiGambarValid)) {
		echo "<script>
	 		alert('Yang Anda Upload Bukan Gambar !');
	 		</script>";
	 		return false;

	}
//cek jika ukuran gambar terlau besar 1mb(1000000)
	if ($ukuranFile > 1000000) {
		echo "<script>
	 		alert('Ukuran Gambar Terlalu Besar Harus Dibawah 1mb!');
	 		</script>";
	 		return false;
	}
	//untuk ngasih nama random
$namaFileBaru=uniqid();
$namaFileBaru.= '.';
$namaFileBaru.=$ekstensiGambar;
	//jika sudah memenuhi syarat diatas,maka upload
	move_uploaded_file($tmpName, 'gambar/'.$namaFileBaru);

	return $namaFileBaru;

}






function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function ubah($data){
	global $conn;

	$id = $data["id"];
	//ambil dat dari tiap elemen dalam form
	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarlama = htmlspecialchars($data["gambarlama"]);

	//cek gambar baru apa tidak(nilai 4 = textbox kosong)
if ($_FILES['gambar']['error'] === 4) {
	$gambar = $gambarlama;
}else{
	$gambar = upload();
}



	//query insert data
	$query = "UPDATE mahasiswa SET 
	nis = '$nis',
	nama = '$nama',
	email = '$email',
	jurusan = '$jurusan',
	gambar = '$gambar'
	WHERE id = $id

	 ";

	 //untuk menjalankan
	 mysqli_query($conn, $query);
	 //Untuk mengembalikan
	 return mysqli_affected_rows($conn); 


}


function cari($keyword){
	$query = "SELECT * FROM mahasiswa
				WHERE
				nama LIKE '%$keyword%' OR 
				nis LIKE '%$keyword%' OR 
				email LIKE '%$keyword%' OR 
				jurusan LIKE '%$keyword%'
				";
//LIKE fungsinya untuk mencari masukan depan dan belang%pencari%
			return query($query);
}


function registrasi($data){
	global $conn;

	$username = strtolower( stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

if (mysqli_fetch_assoc($result)) {
	echo "<script>
			alert('Username Sudah Terdaftar');
			</script> ";

			return false;
}


	//cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
			alert('Konfirmasi Password Tidak Sesuai');

			</script> ";

			return false;
	}
	
	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user ke database
	mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
	return mysqli_affected_rows($conn);

}




 ?>