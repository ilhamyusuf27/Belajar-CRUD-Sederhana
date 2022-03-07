<?php 
require '../../function/functions.php';

if ( isset($_POST["register"]) ){

    if ( register($_POST) > 0 ){

        echo "
            <script>
                alert('Registrasi berhasil!');
            </script>
        ";

    }else{

        echo mysqli_error($conn);

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>

    <style>

        form{
            width: 20%;
        }
        li{
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 5px;
        }

        button{
            margin-top: 10px;
            height: 30px;
        }
    </style>
</head>
<body>

    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </li>

            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </li>

            <li>
                <label for="password2">Konfirmasi password:</label>
                <input type="password" name="password2">
            </li>

            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </li>

            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>

</body>
</html>