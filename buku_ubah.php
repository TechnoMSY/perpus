<!-- bagian form untuk mengubah data buku -->
<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Ubah Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
                $id = $_GET['id'];
                $data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
                $dta = mysqli_fetch_array($data);

                if(isset($_POST['submit'])) {
                    $judul = strtolower($_POST['judul']);
                    $id_kategori = $_POST['id_kategori'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $isbn = $_POST['isbn'];
                    $jumlah = $_POST['jumlah'];
                    $sinopsis = $_POST['sinopsis'];

                    // Cek apakah ada file gambar yang diunggah
                    if(isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
                        $target_dir = "uploads/"; // Pastikan direktori ini ada dan writable
                        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        // Validasi tipe file (opsional, tambahkan jika perlu)
                        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                            $gambar = basename($_FILES["gambar"]["name"]);
                        }
                    } else {
                        // Jika tidak ada gambar baru yang diunggah, gunakan gambar lama
                        $gambar = $dta['gambar'];
                    }

                    // Mengecek data buku dengan judul yang sama dan kategori yang sama (kecuali data yang sedang diubah)
                    $cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE LOWER(judul) = '$judul' AND id_kategori = '$id_kategori' AND id_buku != '$id'");
                    $check = mysqli_num_rows($cek);
                    if ($check > 0) {
                        echo "Data yang dimasukkan sama";
                    } else {
                        $query = mysqli_query($koneksi, "UPDATE buku SET judul='$judul', id_kategori='$id_kategori', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', isbn='$isbn', gambar='$gambar', jumlah='$jumlah', sinopsis='$sinopsis' WHERE id_buku='$id'");
                        if($query) {
                            echo "<script>alert('Data berhasil di ubah'); window.location='?page=buku';</script>";
                        } else {
                            echo '<script>alert("Error!! data gagal di ubah"); </script>';
                        }
                    }
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="buku" class="font-weight-bold text-gray-800">Judul</label>
                    <input type="text" name="judul" id="buku" class="form-control" placeholder="Masukkan judul buku" value="<?= $dta['judul']; ?>" required>
                </div>
                <div class="form-group
    mb-3">
                        <label>Kategori (Pilih ID Kategori)</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                            while($k = mysqli_fetch_array($kat)){
                                $selected = ($k['id_kategori'] == $dta['id_kategori']) ? 'selected' : '';
                                echo "<option value='".$k['id_kategori']."' $selected>".$k['kategori']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                <div class="form-group
                    mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= $dta['penulis']; ?>" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $dta['penerbit']; ?>" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label>Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" class="form-control" value="<?= $dta['tahun_terbit']; ?>" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="<?= $dta['isbn']; ?>" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    <?php if($dta['gambar']): ?>
                        <img src="uploads/<?= $dta['gambar']; ?>" alt="Gambar Buku" width="100" class="mt-2">
                    <?php endif; ?>
                </div>
                <div class="form-group
                    mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $dta['jumlah']; ?>" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label>Sinopsis</label>
                    <textarea name="sinopsis" class="form-control" rows="4" required><?= $dta['sinopsis']; ?></textarea>
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
