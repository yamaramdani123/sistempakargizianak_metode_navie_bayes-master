<?php include_once('header.php');
require_once "../config/config.php";
?>


<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Pasien</h1><br>
            </div>


        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Updahte Data Pasien</h4>
                    <div class="card-body" style="text-align: right;">
                        <a class="btn btn-warning btn-action mr-1" href="index.php" data-toggle="tooltip" title="Kembali"><span>Kembali</span></a>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="card-body">
                                <?php
                                $id = @$_GET['id'];
                                $sql_user = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$id'") or die(mysqli_error($con));
                                $row = mysqli_fetch_array($sql_user)
                                ?>
                                <form action="" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <div class="section-title mt-0">Nama Pasien</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="namapasien" required value="<?= $row['nama_pasien'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="section-title mt-0">Jenis Kelamin</div>
                                        <div class="input-group mb-2">
                                            <select class="custom-select" name="jk" required>
                                                <option value="<?= $row['jk'] ?>">Pilih</option>

                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="section-title mt-0">Usia</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="usia" required value="<?= $row['usia'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="section-title mt-0">Username</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="username" required value="<?= $row['usernameuser'] ?>" required>
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <div class="section-title mt-0">Password User</div>
                                        <div class="input-group mb-2">
                                            <input type="password" class="form-control" name="password" required value="<?= $row['password_user'] ?>">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>
                                        <button class="btn btn-danger" type="reset">Reset</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
</div>
</section>
<?php
if (isset($_POST['submit'])) {

    $namapasien = $_POST['namapasien'];
    $usia = $_POST['usia'];
    $jk = $_POST['jk'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $update1 = mysqli_query($con, "UPDATE pasien set nama_pasien ='$namapasien', usernameuser='$username', jk='$jk', usia='$usia', password_user='$password' WHERE id_pasien = '$id'") or die(mysqli_error($con));


    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'Suksess', 
            text: 'Data Berhasil Diupdate $namapasien', 
            type: 'success',
             timer: 3000,
              showConfirmButton: false });
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('index.php');
    } ,3000); 
    </script>";
}


?>
<?php include_once('footer.php'); ?>