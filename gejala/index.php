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
                        <h4> </h4>


                        <div class="card-header-action mt-3">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Gejala</button>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="admin">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Jenis Penyakit</th>
                                        <th> Nama Gejala</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * From gejala inner join penyakit as p ON gejala.id_penyakit=p.id_penyakit");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama_penyakit'] ?></td>
                                                <td><?= $row['nama_gejala'] ?></td>

                                                <td>
                                                    <a href="edit.php?id=<?= $row['id_gejala'] ?>" class="btn btn-primary btn-action mr-1" title="Edit"><i class="fas fa-pencil-alt"></i></a>

                                                    <a href="delete.php?id=<?= $row['id_gejala'] ?>" class="btn btn-danger btn-xs delete-data" title="hapus"><i class="fas fa-trash"></i></a>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
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
<!-- MODAL -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="section-title mt-0">Pilih Penyakit</div>
                        <div class="input-group mb-2">
                            <select class="custom-select" name="namapenyakit" required>
                                <option disabled selected> Nama Penyakit</option>
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
                            <input type="text" class="form-control" name="gejala" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $namapenyakit = $_POST['namapenyakit'];
    $gejala = $_POST['gejala'];
    $id_admin = $_SESSION['id_admin'];


    $save = mysqli_query($con, "INSERT INTO gejala VALUES ('', '$id_admin',  '$namapenyakit', '$gejala' )") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'Suksess', 
            text: 'Data Berhasil Disimpan', 
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
