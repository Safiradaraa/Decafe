<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tabel_daftar_menu
  LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id = tabel_daftar_menu.kategori");
while ($record = mysqli_fetch_array($query)){
  $result[] = $record;
}
$select_kat_menu = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9  mt-2">
        <div class="card">
  <div class="card-header">
    Halaman Menu
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" 
        data-bs-target="#ModalTambahUser"> Tambah Menu</button>
      </div>
    </div>
            <!-- Modal Tambah Menu Baru-->
<div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan dan Minumam</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6">
      <div class="input-group mb-3">
  <input type="file" class="form-control py-3" id="uploadFoto" placeholder="Your Name" name="foto" required>
  <label class="input-group-text" for="uploadFoto">Upload foto menu</label>
  <div class="invalid-feedback">
      Masukkan file foto menu.
    </div>
</div>
</div>
<div class="col-lg-6">
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="nama_menu" name="nama_menu" required>
  <label for="floatingInput">Nama Menu</label>
  <div class="invalid-feedback">
      Masukkan Nama Menu.
    </div>
</div>
</div>
</div>
<div class="row">
            <div class="col-lg-12">
      <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="keterangan"  name="keterangan">
  <label for="floatingPassword">Keterangan</label>
  </div>
</div>
</div>
<div class="row">
  <div class="col-lg-4">
  <div class="form-floating ">
  <select class="form-select" aria-label="Default select example" name="kat-menu" required>
    <option selected hidden value="">Pilih kategori menu</option>
    <?php
    foreach ($select_kat_menu as $value){
      echo "<option value=".$value['kategori_menu'].">$value[kategori_menu]</option>";
    }
    ?>
</select>
<label for="floatingInput">Kategori makanan atau minuman</label>
<div class="invalid-feedback">
      Pilih Kategori makanan atau minuman.
    </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3"  >
  <input type="Number" class="form-control" id="floatingInput"
   placeholder="Harga" name="harga" required>
  <label for="floatingInput">Harga</label>
  <div class="invalid-feedback">
      Masukkan harga menu
    </div>
</div>
</div>
<div class="col-4">
<div class="form-floating mb-3"  >
  <input type="Number" class="form-control" id="floatingInput"
   placeholder="Stok" name="stok" required>
  <label for="floatingInput">Stok</label>
  <div class="invalid-feedback">
      Masukkan Stok
    </div>
</div>
</div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name ="input_menu_validate" value="1234">Save changes</button>
        </div>
</form>
</div>
      </div>
    </div>
</div>
<!--Akhir Modal Tambah Menu Baru-->

