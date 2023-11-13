<?php
include "connect.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : " ";

if (!empty($_POST['delete_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order= '$kode_order'");
    if(mysqli_num_rows($select)>0){
        $message = '<script>alert("Order telah terdaftar pada item order, data tidak dapat dihapus");
        window.location="../order"</script>';
    }else{
    $query = mysqli_query($conn, "DELETE FROM tb_order where id_order = '$kode_order'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dihapus");
            window.location="../order"</script>';
    } else {
            $message = '<script>alert("Data Gagal Dihapus");
            window.location="../order"</script>';
        }
    }
}echo $message;
?>