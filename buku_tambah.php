<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Tambah Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if(isset($_POST['submit'])){
                    // 1. Ambil data dari form
                    $judul        = mysqli_real_escape_string($koneksi, $_POST['judul']);
                    // Kita simpan ke variabel $id_kategori karena di database kolomnya id_kategori
                    $kategori  = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
                    $penulis      = mysqli_real_escape_string($koneksi, $_POST['penulis']);
                    $penerbit     = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
                    $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
                    $isbn         = mysqli_real_escape_string($koneksi, $_POST['isbn']);
                    $jumlah       = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
                    $sinopsis     = mysqli_real_escape_string($koneksi, $_POST['sinopsis']);

                    // 2. Logika Gambar
                    $gambar = '';
                    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
                        $target_dir = "uploads/";
                        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
                        $nama_file = time() . '_' . basename($_FILES["gambar"]["name"]);
                        $target_file = $target_dir . $nama_file;
                        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)){
                            $gambar = $nama_file;
                        }
                    }

                    // 3. QUERY INSERT (SESUAI GAMBAR 3)
                    // Nama kolom disesuaikan: id_buku (auto), id_kategori, judul, penulis, penerbit, tahun_terbit, gambar, sinopsis, jumlah, isbn
                    $query = mysqli_query($koneksi, "INSERT INTO buku (id_kategori, judul, penulis, penerbit, tahun_terbit, gambar, sinopsis, jumlah, isbn) 
                              VALUES ('$id_kategori', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$gambar', '$sinopsis', '$jumlah', '$isbn')");

                    if($query){
                        echo "<script>alert('Data berhasil ditambahkan'); window.location='?page=buku';</script>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
                    }
                }
                ?>

                <div class="form-group mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Kategori (Pilih ID Kategori)</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        // Opsional: Mengambil kategori langsung dari tabel kategori agar user tidak ketik manual
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