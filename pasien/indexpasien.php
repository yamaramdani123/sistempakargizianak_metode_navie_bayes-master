<?php include_once('headerpasien.php');
require_once "../config/config.php";
?>

<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Pasien</h1><br>
            </div>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4> </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="admin">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th> Nama Pasien</th>
                                        <th> Username</th>
                                        <th> Jenis Kelamin</th>
                                        <th> Usia</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $SqlQuery = mysqli_query($con, "SELECT * From pasien where id_pasien= $_SESSION[id_pasien]");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama_pasien'] ?></td>
                                                <td><?= $row['usernameuser'] ?></td>
                                                <td><?= $row['jk'] ?></td>
                                                <td><?= $row['usia'] ?></td>
                                                <td>
                                                    <a href="editpasien.php?id=<?= $row['id_pasien'] ?>" class="btn btn-primary btn-action mr-1" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"6\" align=\"center\">data tidak ada</td></tr>";
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <div class="section-title mt-0">Nama Pasien</div>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="namapasien" required>
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
                        <div class="section-title mt-0">Usia</div>
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" name="usia" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title mt-0">Username</div>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="section-title mt-0">Password User</div>
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" name="password" required>
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
    $namapasien = $_POST['namapasien'];
    $usia = $_POST['usia'];
    $jk = $_POST['jk'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $save = mysqli_query($con, "INSERT INTO pasien (id_pasien, id_admin, nama_pasien, usernameuser, jk, usia, password_user) VALUES ('', '1', '$namapasien', '$username', '$jk', '$usia tahun' ,  '$password' )") or die(mysqli_error($con));

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
      window.location.replace('indexpasien.php');
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


<?php include_once('footer.php');
