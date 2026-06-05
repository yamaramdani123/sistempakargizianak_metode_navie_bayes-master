<?php include_once('headerpasien.php');
require_once "../config/config.php";

if (isset($_POST['submit'])) {

    $del1 = mysqli_query($con, "DELETE FROM nilai");
    $del2 = mysqli_query($con, "DELETE FROM nilai_akhir");
    $n = 1;
    // rumus penyakit
    $Sqlpenyakit = mysqli_query($con, "select * from penyakit");
    $rowpenyakit = mysqli_num_rows($Sqlpenyakit);

    // jumlah penyakit
    $p = 1 / $rowpenyakit;
    $hasilp = round($p, 6);

    // jumlah gejala
    $m = 24;
    $rumus =  $m * $hasilp;
    // jumlah pvj
    $pvj = 1 / $m;
    $i = 1;
    $b = 1;
    $c = 1;
    $SqlQuery = mysqli_query($con, "SELECT * From penyakit");
    while ($row = mysqli_fetch_array($SqlQuery)) {
        $b++;
        $c++;
        $i++;
        $id = $row['id_penyakit'];
        $i++;
        foreach ($_POST['gejala'] as $value) {
            $Sqlpenyakit1 = mysqli_query($con, "SELECT * From gejala inner join penyakit as p ON gejala.id_penyakit=p.id_penyakit where p.id_penyakit='$id'");
            while ($rowgejala = mysqli_fetch_array($Sqlpenyakit1)) {

                if ($value == $rowgejala['nama_gejala']) {
                    $nilaigejala = 1;
                    $rumusgejala1 = round($rumus) + $nilaigejala;
                    $rumusgejala = $m + 1;
                    break;
                } else {
                    $nilaigejala = 0;
                    $rumusgejala1 = round($rumus) + $nilaigejala;
                    $rumusgejala = $m + 1;
                }
            }
            $i++;
            $hasiladagejala = $rumusgejala1 / $rumusgejala;

            $save = mysqli_query($con, "INSERT INTO nilai VALUES ('', '$id',  '$hasiladagejala' )") or die(mysqli_error($con));
        }
        $hasil = 1;
        $Sqlnilai = mysqli_query($con, "SELECT * From nilai where id_penyakit='$id'");

        $row = mysqli_num_rows($Sqlnilai);
        $kali = 1;
        for ($i = 1; $i < $row; $i++) {
            while ($rowgejala = mysqli_fetch_array($Sqlnilai)) {
                $kali *= $rowgejala['nilai'];
            }
            $hasilakhir = $kali * 0.333333;
            $save = mysqli_query($con, "INSERT INTO nilai_akhir VALUES ('', '$id',  '$hasilakhir' )") or die(mysqli_error($con));

            break;
        }

        // $hasilakhir[] = $hasil += $rowgejala['nilai'] * $hasilp;

        // break;

        // $hasilakhir[$b] = $p * $jumlah[$c];

    }
}

