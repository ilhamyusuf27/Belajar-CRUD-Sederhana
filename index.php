<?php 
// memanggil file function.php
require 'asset/function/functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

if ( isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    
<h1>Daftar Mahasiswa</h1>

<a href="asset/menu/fungsi/tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post">

    <input type="text" name="keyword" size="30" autofocus placeholder="Masukan keyword pencarian.." autocomplete="off">
    <button type="submit" name="cari">Cari</button>

</form>
<br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>
    
    <?php $i = 1; ?>

    <?php foreach($mahasiswa as $maha) : ?>
    <tr>  
        <td><?= $i; $i++ ?></td>
        <td>
            <a href="asset/menu/fungsi/ubah.php?id=<?= $maha["id"]; ?>">ubah</a> |
            <a href="asset/menu/fungsi/hapus.php?id=<?= $maha["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
        </td>
        <td>
            <img src="asset/img/<?= $maha["gambar"] ?>" width="50" alt="">
        </td>
        <td><?= $maha["nim"] ?></td>
        <td><?= $maha["nama"] ?></td>
        <td><?= $maha["email"] ?></td>
        <td><?= $maha["jurusan"] ?></td>
    </tr>
    
    <?php endforeach; ?>
</table>

</body>
</html>