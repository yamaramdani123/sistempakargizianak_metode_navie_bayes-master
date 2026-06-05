<?php include_once('header.php');
require_once "../config/config.php";
?>


<div class="main-content">
    <section class="section">
        <div class="section-header text-center">
            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                <h1>Halaman Gizi Buruk</h1><br>
            </div>


        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Updahte Data Penyakit</h4>
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
                                $SqlQuery = mysqli_query($con, "SELECT * From penyakit where id_penyakit='$id'");
                                $row = mysqli_fetch_array($SqlQuery)
                                ?>
                                <form action="" enctype="multipart/form-data" method="post">

                                    <div class="form-group">
                                        <div class="section-title mt-0">Nama Penyakit</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="namapenyakit" required value="<?= $row['nama_penyakit'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Solusi</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="solusi" required value="<?= $row['solusi'] ?>">
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

    $namapenyakit = $_POST['namapenyakit'];
    $solusi = $_POST['solusi'];


    $update1 = mysqli_query($con, "UPDATE penyakit set  nama_penyakit='$namapenyakit', solusi='$solusi' WHERE id_penyakit = '$id'") or die(mysqli_error($con));


    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'Suksess', 
            text: 'Data Berhasil Diupdate', 
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