<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 include "config.php";
 
 // DELETE
 if(isset($_GET['hapus'])){
 mysqli_query($conn,"DELETE FROM siswa WHERE id='$_GET[hapus]'");
 header("Location: index.php");
 }
 
 // UPDATE
 if(isset($_POST['update'])){
 mysqli_query($conn,"UPDATE siswa SET nama='$_POST[nama]', kelas='$_POST[kelas]' WHERE id='$_POST[id]'");
 header("Location: index.php");
 }
 
 // AMBIL DATA UNTUK EDIT
 $edit = null;
 if(isset($_GET['edit'])){
 $edit = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM siswa WHERE id='$_GET[edit]'"));
 }
 ?>
 
 <h2>Data Siswa</h2>
 
 <form method="post">
 <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
 
 Nama: <input type="text" name="nama" value="<?= $edit['nama'] ?? '' ?>"><br>
 Kelas: <input type="text" name="kelas" value="<?= $edit['kelas'] ?? '' ?>"><br>
 
 <?php if($edit){ ?>
 <button name="update">Update</button>
 <?php } else { ?>
 <button name="simpan">Simpan</button>
 <?php } ?>
 </form>
 
 <hr>
 
 <?php
 // CREATE
 if(isset($_POST['simpan'])){
 mysqli_query($conn,"INSERT INTO siswa (nama, kelas) VALUES ('$_POST[nama]','$_POST[kelas]')");
 header("Location: index.php");
 }
 
 // READ
 $data = mysqli_query($conn,"SELECT * FROM siswa");
 echo "<table border='1' cellpadding='5'>
 <tr>
 <th>ID</th>
 <th>Nama</th>
 <th>Kelas</th>
 <th>Aksi</th>
 </tr>";
 
 while($d=mysqli_fetch_array($data)){
 echo "<tr>
 <td>$d[id]</td>
 <td>$d[nama]</td>
 <td>$d[kelas]</td>
 <td>
 <a href='?edit=$d[id]'>Edit</a> |
 <a href='?hapus=$d[id]' onclick=\"return confirm('Hapus data?')\">Hapus</a>
 </td>
 </tr>";
 }
 echo "</table>";
 ?>
