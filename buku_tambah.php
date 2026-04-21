<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Tambah Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post">
                <?php
                if(isset($_POST['submit'])){
    // Escape inputs to prevent SQL injection
    $judul          = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori       = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $penulis        = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    $penerbit       = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun_terbit   = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $isbn           = mysqli_real_escape_string($koneksi, $_POST['isbn']);
    $jumlah         = mysqli_real_escape_string($koneksi, $_POST['jumlah_halaman']);
    $sinopsis       = mysqli_real_escape_string($koneksi, $_POST['sinopsis']);

    // Handle file upload for gambar
    $gambar = '';
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
        $target_dir = "uploads/"; // Ensure this directory exists and is writable
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])){
            if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)){
                $gambar = $target_file;
            } else {
                echo "<script>alert('Gagal mengupload gambar');</script>";
                exit;
            }
        } else {
            echo "<script>alert('File bukan gambar yang valid');</script>";
            exit;
        }
    }

    $query = mysqli_query($koneksi,
        "INSERT INTO buku
        (judul, kategori, gambar, penulis, penerbit, tahun_terbit, isbn, jumlah, sinopsis)
        VALUES
        ('$judul','$kategori','$gambar','$penulis','$penerbit','$tahun_terbit','$isbn','$jumlah','$sinopsis')"
    );

    if($query){
        echo "<script>alert('Data berhasil ditambahkan');
        window.location='?page=buku';</script>";
    }else{
        echo "<script>alert('Data gagal ditambahkan');</script>";
    }
}
?>

                <div class="form-group mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Kategori</label>
    <input type="text" name="kategori" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Penulis</label>
    <input type="text" name="penulis" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Penerbit</label>
    <input type="text" name="penerbit" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Tahun Terbit</label>
    <input type="text" name="tahun_terbit" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>ISBN</label>
    <input type="text" name="isbn" class="form-control" required>
</div>
<div class="form-group mb-3">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control" accept="image/*" required>
</div>
<div class="form-group mb-3">
    <label>Jumlah Halaman</label>
    <input type="text" name="jumlah_halaman" class="form-control" required>
</div>

<div class="form-group mb-3">
    <label>Sinopsis</label>
    <input type="text" name="sinopsis" class="form-control" required>
</div>


                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="?page=buku" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
