<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post">
                <?php
                    if(isset($_POST['submit'])) {
                        $buku = strtolower($_POST['buku']);
                        $id_kategori = $_POST['id_kategori'];

                        $cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE LOWER(judul) = '$buku' AND id_kategori = '$id_kategori'");
                        $check = mysqli_num_rows($cek);
                        if ($check > 0) {
                            echo "Data yang dimasukkan sama";
                        } else {
                            $query = mysqli_query($koneksi, "INSERT INTO buku(judul, id_kategori) VALUES ('$buku', '$id_kategori')");
                            if($query) {
                                echo "<script>alert('Data berhasil di tambahkan'); window.location='?page=buku';</script>";
                            } else {
                                echo '<script>alert("Error!! data gagal di tambahkan"); </script>';
                            }
                        }
                    }

                ?>
                <div class="form-group mb-3">
                    <label for="buku" class="font-weight-bold text-gray-800">Judul</label>
                    <input type="text" name="judul" id="buku" class="form-control" placeholder="Masukkan judul buku" required>
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

                


                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
