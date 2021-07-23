//$ = ini adalah pemanggilan jquery

//artinya jquery tolong ambil document/apapun sesuai yang ada didalam kurungnya
$(document).ready(function() {

// var keyword = document.getElementById('keyword');
// keyword.addEventListener('keyup', function() );
// console.log('ok');


 //ketika keyword diisi
 $('#keyword').on('keyup', function(){
 	//val = values
 	$('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
 									});

 });