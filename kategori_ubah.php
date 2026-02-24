<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Ubah Kategori Buku</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post">
                <?php
                    $id = $_GET['id'];
                    if(isset($_POST['submit'])) {
                        $kategori = strtolower($_POST['kategori']);
                        $cek = mysqli_query($koneksi, "SELECT * FROM kategori WHERE LOWER(kategori)='$kategori'");
                        $check = mysqli_num_rows($cek);
                        if ($check > 0 ) {
                            echo "Data yang dimasukkan sama";
                        } else {
                            $query = mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori' WHERE id_kategori=$id");
                            if($query) {
                                echo "<script>alert('Data berhasil di ubah'); window.location='?page=kategori';</script>";
                            } else {
                                echo '<script>alert("Eror!! data gagal di ubah"); </script>';
                            }
                        }
                    }
                ?>
                <div class="form-group mb-3">
                    <label for="kategori" class="font-weight-bold text-gray-800">Nama Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Masukkan nama kategori baru" required>
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
