<?php
require_once "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- General CSS Files -->


    <link href="../asset/dist/sweetalert.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= base_url() ?>/asset/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <title></title>
</head>

<body>
    <?php
    require_once "../config/config.php";
    $id = @$_GET['id'];
    $del1 = mysqli_query($con, "DELETE FROM hasil WHERE id_hasil='$id'");


    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('index.php');
    } ,1000); 
    </script>";

    ?>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <script src="../asset/dist/sweetalert.min.js"></script>
</body>

</html>