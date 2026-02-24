<?php
include "koneksi.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = $id");

    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
?>

<div class="container">
    <h2>Detail Profil User</h2>
    <p><b>Nama :</b> <?php echo $data['nama']; ?></p>
    <p><b>Username :</b> <?php echo $data['username']; ?></p>
    <p><b>Email :</b> <?php echo $data['email']; ?></p>
    <p><b>Level :</b> <?php echo $data['level']; ?></p>
</div>

<?php
    } else {
        echo "<script>alert('Data tidak ditemukan');</script>";
    }
} else {
    echo "<script>alert('ID tidak valid');</script>";
}
?>