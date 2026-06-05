<?php include_once('headerpasien.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Diagnosa</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body">


                                    <form action="hasildiagnosapasien.php" method="POST">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Nama Pasien</div>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" name="namapasien" required>
                                                    <option disabled selected>Pilih Pasien</option>
                                                    <?php

                                                    $sql2 = mysqli_query($con, "SELECT * FROM pasien where id_pasien= $_SESSION[id_pasien]");
                                                    while ($row2 = mysqli_fetch_array($sql2)) {
                                                    ?>
                                                        <option value="<?= $row2['nama_pasien'] ?>"><?= $row2['nama_pasien'] ?></option>
                                                    <?php

                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Jenis Kelamin</div>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" name="jk" required>
                                                    <option disabled selected> Pilih</option>

                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Gejala</div>

                                            <?php
                                            $sql = mysqli_query($con, "SELECT * FROM gejala");
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $i++
                                            ?>
                                                <label>
                                                    <input type="checkbox" name="gejala[]" value="<?= $data['nama_gejala'] ?>">
                                                    <?= $data['nama_gejala'] ?>
                                                </label><br>
                                            <?php
                                            }
                                            ?>

                                        </div>


                                        <div class=" card-footer text-right">
                                            <button class="btn btn-primary mr-1 btn-lg" type="submit" name="submit">Diagnosa</button>

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

    <?php include_once('footer.php'); ?>
