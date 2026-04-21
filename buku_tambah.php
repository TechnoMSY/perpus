<div class="container-fluid">
    <h2 class="mb-4 text-gray-800">Kategori Komputer</h2>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post">
                <?php
                if(isset($_POST['submit'])){

    $kategori  = $_POST['kategori'];
    $tipe      = $_POST['tipe'];
    $merk      = $_POST['merk'];
    $processor = $_POST['processor'];
    $ram       = $_POST['ram'];
    $storage   = $_POST['storage'];
    $vga       = $_POST['vga'];
    $kondisi   = $_POST['kondisi'];

    $query = mysqli_query($koneksi,
        "INSERT INTO kategori 
        (kategori, tipe, merk, processor, ram, storage, vga, kondisi)
        VALUES 
        ('$kategori','$tipe','$merk','$processor','$ram','$storage','$vga','$kondisi')"
    );

    if($query){
        echo "<script>alert('Data berhasil ditambahkan'); 
        window.location='?page=kategori';</script>";
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
    <label>Gambar</label>
    <input type="text" name="gambar" class="form-control">
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
