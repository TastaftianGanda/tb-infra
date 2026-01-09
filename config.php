<?php
 $conn = mysqli_connect("localhost","root","Root@12345","tb_infra");
 
 if(!$conn){
 die("Koneksi gagal: ".mysqli_connect_error());
 }
 ?>
