<?php 
require '../../function/functions.php';

if ( isset($_POST["submit"]) ){

    login($_POST);
    $error = true;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        p{
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>

<h1>Login</h1>

<?php if ( isset($error) ) : ?>
    <p>username/password salah</p>
<?php endif; ?>

<form action="" method="post">
    <ul>
        <li>
            <label for="username">Masukan usernam atau email:</label>
            <input type="text" name="username" required>
        </li>
        <li>
            <label for="password">Masukan password:</label>
            <input type="password" name="password" required>
        </li>
        <li>
            <button type="submit" name="submit">Login</button>
        </li>
    </ul>
</form>
    
</body>
</html>