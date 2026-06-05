<?php
require_once "../config/config.php";
?>
<center>
    <h1>Hasil Diagnosa </h1>
    <table border="2">
        <thead>
            <tr>
                <th>No</th>
                <th> Nama Pasien</th>
                <th> Jenis Kelamin</th>
                <th> Hasil Diagnosa</th>

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
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
            }
            ?>
        </tbody>
    </table>
</center>
<script>
    window.print();
</script>