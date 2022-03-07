<?php
require '../../function/functions.php';


if ( isset($_POST["submit"])) {

    if(tambah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = '../../../index.php';
            </script>
        
        ";
    }else{
        echo "
            <script>
                alert('Data gagal ditambahkan');    
            </script>
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
    <title>Tambah data mahasiswa</title>
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
            width: 10vw;
            height: 1.5vw;
        }
    </style>
</head>
<body>

<h1>Masukan data mahasiswa!</h1>

<a href="../../../index.php">Kembali menu awal</a>

<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nim">Masukan NIM:</label>
            <input type="text" name="nim" id="nim" required>
        </li>
        <li>
            <label for="nama">Masukan Nama:</label>
            <input type="text" name="nama" id="nama" required>
        </li>
        <li>
            <label for="email">Masukan email:</label>
            <input type="text" name="email" id="email" required>
        </li>
        <li>
            <label for="jurusan">Masukan jurusan:</label>
            <input type="text" name="jurusan" id="jurusan" required>
        </li>
        <li>
            <label for="gambar">Masukan gambar:</label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="submit">Submit!</button>
        </li>
    </ul>


</form>
    
</body>
</html>