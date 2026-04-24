<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
                if(isset($_POST['submit'])) {
                    $judul = mysqli_real_escape_string($koneksi, strtolower($_POST['judul']));
                    $id_kategori = $_POST['id_kategori'];
                    $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
                    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $isbn = $_POST['isbn'];
                    $jumlah = $_POST['jumlah'];
                    $gambar = $_POST['gambar'];
                    $sinopsis = mysqli_real_escape_string($koneksi, $_POST['sinopsis']);

                    // Handle file upload for gambar
                    // $gambar = '';
                    // if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                    //     $target_dir = "uploads/"; // Pastikan direktori ini ada dan writable
                    //     $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                    //     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    //     // Validasi tipe file (opsional, tambahkan jika perlu)
                    //     if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    //         $gambar = basename($_FILES["gambar"]["name"]);
                    //     }
                    // }

                    $cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE LOWER(judul) = '$judul' AND id_kategori = '$id_kategori'");
                    $check = mysqli_num_rows($cek);
                    if ($check > 0) {
                        echo "Data yang dimasukkan sama";
                    } else {
                        $query = mysqli_query($koneksi, "INSERT INTO buku(judul, id_kategori, penulis, penerbit, tahun_terbit, isbn, gambar, jumlah, sinopsis) VALUES ('$judul', '$id_kategori', '$penulis', '$penerbit', '$tahun_terbit', '$isbn', '$gambar', '$jumlah', '$sinopsis')");
                        if($query) {
                            echo "<script>alert('Data berhasil di tambahkan'); window.location='?page=buku';</script>";
                        } else {
                            echo '<script>alert("Error!! data gagal di tambahkan"); </script>';
                        }
                    }
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="buku" class="font-weight-bold text-gray-800">Judul</label>
                    <input type="text" name="judul" id="buku" class="form-control" placeholder="Masukkan judul buku" required>
                </div>

                <div class="form-group mb-3">
                    <label>Kategori (Pilih ID Kategori)</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while($k = mysqli_fetch_array($kat)){
                            echo "<option value='".$k['id_kategori']."'>".$k['kategori']."</option>";
                        }
                        ?>
                    </select>
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
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Sinopsis</label>
                    <textarea name="sinopsis" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="?page=buku" class="btn btn-danger">Kembali</a>
                </div>


            </form>
        </div>
    </div>
</div>
