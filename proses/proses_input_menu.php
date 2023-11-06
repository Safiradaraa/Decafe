<?php
include "connect.php";
// $name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : " ";
// $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : " ";
// $level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : " ";
// $nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : " ";
// $alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : " ";
// $password = md5 ('password');

$target_dir = "../assets/img/";
$target_file = $target_dir.basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 



if (!empty($_POST['input_menu_validate'])) {
// cek apakah gambar atau bukan
$cek = getimagesize($_FILES['foto']['tmp_name']);
if($cek === false){
    $message = "Ini bukan file gambar";
    $statusUpload = 0;
}else{
    $statusUpload = 1;
    if(file_exists($target_file)){
        $message = "Maaf File yang dimasukkan telah ada";
        $statusUpload = 0;
    }else{
        if($_FILES['foto']['size'] >500000){ // 500kb
            $message = "File foto yang di upload terlalu besar";
            $statusUpload = 0;
    }else{
        if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif"){
            $message = "Maaf, hanya di perbolehkan format JPG, JPEG< PNG dan GIF";
            $statusUpload = 0;
        }
    }
}
}

if($statusUpload==0){
    $message = '<script>alert("'. $message.', Gambar tidak dapat diupload");
    window.location="../menu"</script>';
}
echo $message;
exit();



    $select = mysqli_query($conn, "SELECT * FROM tabel_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang dimasukkan telah ada ")
            window.location="../user"</script>
             </script>';
    }else {
$query = mysqli_query($conn, "INSERT INTO tabel_user (nama, username, level, nohp, alamat, password) values ('$name', '$username', '$level', '$nohp', '$alamat', '$password')");
    if ($query) {
            $message = '<script>alert("Data Berhasil Dimasukkan");
            window.location="../user"</script>
             </script>';
        } else {
            $message = '<script>alert("Data Gagal Dimasukkan")</script>';
        }
    }
}echo $message;
?>