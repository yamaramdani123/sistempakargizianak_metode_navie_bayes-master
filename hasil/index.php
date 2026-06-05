<?php include_once('header.php');
require_once "../config/config.php";



if (isset($_GET['tambah'])) {
    $namapasien = $_GET['pasien'];
    $jk = $_GET['jk'];
    $penyakit = $_GET['penyakit'];

    $sql = mysqli_query($con, "SELECT * FROM `nilai_akhir` INNER JOIN penyakit as p ON nilai_akhir.id_penyakit=P.id_penyakit ORDER BY nilai_akhir DESC LIMIT 1");
    $row = mysqli_fetch_array($sql);

    $id = $row['id_penyakit'];

    $save = mysqli_query($con, "INSERT INTO hasil VALUES ('', '$id', '$namapasien', '$jk', '$penyakit' )") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'Suksess', 
            text: 'Data Berhasil Disimpan $namapasien', 
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

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Hasil</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">


                        <div class="card-header-action mt-3">

                            <a href="cetak.php" class="btn btn-primary btn-lg">Cetak</a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="admin">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Nama Pasien</th>
                                        <th> Jenis Kelamin</th>
                                        <th> Hasil Diagnosa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * From hasil");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['namapasien'] ?></td>
                                                <td><?= $row['jeniskelamin'] ?></td>
                                                <td><?= $row['hasildiagnosa'] ?></td>
                                                <td>

                                                    <a href="delete.php?id=<?= $row['id_hasil'] ?>" class="btn btn-danger btn-xs delete-data" title="hapus"><i class="fas fa-trash"></i></a>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"5\" align=\"center\">data tidak ada</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('.admin').DataTable();
    });
</script>
<script>
    // swall
    $('.delete-data').on('click', function(e) {
        e.preventDefault();
        var getLink = $(this).attr('href');

        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Data akan dihapus permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                window.location.href = getLink;
            }
        })
    });
</script>
</body>

</html>


<?php include_once('footer.php'); ?>