?>

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Hasil Diagnosa</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                            <?php
                            $SqlQuery = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit WHERE P.id_penyakit Order by nilai_akhir desc limit 1");
                            $row = mysqli_fetch_array($SqlQuery);
                            if (empty($row['nilai_akhir'])) {
                            ?>
                                <h3 class="text-dark">Kemungkinan Besar Terkena Gizi Buruk
                                    <h3 class="text-danger">Tidak Terjangkit</h3>
                                <?php
                            } else {
                                ?>
                                    <h3 class="text-danger"><?= $row['nama_penyakit'] ?></h3>

                                <?php
                            }
                                ?>
                                </h3><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row col-lg-12">
                            <div class="col-lg-6">

                                <div class="card-body">

                                    <form action="../hasil/index.php" enctype="multipart/form-data" method="get">
                                        <div class="form-group">
                                            <h6>Nama Pasien</h6>
                                            <div class="input-group mb-2">
                                                <?php
                                                $namapasien = $_POST['namapasien'];

                                                $sql = mysqli_query($con, "SELECT * FROM pasien where nama_pasien='$namapasien'");
                                                $row = mysqli_fetch_array($sql);
                                                ?>
                                                <input type="text" class="form-control" name="pasien" value="<?= $row['nama_pasien'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h6>Jenis Kelamin</h6>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="jk" value="<?= $_POST['jk'] ?>" required>
                                            </div>
                                        </div>
                                        <?php

                                        $sql2 = mysqli_query($con, "SELECT max(nilai_akhir) as nilai_akhir FROM `nilai_akhir`");
                                        $rownilaiakhir = mysqli_fetch_array($sql2);
                                        ?>
                                        <div class="form-group">
                                            <h6>Hasil Diagnosa</h6>
                                            <div class="input-group mb-2">
                                                <?php
                                                if (empty($rownilaiakhir['nilai_akhir'])) {
                                                ?>
                                                    <input type="text" class="form-control" value="0" required>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control" value="<?= $rownilaiakhir['nilai_akhir'] ?>" required>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php

                                        $sql = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit WHERE P.id_penyakit Order by nilai_akhir desc LIMIT 1");
                                        $row = mysqli_fetch_array($sql);
                                        ?>
                                        <div class="form-group">
                                            <h6>Jenis Gizi Buruk</h6>
                                            <div class="input-group mb-2">
                                                <?php
                                                if (empty($row['nilai_akhir'])) {
                                                ?>
                                                    <input type="text" class="form-control" value="Tidak ada Penyakit" required>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control" name="penyakit" value="<?= $row['nama_penyakit'] ?>" required>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6>Obat / Solusi</h6>
                                            <div class="input-group mb-2">
                                                <?php
                                                if (empty($row['nilai_akhir'])) {
                                                ?>
                                                    <input type="text" class="form-control text-lg" value="Segera Hubungi Dokter Apabila ada keluhan Lain" required disabled>
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="text" class="form-control text-lg" value="<?= $row['solusi'] ?>" required disabled>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6>Gejala Yang Dialami</h6>

                                            <?php
                                            $sql = mysqli_query($con, "SELECT * FROM gejala");
                                            $i = 1;
                                            $no = 1;
                                            foreach ($_POST['gejala'] as $value) {
                                                $i++
                                            ?>
                                                <span>
                                                    <?= $no++  ?>
                                                    <?= $value ?>
                                                </span><br>
                                            <?php
                                            }
                                            ?>



                                    </form>


                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div style=" width: 800px;margin: 0px auto; " class="img-fluid img-responsive">
                                    <?php
$SqlQuery = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit ORDER BY nilai_akhir DESC LIMIT 1");
                                    $row = mysqli_fetch_array($SqlQuery);
                                    if (empty($row['nilai_akhir'])) {
                                    ?>
                                        <h5 class="text-danger mt-3"> Tidak Ditemukan Penyakit</h5>


                                    <?php
                                    } else if ($row['nama_penyakit'] == 'Kwarshiorkor') {

                                    ?>
                                        <img class="img-fluid img-responsive" src=" <?= base_url() ?>/img/slide2.jpg" width="90%">

                                        <h5 class="text-danger mt-3"> Detail Penyakit</h5>

                                        <h6 class="mb-2 text-dark mt-3">Malnutrisi protein, atau kwashiorkor, sebagian besar ditemukan pada orang yang hidup di wilayah geografis yang memiliki sumber makanan terbatas. Ini paling sering terlihat pada anak-anak yang dietnya rendah protein dan kalori.
                                            Pertumbuhan tertunda pada anak-anak, perut bengkak, dan sering infeksi adalah gejalanya.
                                            Penanganan kwashiorkor berupa peningkatan lambat kalori diikuti peningkatan protein.</h6>
                                    <?php
                                    } else if ($row['nama_penyakit'] == 'Marasmik-Kwarshiorkor') {
                                    ?>
                                        <img class="img-fluid img-responsive" src=" <?= base_url() ?>/img/slide3.jpg" width="90%">

                                        <h5 class="text-danger mt-3"> Detail Penyakit</h5>

                                        <h6 class="mb-2 text-dark mt-3">Marasmik-kwashiorkor disebabkan karena makanan sehari-hari kekurangan energi dan juga protein. Berat badan anak sampai di bawah -3 SD sehingga telihat kurus, tetapi ada gejala edema, kelainan rambut, kulit mengering dan kusam, otot menjadi lemah,
                                            menurunnya kadar protein (albumin) dalam darah (Par'i, 2016)</h6>

                                    <?php
                                    } else {
                                    ?>
                                        <img class="img-fluid img-responsive" src=" <?= base_url() ?>/img/slide1.jpg" width="90%">

                                        <h5 class="text-danger mt-3"> Detail Penyakit</h5>

                                        <h6 class="mb-2 text-dark mt-3">Marasmus adalah kondisi yang ditandai dengan kurangnya kalori dan cairan dalam tubuh, serta menipisnya cadangan lemak.
                                            Hal ini mengakibatkan otot-otot tubuh mengecil.</h6>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <h6>Detail</h6>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 admin" id="admin">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th> Penyakit</th>
                                            <th> Hasil Nilai</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $SqlQuery = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit WHERE P.id_penyakit");
                                            $no = 1;
                                            if (mysqli_num_rows($SqlQuery) > 0) {
                                                while ($row = mysqli_fetch_array($SqlQuery)) {
                                            ?>

                                                    <td><?= $no++ ?></td>
                                                    <td><?=
                                                        $row['nama_penyakit']
                                                        ?></td>
                                                    <td><?= $row['nilai_akhir'] ?></td>
                                        </tr>
                                <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan=\"3\" align=\"center\">data tidak ada</td></tr>";
                                            }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        $SqlQuery = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit WHERE P.id_penyakit Order by nilai_akhir desc limit 1");
                        $row = mysqli_fetch_array($SqlQuery);

                        if (empty($row['nilai_akhir'])) {
                        ?>

                        <?php
                        } else {
                        ?>
                            <div class="card">
                                <div class="card-header text-center bg-danger">

                                    <center>

                                        <h4 class="text-white">Hasil Nilai Terbesar Diagnosa Adalah <?=
                                                                                                    $row['nama_penyakit']
                                                                                                    ?> Dengan Nilai Terbesar <?= $row['nilai_akhir'] ?></h4>
                                    </center>
                                </div>
                            </div>
                        <?php
                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php




?>
<?php include_once('footer.php'); ?>