<?php include_once('header.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Gejala</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Updahte Data Gejala</h4>
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
                                    $SqlQuery = mysqli_query($con, "SELECT * From gejala inner join penyakit as p ON gejala.id_penyakit=p.id_penyakit where gejala.id_gejala='$id'");
                                    $row = mysqli_fetch_array($SqlQuery)
                                    ?>
                                    <form action="" enctype="multipart/form-data" method="post">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Pilih Penyakit</div>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" name="namapenyakit" required>
                                                    <option value="<?= $row['id_penyakit'] ?>" selected> <?= $row['nama_penyakit'] ?></option>
                                                    <?php

                                                    $sql2 = mysqli_query($con, "SELECT * FROM penyakit ");
                                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                                    ?>
                                                        <option value="<?= $row2['id_penyakit'] ?>"><?= $row2['nama_penyakit'] ?></option>
                                                    <?php

                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="section-title mt-0">Gejala</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="gejala" required value="<?= $row['nama_gejala'] ?>">
                                            </div>
                                        </div>


                                        <div class="card-footer text-right">
                                            <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                                            <button class="btn btn-danger" type="reset">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $namapenyakit = $_POST['namapenyakit'];
        $gejala = $_POST['gejala'];
        $id_admin = $_SESSION['id_admin'];



        $update1 = mysqli_query($con, "UPDATE gejala set id_admin='$id_admin', id_penyakit='$namapenyakit', nama_gejala='$gejala'  WHERE id_gejala = '$id'") or die(mysqli_error($con));

        echo "<script type='text/javascript'>
            setTimeout(function () { 
                swal({ 
                    title: 'Suksess', 
                    text: 'Data Berhasil Di Updahte', 
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