<?php
foreach ($result as $row){
  ?>
          <!-- Modal View-->
<div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Detail Data User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
          <div class="row">
            <div class="col-lg-6">
      <div class="form-floating mb-3">
  <input disabled type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" value="<?php echo $row['nama']?>">
  <label for="floatingInput">Nama</label>
  <div class="invalid-feedback">
      Masukkan Nama.
    </div>
</div>
</div>
<div class="col-lg-6">
<div class="form-floating mb-3">
  <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username']?>">
  <label for="floatingInput">Username</label>
  <div class="invalid-feedback">
      Masukkan Username.
    </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-4 mb-3">
  <div class="form-floating">
 <select disabled class="form-select"aria-label="Default select example" required
    name="level" id="">
    <?php
    $data = array("Owner/Admin", "Kasir", "Pelayan", "Dapur");
    foreach ($data as $key => $value) {
      if($row['level'] ==$key+1){
        echo "<option selected value='$key'>$value</option>";
      }else{
        echo "<option value= '$key'> $value</option>";
      }
    }
    ?>
</select>
<label for="floatingInput">Level User</label>
<div class="invalid-feedback">
      Pilih Level User.
    </div>
</div>
</div>
<div class="col-8">
<div class="form-floating mb-3"  >
  <input disabled  type="Number" class="form-control" id="floatingInput" placeholder="08xxxx" name="nohp" value="<?php echo $row['nohp']?>">
  <label for="floatingInput">No HP</label>
</div>
</div>
</div>
<div class="form-floating">
  <textarea disabled  class="form-control" name="" id="" style="height:100px" name="alamat"><?php echo $row['alamat']?></textarea>
  <label for="floatingInput">Alamat</label>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<!-- Akhir Modal View-->

          <!-- Modal Edit-->
          <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit Data User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
      <input type="hidden" value="<?php echo $row['id']?>" name="id">
          <div class="row">
            <div class="col-lg-6">
      <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" name="nama" required value="<?php echo $row['nama']?>">
  <label for="floatingInput">Nama</label>
  <div class="invalid-feedback">
      Masukkan Nama.
    </div>
</div>
</div>
<div class="col-lg-6">
<div class="form-floating mb-3">
  <input  <?php echo ($row['username'] == $_SESSION['username_decafe']) ? 'disabled' : '';?> type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username"required value="<?php echo $row['username']?>">
  <label for="floatingInput">Username</label>
  <div class="invalid-feedback">
      Masukkan Username.
    </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-4 ">
  <div class="form-floating mb-3">
    <select class="form-select"aria-label="Default select example" required
    name="level" id="">
    <?php
    $data = array("Owner/Admin", "Kasir", "Pelayan", "Dapur");
    foreach ($data as $key => $value) {
      if($row['level'] ==$key+1){
        echo "<option selected value=".($key+1).">$value</option>";
      }else{
        echo "<option value= ".($key+1)."> $value</option>";
      }
    }
    ?>
</select>
<label for="floatingInput">Level User</label>
<div class="invalid-feedback">
      Pilih Level User.
    </div>
</div>
</div>
<div class="col-8">
<div class="form-floating mb-3"  >
  <input  type="Number" class="form-control" id="floatingInput" placeholder="08xxxx" name="nohp" value="<?php echo $row['nohp']?>">
  <label for="floatingInput">No HP</label>
</div>
</div>
</div>
<div class="form-floating">
  <textarea   class="form-control" name="" id="" style="height:100px" name="alamat"><?php echo $row['alamat']?></textarea>
  <label for="floatingInput">Alamat</label>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name ="input_user_validate" value="1234">Save changes</button>
        </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<!-- Akhir Modal Edit-->


          <!-- Modal Delete-->
          <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Delete Data User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="needs-validation" novalidate action="proses/proses_delete_user.php" method="POST">
      <input type="hidden" value="<?php echo $row['id']?>" name="id">
      <div class="col-lg-12">
        <?php
        if($row['username'] == $_SESSION['username_decafe']){
          echo "<div class='alert alert-danger'> Anda tidak dapat menghapus akun sendiri</div>";
        }else{
          echo "Apakah anda yakin ingin menghapus user<b>$row[username]</b>";
        }
        ?>
      </div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name ="input_user_validate" value="1234"<?php echo($row['username'] == $_SESSION['username_decafe']) ?'disabled' : ''?>>Delete</button>
        </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<!-- Akhir Modal Delete-->

          <!-- Modal Reset Password-->
          <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Reset Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="needs-validation" novalidate action="proses/proses_reset_password.php" method="POST">
      <input type="hidden" value="<?php echo $row['id']?>" name="id">
      <div class="col-lg-12">
        <?php
        if($row['username'] == $_SESSION['username_decafe']){
          echo "<div class='alert alert-danger'> Anda tidak dapat mereset password sendiri</div>";
        }else{
          echo "Apakah anda yakin ingin menreset passwort user<b>$row[username]</b> menjadi password bawaan sistem yaitu <b>password</b>";
        }
        ?>
      </div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name ="input_user_validate" value="1234"<?php echo($row['username'] == $_SESSION['username_decafe']) ?'disabled' : ''?>>Reset Password</button>
        </div>
</form>
      </div>
      
    </div>
  </div>
</div>
<!-- Akhir Modal Reset Password-->
<?php 
}
if (empty($result)){
  echo "Data user tidak ada";
}else {
?>
    <div class="table-responsive">
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Foto Menu</th>
      <th scope="col">Nama Menu</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Jenis Menu</th>
      <th scope="col">Kategori</th>
      <th scope="col">Harga</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =1;
    foreach ($result as $row){
     
      ?>
    
    <tr class= "text-nowra">
      <th scope="row"><?php echo $no++?> </th>
      <td>
        <div style="width:90px">
        <img src="assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="..."></td></div>
      <td><?php echo $row['nama_menu'] ?></td>
      <td><?php echo $row['keterangan'] ?></td>
      <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman"?></td>
      <td><?php echo $row['kategori_menu'] ?></td>
      <td><?php echo $row['harga'] ?></td>
      <td><?php echo $row['stok'] ?></td>
      <td >
        <div class="d-flex">
        <button class=" btn btn-info btn-sm me-1" data-bs-toggle="modal" 
        data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
        <button class=" btn btn-warning btn-sm me-1"data-bs-toggle="modal" 
        data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></i></button>
        <button class=" btn btn-danger btn-sm me-1" data-bs-toggle="modal" 
        data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash3"></i></button>
        <button class=" btn btn-secondary btn-sm" data-bs-toggle="modal" 
        data-bs-target="#ModalResetPassword<?php echo $row['id'] ?>"><i class="bi bi-key-fill"></i></button>
        </div></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?php } ?>
  </div>
</div>
        </div>

