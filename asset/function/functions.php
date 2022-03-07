<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row; 
    }
    return $rows;
}

function tambah($data){
    global $conn;

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);


    // Upload gambar
    $gambar = upload();
    if ( !$gambar ){

        return false;

    }

    $query = "INSERT INTO mahasiswa
                VALUES
                ('','$nama', '$nim', '$email', '$jurusan', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    
    $namaGambar = $_FILES["gambar"]["name"];
    $ukuranGambar = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpGambar = $_FILES["gambar"]["tmp_name"];

    if ( $error === 4 ){
        echo " <script>        
                    alert('Anda belum menambahkan gambar!');
                </script>
        ";
        return false;
    } 


    // cek apakah yang di upload adalah gambar
    $ekstensiFileValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaGambar);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if ( !in_array( $ekstensiGambar, $ekstensiFileValid )){
        echo " <script>        
                    alert('Ekstensi file yang diupload salah harus: jpg, jpeg, atau png!');
                </script>
        ";
        return false;
    }

    if ( $ukuranGambar > 1000000){
        echo " <script>        
                    alert('Ukuran file terlalu besar harus dibawah 1MB!');
                </script>
        ";
        return false;
    }

    // lolos pengecekan gambar siap diupload
    // mengganti nama file gambar
    $namaGambarBaru = uniqid();
    $namaGambarBaru .= ".";
    $namaGambarBaru .= $ekstensiGambar;


    move_uploaded_file($tmpGambar, '../../img/'. $namaGambarBaru);

    return $namaGambarBaru;

}


function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    

    if ( $_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa WHERE
                nama LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
            ";
    return query($query);
}


function register($data){
    global $conn;

    $username = strtolower(stripslashes(htmlspecialchars($data["username"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = $data["email"];

    // cek username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if ( mysqli_fetch_assoc($result) ){
        echo "
            <script>
                alert('Username sudah terdaftar, coba gunakan username lain!')
            </script>
        ";
        return false;
    }
    
    // cek konfirmasi passowrd
    if( $password !== $password2 ){
        echo "
            <script>
                alert('Password yang dimasukan tidak sesuai!');
            </script>
        ";

        return false;
    }

    // cek email
    $resultEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    if( mysqli_fetch_assoc($result) ){
        echo "
            <script>
                alert('Email sudah terdaftar!');
            </script>
        ";

        return false;
    }

    // enkripsi password
    $password =  password_hash($password, PASSWORD_DEFAULT);

    // menambahkan user baru
    $query = "INSERT INTO users
            VALUES ('', '$username', '$password', '$email' )";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function login($data){
    global $conn;

    $username = strtolower($data["username"]);
    $password = $data["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$username'");

    if ( mysqli_num_rows($result) === 1 ){

        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){

            echo "
                <script>
                    alert('Login Berhasil!');
                </script>
            ";
            header('Location: ../../../index.php');
            exit;
        }
    }
}

?>