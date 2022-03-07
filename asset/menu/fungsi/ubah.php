<?php
require '../../function/functions.php';

// ambil data dari url
$id = $_GET["id"];

$mhs= query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if ( isset($_POST["submit"])) {
    // cek apakah data berhasil diubah
    if(ubah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah!');

                document.location.href = '../../../index.php';
            </script>
        
        ";
    }else{
        echo "
            alert('Data gagal diubah!');    
            document.location.href = '../../../index.php';
        ";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data mahasiswa</title>
    <style>
        li{
            list-style: none;
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        input{
            width: 20vw;
        }

        button{
            margin-top: 10px;
            width: 20vw;
        }
    </style>
</head>
<body>

<h1>Ubah data mahasiswa!</h1>

<a href="../../../index.php">Kembali menu awal</a>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
    <ul>
        <li>
            <label for="nim">NIM:</label>
            <input type="text" name="nim" id="nim" required value="<?= $mhs["nim"]; ?>">
        </li>
        <li>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"] ?>">
        </li>
        <li>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required value="<?= $mhs["email"] ?>">
        </li>
        <li>
            <label for="jurusan">Jurusan:</label>
            <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"] ?>">
        </li>
        <li>
            <label for="gambar">Gambar:</label>
            <img src="../../img/<?= $mhs["gambar"] ?>" alt="" width="100" height="100">
            <br>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="submit" onclick="return confirm('yakin ubah data ini?')">Submit!</button>
        </li>
    </ul>


</form>
    
</body>
</html>